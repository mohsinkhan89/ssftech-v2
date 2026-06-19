<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        $recentMessages = Message::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('projectsCount', 'messagesCount', 'recentMessages'));
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
}

