<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use App\Models\Client;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
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

        return view('frontend.index', compact('projects', 'clients', 'testimonials', 'happyClients', 'averageRating'));
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
