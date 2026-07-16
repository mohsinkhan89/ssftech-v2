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
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function blogIndex()
    {
        $siteSetting = SiteSetting::first();
        $socialLinks = SocialLink::where('status', true)
            ->whereNotNull('url')
            ->where('url', '!=', '')
            ->orderBy('sort_order')
            ->get();

        $articles = collect([
            (object) ['slug' => 'modern-web-design', 'category' => 'Web Design', 'icon' => 'fa-solid fa-globe', 'date' => '14 Feb 2026', 'read_time' => '5 min read', 'title' => 'How Modern Web Design Builds Trust and Conversions', 'excerpt' => 'Discover how clean layouts, speed, and strong UX help businesses turn visitors into customers.', 'image' => 'frontend/assets/images/blog/web-design-insights.png'],
            (object) ['slug' => 'digital-marketing-growth', 'category' => 'Marketing', 'icon' => 'fa-solid fa-bullseye', 'date' => '22 Feb 2026', 'read_time' => '4 min read', 'title' => 'Digital Marketing Strategies That Deliver Real Growth', 'excerpt' => 'Explore proven tactics to boost visibility, generate leads, and create measurable business impact.', 'image' => 'frontend/assets/images/blog/marketing-growth.png'],
            (object) ['slug' => 'brand-identity-online', 'category' => 'Branding', 'icon' => 'fa-solid fa-id-badge', 'date' => '01 Mar 2026', 'read_time' => '6 min read', 'title' => 'Building a Brand Identity That Stands Out Online', 'excerpt' => 'Learn how consistent visuals and messaging help position your business for long-term success.', 'image' => 'frontend/assets/images/blog/brand-identity.png'],
            (object) ['slug' => 'ui-ux-trends-2026', 'category' => 'Design', 'icon' => 'fa-solid fa-pen-ruler', 'date' => '10 Feb 2026', 'read_time' => '6 min read', 'title' => 'UI/UX Trends to Watch in 2026', 'excerpt' => 'Explore the latest UI/UX trends shaping digital experiences and how they impact users and business results.', 'image' => 'frontend/assets/images/blog/web-design-insights.png'],
            (object) ['slug' => 'scalable-web-development', 'category' => 'Development', 'icon' => 'fa-solid fa-code', 'date' => '05 Feb 2026', 'read_time' => '7 min read', 'title' => 'Web Development Best Practices for Scalable Websites', 'excerpt' => 'Follow proven development practices to build fast, secure, and scalable websites that grow with your business.', 'image' => 'frontend/assets/images/blog/marketing-growth.png'],
            (object) ['slug' => 'ai-digital-experiences', 'category' => 'Technology', 'icon' => 'fa-solid fa-microchip', 'date' => '28 Jan 2026', 'read_time' => '5 min read', 'title' => 'How AI Is Transforming Digital Experiences', 'excerpt' => 'From automation to personalization, learn how AI technologies are changing how businesses connect with their audience.', 'image' => 'frontend/assets/images/blog/brand-identity.png'],
        ]);

        return view('frontend.blog.index', compact('siteSetting', 'socialLinks', 'articles'));
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

        if ($testimonials->isEmpty()) {
            $testimonials = collect([
                (object) [
                    'name' => 'Sarah Thompson',
                    'designation' => 'Marketing Director',
                    'company' => 'BrightWave',
                    'review' => 'Excellent communication, timely delivery, and outstanding results. Truly a reliable partner for our digital journey.',
                    'rating' => 5,
                    'avatar' => 'frontend/assets/images/extracted/client-avatar-1.png',
                ],
                (object) [
                    'name' => 'Michael Johnson',
                    'designation' => 'CEO',
                    'company' => 'TechNova Solutions',
                    'review' => 'Their team understood our vision perfectly and delivered a solution that exceeded our expectations. Highly professional and dedicated!',
                    'rating' => 5,
                    'avatar' => 'frontend/assets/images/extracted/client-avatar-2.png',
                ],
                (object) [
                    'name' => 'David Patel',
                    'designation' => 'Founder',
                    'company' => 'InnovateX',
                    'review' => 'From strategy to execution, everything was seamless. They transformed our ideas into real business value.',
                    'rating' => 5,
                    'avatar' => 'frontend/assets/images/extracted/client-avatar-3.png',
                ],
            ]);
        }

        return view('frontend.index', compact('projects', 'clients', 'testimonials', 'happyClients', 'averageRating', 'faqs', 'services', 'socialLinks', 'siteSetting'));
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
