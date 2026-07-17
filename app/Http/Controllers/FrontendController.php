<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use App\Models\Blog;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function blogIndex(Request $request)
    {
        [$siteSetting, $socialLinks] = $this->frontendSettings();
        $activeArticles = Blog::where('status', true)->latest('published_at')->get();
        $categories = $this->blogCategories($activeArticles);
        $search = trim((string) $request->query('search'));
        $category = trim((string) $request->query('category'));
        $sort = $request->query('sort') === 'oldest' ? 'oldest' : 'latest';

        $articles = Blog::where('status', true)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->orderBy('published_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->get();
        $popularArticles = $activeArticles->take(5);

        return view('frontend.blog.index', compact(
            'siteSetting', 'socialLinks', 'articles', 'categories', 'popularArticles',
            'search', 'category', 'sort'
        ));
    }

    public function blogShow(string $slug)
    {
        [$siteSetting, $socialLinks] = $this->frontendSettings();
        $articles = Blog::where('status', true)->latest('published_at')->get();
        $article = $articles->firstWhere('slug', $slug);

        abort_unless($article, 404);

        $articleIndex = $articles->search(fn ($item) => $item->slug === $slug);
        $previousArticle = $articleIndex > 0 ? $articles->get($articleIndex - 1) : null;
        $nextArticle = $articleIndex < $articles->count() - 1 ? $articles->get($articleIndex + 1) : null;
        $relatedArticles = $articles->where('slug', '!=', $slug)->values();
        $categories = $this->blogCategories($articles);

        return view('frontend.blog.show', compact(
            'siteSetting', 'socialLinks', 'articles', 'article',
            'previousArticle', 'nextArticle', 'relatedArticles', 'categories'
        ));
    }

    private function blogCategories($articles)
    {
        return $articles
            ->filter(fn ($article) => filled($article->category))
            ->groupBy('category')
            ->map(fn ($items, $name) => [
                'name' => $name,
                'count' => $items->count(),
                'icon' => $items->first()->icon ?: 'fa-solid fa-folder-open',
            ])
            ->values();
    }

    private function frontendSettings(): array
    {
        return [
            SiteSetting::first(),
            SocialLink::where('status', true)
                ->whereNotNull('url')
                ->where('url', '!=', '')
                ->orderBy('sort_order')
                ->get(),
        ];
    }


    public function index()
    {
        $projects = Project::where('status', 1)->orderBy('created_at', 'desc')->get();
        $clients = Client::where('status', 1)->whereNotNull('image')->orderBy('created_at', 'asc')->get();
        $testimonials = Testimonial::where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();
        $happyClients = max(120, $clients->count());
        $averageRating = $testimonials->isNotEmpty() ? number_format($testimonials->avg('rating'), 1) : '4.9';
        $faqs = Faq::where('status', true)->orderBy('sort_order')->orderBy('created_at')->get();
        $services = Service::where('status', true)->orderBy('sort_order')->orderBy('created_at')->get();
        $socialLinks = SocialLink::where('status', true)->whereNotNull('url')->where('url', '!=', '')->orderBy('sort_order')->get();
        $siteSetting = SiteSetting::first();
        $blogs = Blog::where('status', true)->latest('published_at')->get();

        return view('frontend.index', compact('projects', 'clients', 'testimonials', 'happyClients', 'averageRating', 'faqs', 'services', 'socialLinks', 'siteSetting', 'blogs'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'regex:/^\+44\s\d{4}\s\d{6}$/'],
            'service' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'phone.required' => 'The phone number field is required.',
            'phone.regex' => 'Please enter a valid UK phone number in this format: +44 7123 456789.',
        ]);

        Message::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!'
        ]);
    }
}
