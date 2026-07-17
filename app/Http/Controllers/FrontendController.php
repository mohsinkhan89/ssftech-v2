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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

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

        $enquiry = Message::create($validated);
        $siteSetting = SiteSetting::first();
        $emailLogoPath = public_path($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png');
        if (! is_file($emailLogoPath)) {
            $emailLogoPath = public_path('frontend/assets/images/logo/ssf-tech-logo-new.png');
        }

        try {
            Mail::send('emails.enquiry-customer', compact('enquiry', 'siteSetting', 'emailLogoPath'), function ($mail) use ($enquiry) {
                $mail->to($enquiry->email, $enquiry->name)
                    ->subject("Thanks for contacting SSF Tech, {$enquiry->name}");
            });

            $notificationRecipients = $siteSetting?->notification_emails ?: $siteSetting?->contact_email;
            $adminEmails = array_values(array_filter(array_map(
                'trim',
                preg_split('/[,;\r\n]+/', (string) $notificationRecipients)
            ), fn ($email) => filter_var($email, FILTER_VALIDATE_EMAIL)));

            if ($adminEmails) {
                Mail::send('emails.enquiry-admin', compact('enquiry', 'siteSetting', 'emailLogoPath'), function ($mail) use ($enquiry, $adminEmails) {
                    $mail->to($adminEmails)
                        ->replyTo($enquiry->email, $enquiry->name)
                        ->subject("New website enquiry from {$enquiry->name}");
                });
            }
        } catch (Throwable $exception) {
            Log::warning('Contact enquiry saved, but an email could not be sent.', [
                'message_id' => $enquiry->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Thanks {$enquiry->name}! Your message has been received. Please check your email for confirmation."
        ]);
    }
}
