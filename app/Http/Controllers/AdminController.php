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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'project_url' => 'nullable|string|max:255',
        ]);

        $projectData = $request->only(['title', 'category', 'project_url']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Ensure path exists
            $destinationPath = public_path('uploads/projects');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $imageName);
            $projectData['image'] = 'uploads/projects/' . $imageName;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'project_url' => 'nullable|string|max:255',
        ]);

        $projectData = $request->only(['title', 'category', 'project_url']);

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is in the uploads directory
            if ($project->image && File::exists(public_path($project->image))) {
                // Ensure we don't accidentally delete default seeded assets if they are in frontend/assets
                if (str_contains($project->image, 'uploads/projects')) {
                    File::delete(public_path($project->image));
                }
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/projects');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $imageName);
            $projectData['image'] = 'uploads/projects/' . $imageName;
        }

        $project->update($projectData);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    // Delete Project
    public function projectsDestroy(Project $project)
    {
        // Delete image if exists
        if ($project->image && File::exists(public_path($project->image))) {
            if (str_contains($project->image, 'uploads/projects')) {
                File::delete(public_path($project->image));
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

