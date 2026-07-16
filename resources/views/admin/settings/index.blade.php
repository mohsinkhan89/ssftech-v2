@extends('admin.layouts.admin')
@section('title', 'Settings')
@section('page_title', 'Site Settings')

@section('content')
@if(session('success'))<div class="alert alert-custom"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>@endif

<div class="row g-4 mb-4">
    <div class="col-lg-5">
        <div class="custom-table-container h-100 mb-0">
            <h3 class="table-title mb-4"><i class="fa-regular fa-image text-red me-2"></i> Website Logo</h3>
            <div class="p-4 rounded-3 text-center mb-4" style="background:#0f172a;">
                <img src="{{ url($siteSetting->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="Current logo" style="max-width:220px;max-height:100px;object-fit:contain;">
            </div>
            @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.settings.logo') }}" method="POST" enctype="multipart/form-data">@csrf
                    <label for="logo">Upload New Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control form-control-custom" accept=".png,.jpg,.jpeg,.webp,.svg" required>
                    <small class="text-muted d-block mt-2">PNG, JPG, WEBP or SVG. Maximum 2MB.</small>
                    @error('logo')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                    <button class="btn btn-red w-100 mt-4"><i class="fa-solid fa-upload me-2"></i>Update Logo</button>
                </form>
            @endif
        </div>
    </div>
    <div class="col-lg-7">
        <div class="custom-table-container h-100 mb-0">
            <div class="table-title-area"><h3 class="table-title"><i class="fa-solid fa-share-nodes text-red me-2"></i> Social Media Links</h3>@if(Auth::user()->role !== 'author')<a href="{{ route('admin.social-links.create') }}" class="btn btn-red"><i class="fa-solid fa-plus me-2"></i>Add Link</a>@endif</div>
            @if($socialLinks->isEmpty())
                <div class="text-center py-5 text-muted"><p>No social links added yet.</p></div>
            @else
                <div class="table-responsive"><table class="table custom-table"><thead><tr><th>Platform</th><th>URL</th><th>Status</th>@if(Auth::user()->role !== 'author')<th class="text-end">Actions</th>@endif</tr></thead><tbody>
                @foreach($socialLinks as $socialLink)<tr>
                    <td><i class="{{ $socialLink->icon }} text-danger me-2"></i><strong>{{ $socialLink->platform }}</strong></td>
                    <td>@if($socialLink->url)<a href="{{ $socialLink->url }}" target="_blank" rel="noopener" class="text-decoration-none">{{ \Illuminate\Support\Str::limit($socialLink->url, 32) }}</a>@else<span class="text-muted">Not set</span>@endif</td>
                    <td>@if(Auth::user()->role !== 'author')<form action="{{ route('admin.social-links.toggle-status', $socialLink) }}" method="POST" class="status-toggle-form">@csrf @method('PATCH')<button class="status-toggle-btn {{ $socialLink->status ? 'is-active' : 'is-inactive' }}">{{ $socialLink->status ? 'Active' : 'Inactive' }}</button></form>@else{{ $socialLink->status ? 'Active' : 'Inactive' }}@endif</td>
                    @if(Auth::user()->role !== 'author')<td class="text-end"><a href="{{ route('admin.social-links.edit', $socialLink) }}" class="action-btn btn-edit"><i class="fa-solid fa-pencil"></i></a><form action="{{ route('admin.social-links.destroy', $socialLink) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this social link?')">@csrf @method('DELETE')<button class="action-btn btn-delete"><i class="fa-solid fa-trash-can"></i></button></form></td>@endif
                </tr>@endforeach
                </tbody></table></div>
            @endif
        </div>
    </div>
</div>
@endsection
