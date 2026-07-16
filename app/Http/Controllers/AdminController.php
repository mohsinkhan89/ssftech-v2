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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('admin.login');
    }

    // Handle login submission
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    // Dashboard
    public function dashboard()
    {
        $projectsCount = Project::count();
        $messagesCount = Message::count();
        $clientsCount = Client::count();
        $testimonialsCount = Testimonial::count();
        $faqsCount = Faq::count();
        $servicesCount = Service::count();
        $socialLinksCount = SocialLink::count();
        $usersCount = User::count();
        $recentMessages = Message::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('projectsCount', 'messagesCount', 'clientsCount', 'testimonialsCount', 'faqsCount', 'servicesCount', 'socialLinksCount', 'usersCount', 'recentMessages'));
    }

    // List Projects
    public function projectsIndex()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    // Create Project Form
    public function projectsCreate()
    {
        return view('admin.projects.create');
    }

    // Store Project
    public function projectsStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:website,ecommerce,webapp',
            'image_desktop' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'project_url' => 'nullable|string|max:255',
        ]);

        $projectData = $request->only(['title', 'category', 'project_url']);
        
        $destinationPath = public_path('uploads/projects');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Upload desktop image
        if ($request->hasFile('image_desktop')) {
            $image = $request->file('image_desktop');
            $imageName = time() . '_desktop_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_desktop'] = 'uploads/projects/' . $imageName;
        }

        // Upload tablet image
        if ($request->hasFile('image_tablet')) {
            $image = $request->file('image_tablet');
            $imageName = time() . '_tablet_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_tablet'] = 'uploads/projects/' . $imageName;
        }

        // Upload mobile image
        if ($request->hasFile('image_mobile')) {
            $image = $request->file('image_mobile');
            $imageName = time() . '_mobile_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_mobile'] = 'uploads/projects/' . $imageName;
        }

        Project::create($projectData);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    // Edit Project Form
    public function projectsEdit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    // Update Project
    public function projectsUpdate(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:website,ecommerce,webapp',
            'image_desktop' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_tablet' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'project_url' => 'nullable|string|max:255',
        ]);

        $projectData = $request->only(['title', 'category', 'project_url']);

        $destinationPath = public_path('uploads/projects');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Update desktop image
        if ($request->hasFile('image_desktop')) {
            if ($project->image_desktop && File::exists(public_path($project->image_desktop))) {
                if (str_contains($project->image_desktop, 'uploads/projects')) {
                    File::delete(public_path($project->image_desktop));
                }
            }
            $image = $request->file('image_desktop');
            $imageName = time() . '_desktop_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_desktop'] = 'uploads/projects/' . $imageName;
        }

        // Update tablet image
        if ($request->hasFile('image_tablet')) {
            if ($project->image_tablet && File::exists(public_path($project->image_tablet))) {
                if (str_contains($project->image_tablet, 'uploads/projects')) {
                    File::delete(public_path($project->image_tablet));
                }
            }
            $image = $request->file('image_tablet');
            $imageName = time() . '_tablet_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_tablet'] = 'uploads/projects/' . $imageName;
        }

        // Update mobile image
        if ($request->hasFile('image_mobile')) {
            if ($project->image_mobile && File::exists(public_path($project->image_mobile))) {
                if (str_contains($project->image_mobile, 'uploads/projects')) {
                    File::delete(public_path($project->image_mobile));
                }
            }
            $image = $request->file('image_mobile');
            $imageName = time() . '_mobile_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $projectData['image_mobile'] = 'uploads/projects/' . $imageName;
        }

        $project->update($projectData);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    // Delete Project
    public function projectsDestroy(Project $project)
    {
        // Delete desktop image if exists
        if ($project->image_desktop && File::exists(public_path($project->image_desktop))) {
            if (str_contains($project->image_desktop, 'uploads/projects')) {
                File::delete(public_path($project->image_desktop));
            }
        }
        
        // Delete tablet image if exists
        if ($project->image_tablet && File::exists(public_path($project->image_tablet))) {
            if (str_contains($project->image_tablet, 'uploads/projects')) {
                File::delete(public_path($project->image_tablet));
            }
        }

        // Delete mobile image if exists
        if ($project->image_mobile && File::exists(public_path($project->image_mobile))) {
            if (str_contains($project->image_mobile, 'uploads/projects')) {
                File::delete(public_path($project->image_mobile));
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    public function projectsToggleStatus(Project $project)
    {
        $project->update(['status' => $project->status ? 0 : 1]);

        return redirect()->route('admin.projects.index')->with('success', 'Project status updated successfully!');
    }

    // List Messages
    public function messagesIndex()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    // Show Message Detail
    public function messagesShow(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    // Delete Message
    public function messagesDestroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully!');
    }

    // List Clients
    public function clientsIndex()
    {
        $clients = Client::orderBy('created_at', 'desc')->get();
        return view('admin.clients.index', compact('clients'));
    }

    // Create Client Form
    public function clientsCreate()
    {
        return view('admin.clients.create');
    }

    // Store Client
    public function clientsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $destinationPath = public_path('uploads/clients');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $image = $request->file('image');
        $imageName = time() . '_client_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        $data['image'] = 'uploads/clients/' . $imageName;

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Partner created successfully!');
    }

    // Edit Client Form
    public function clientsEdit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    // Update Client
    public function clientsUpdate(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => ($client->image ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($client->image && File::exists(public_path($client->image)) && str_contains($client->image, 'uploads/clients')) {
                File::delete(public_path($client->image));
            }

            $destinationPath = public_path('uploads/clients');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = time() . '_client_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/clients/' . $imageName;
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Partner updated successfully!');
    }

    // Delete Client
    public function clientsDestroy(Client $client)
    {
        if ($client->image && File::exists(public_path($client->image)) && str_contains($client->image, 'uploads/clients')) {
            File::delete(public_path($client->image));
        }

        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Partner deleted successfully!');
    }

    public function clientsToggleStatus(Client $client)
    {
        $client->update(['status' => $client->status ? 0 : 1]);

        return redirect()->route('admin.clients.index')->with('success', 'Partner status updated successfully!');
    }

    public function testimonialsIndex()
    {
        $testimonials = Testimonial::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialsCreate()
    {
        return view('admin.testimonials.create');
    }

    public function testimonialsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['status'] = $request->boolean('is_active') ? 1 : 0;
        $data['is_active'] = (bool) $data['status'];

        if ($request->hasFile('avatar')) {
            $destinationPath = public_path('uploads/testimonials');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image = $request->file('avatar');
            $imageName = time() . '_testimonial_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['avatar'] = 'uploads/testimonials/' . $imageName;
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Review created successfully!');
    }

    public function testimonialsEdit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function testimonialsUpdate(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['status'] = $request->boolean('is_active') ? 1 : 0;
        $data['is_active'] = (bool) $data['status'];

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && File::exists(public_path($testimonial->avatar)) && str_contains($testimonial->avatar, 'uploads/testimonials')) {
                File::delete(public_path($testimonial->avatar));
            }

            $destinationPath = public_path('uploads/testimonials');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image = $request->file('avatar');
            $imageName = time() . '_testimonial_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $data['avatar'] = 'uploads/testimonials/' . $imageName;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Review updated successfully!');
    }

    public function testimonialsDestroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar && File::exists(public_path($testimonial->avatar)) && str_contains($testimonial->avatar, 'uploads/testimonials')) {
            File::delete(public_path($testimonial->avatar));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Review deleted successfully!');
    }

    public function testimonialsToggleStatus(Testimonial $testimonial)
    {
        $status = $testimonial->status ? 0 : 1;
        $testimonial->update([
            'status' => $status,
            'is_active' => (bool) $status,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Review status updated successfully!');
    }

    public function faqsIndex()
    {
        $faqs = Faq::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function faqsCreate()
    {
        return view('admin.faqs.create');
    }

    public function faqsStore(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['status'] = $request->boolean('status');
        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully!');
    }

    public function faqsEdit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function faqsUpdate(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['status'] = $request->boolean('status');
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully!');
    }

    public function faqsToggleStatus(Faq $faq)
    {
        $faq->update(['status' => ! $faq->status]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ status updated successfully!');
    }

    public function faqsDestroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully!');
    }

    public function servicesIndex()
    {
        $services = Service::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function servicesCreate()
    {
        return view('admin.services.create');
    }

    public function servicesStore(Request $request)
    {
        $data = $this->validateService($request);
        $data['status'] = $request->boolean('status');
        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function servicesEdit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function servicesUpdate(Request $request, Service $service)
    {
        $data = $this->validateService($request);
        $data['status'] = $request->boolean('status');
        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function servicesToggleStatus(Service $service)
    {
        $service->update(['status' => ! $service->status]);

        return redirect()->route('admin.services.index')->with('success', 'Service status updated successfully!');
    }

    public function servicesDestroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }

    private function validateService(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9 -]+$/i'],
            'link' => ['nullable', 'string', 'max:255', 'regex:/^(#|\/|https?:\/\/)/i'],
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['link'] = $data['link'] ?: '#contact';

        return $data;
    }

    public function socialLinksIndex()
    {
        $socialLinks = SocialLink::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function socialLinksCreate()
    {
        return view('admin.social-links.create');
    }

    public function socialLinksStore(Request $request)
    {
        $data = $this->validateSocialLink($request);
        $data['status'] = $request->boolean('status');
        SocialLink::create($data);
        return redirect()->route('admin.settings.index')->with('success', 'Social link created successfully!');
    }

    public function socialLinksEdit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function socialLinksUpdate(Request $request, SocialLink $socialLink)
    {
        $data = $this->validateSocialLink($request);
        $data['status'] = $request->boolean('status');
        $socialLink->update($data);
        return redirect()->route('admin.settings.index')->with('success', 'Social link updated successfully!');
    }

    public function socialLinksToggleStatus(SocialLink $socialLink)
    {
        $socialLink->update(['status' => ! $socialLink->status]);
        return redirect()->route('admin.settings.index')->with('success', 'Social link status updated successfully!');
    }

    public function socialLinksDestroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Social link deleted successfully!');
    }

    private function validateSocialLink(Request $request): array
    {
        $data = $request->validate([
            'platform' => 'required|string|max:100',
            'url' => ['nullable', 'url:http,https', 'max:255'],
            'icon' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9 -]+$/i'],
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        return $data;
    }

    public function settingsIndex()
    {
        $siteSetting = SiteSetting::firstOrCreate([]);
        $socialLinks = SocialLink::orderBy('sort_order')->orderBy('created_at', 'desc')->get();

        return view('admin.settings.index', compact('siteSetting', 'socialLinks'));
    }

    public function settingsUpdateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        $siteSetting = SiteSetting::firstOrCreate([]);
        $destinationPath = public_path('uploads/settings');
        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        if ($siteSetting->logo && str_contains($siteSetting->logo, 'uploads/settings') && File::exists(public_path($siteSetting->logo))) {
            File::delete(public_path($siteSetting->logo));
        }

        $logo = $request->file('logo');
        $logoName = time() . '_logo_' . uniqid() . '.' . $logo->getClientOriginalExtension();
        $logo->move($destinationPath, $logoName);
        $siteSetting->update(['logo' => 'uploads/settings/' . $logoName]);

        return redirect()->route('admin.settings.index')->with('success', 'Site logo updated successfully!');
    }

    // List Users
    public function usersIndex()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    // Create User Form
    public function usersCreate()
    {
        return view('admin.users.create');
    }

    // Store User
    public function usersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:administrator,admin,author',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    // Edit User Form
    public function usersEdit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function usersUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:administrator,admin,author',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Delete User
    public function usersDestroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->withErrors(['error' => 'You cannot delete your own user account.']);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
