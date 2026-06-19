@extends('admin.layouts.admin')

@section('title', 'Manage Projects')
@section('page_title', 'Portfolio Projects')

@section('content')

@if(session('success'))
    <div class="alert alert-custom d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-whitems-auto" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1); background: none; border: none; font-size: 20px; float: right;"><i class="fa-solid fa-xmark"></i></button>
    </div>
@endif

<div class="custom-table-container">
    <div class="table-title-area">
        <h3 class="table-title"><i class="fa-solid fa-layer-group text-red me-2"></i> Current Projects</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-red">
            <i class="fa-solid fa-plus me-2"></i> Add Project
        </a>
    </div>

    @if($projects->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No projects found. Add your first project using the button above.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 100px;">Visual</th>
                        <th>Project Title</th>
                        <th>Category</th>
                        <th>Target URL</th>
                        <th>Created At</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>
                                @if($project->image)
                                    <img src="{{ url($project->image) }}" alt="{{ $project->title }}" class="rounded" style="width: 70px; height: 45px; object-fit: cover; border: 1px solid var(--border-color);">
                                @else
                                    <div class="rounded bg-dark d-flex align-items-center justify-content-center text-secondary" style="width: 70px; height: 45px;">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $project->title }}</div>
                            </td>
                            <td>
                                <span class="badge badge-cat badge-{{ $project->category }}">
                                    {{ $project->category == 'webapp' ? 'Web App' : ($project->category == 'ecommerce' ? 'E-Commerce' : 'Website') }}
                                </span>
                            </td>
                            <td>
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="text-info text-decoration-none d-inline-flex align-items-center gap-1">
                                        {{ Str::limit($project->project_url, 30) }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
                                    </a>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>{{ $project->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="action-btn btn-edit" title="Edit Project">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Project">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
