<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use App\Models\Client;
use App\Models\Testimonial;
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
        $usersCount = User::count();
        $recentMessages = Message::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('projectsCount', 'messagesCount', 'clientsCount', 'testimonialsCount', 'usersCount', 'recentMessages'));
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
        $data['is_active'] = $request->boolean('is_active');

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
        $data['is_active'] = $request->boolean('is_active');

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
