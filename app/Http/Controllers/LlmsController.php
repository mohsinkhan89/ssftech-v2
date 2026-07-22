<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LlmsController extends Controller
{
    public function __invoke()
    {
        $pages = collect(Route::getRoutes()->getRoutes())
            ->filter(function ($route) {
                $uri = $route->uri();

                return in_array('GET', $route->methods(), true)
                    && $route->getName()
                    && ! in_array($route->getName(), ['login', 'sitemap', 'llms'], true)
                    && ! str_contains($uri, '{')
                    && ! str_starts_with($uri, 'admin');
            })
            ->map(fn ($route) => [
                'title' => $route->getName() === 'index'
                    ? 'Home'
                    : Str::headline($route->getName()),
                'url' => route($route->getName()),
            ])
            ->unique('url')
            ->values();

        $articles = Blog::query()
            ->where('status', true)
            ->whereNotNull('slug')
            ->latest('published_at')
            ->get(['title', 'slug', 'excerpt']);

        $settings = SiteSetting::query()->first();
        $lines = [
            '# SSF Tech',
            '',
            '> SSF Tech provides website development, software development, digital design, and online growth solutions for businesses.',
            '',
            '## Pages',
            '',
        ];

        foreach ($pages as $page) {
            $lines[] = sprintf('- [%s](%s)', $this->plainText($page['title']), $page['url']);
        }

        if ($articles->isNotEmpty()) {
            $lines[] = '';
            $lines[] = '## Articles';
            $lines[] = '';

            foreach ($articles as $article) {
                $description = $this->plainText($article->excerpt);
                $suffix = $description !== '' ? ': '.$description : '';
                $lines[] = sprintf(
                    '- [%s](%s)%s',
                    $this->plainText($article->title),
                    route('blog.show', $article->slug),
                    $suffix
                );
            }
        }

        if ($settings?->contact_email) {
            $lines[] = '';
            $lines[] = '## Contact';
            $lines[] = '';
            $lines[] = '- Email: '.$this->plainText($settings->contact_email);
        }

        return response(implode("\n", $lines)."\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    private function plainText(?string $value): string
    {
        return str_replace(['[', ']'], ['\\[', '\\]'], Str::squish(strip_tags((string) $value)));
    }
}
