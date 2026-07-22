<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $urls = collect(Route::getRoutes()->getRoutes())
            ->filter(function ($route) {
                $uri = $route->uri();

                return in_array('GET', $route->methods(), true)
                    && $route->getName()
                    && ! in_array($route->getName(), ['sitemap', 'llms'], true)
                    && ! str_contains($uri, '{')
                    && ! str_starts_with($uri, 'admin')
                    && $route->getName() !== 'login';
            })
            ->map(fn ($route) => [
                'loc' => route($route->getName()),
                'lastmod' => null,
            ]);

        $blogUrls = Blog::query()
            ->where('status', true)
            ->whereNotNull('slug')
            ->orderBy('id')
            ->get(['slug', 'updated_at'])
            ->map(fn (Blog $blog) => [
                'loc' => route('blog.show', $blog->slug),
                'lastmod' => $blog->updated_at?->toAtomString(),
            ]);

        $urls = $urls
            ->concat($blogUrls)
            ->unique('loc')
            ->values();

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
