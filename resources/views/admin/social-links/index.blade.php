@extends('admin.layouts.admin')
@section('title', 'Social Links')
@section('page_title', 'Social Media Links')
@section('content')
@if(session('success'))<div class="alert alert-custom"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>@endif
<div class="custom-table-container">
    <div class="table-title-area"><h3 class="table-title"><i class="fa-solid fa-share-nodes text-red me-2"></i> Social Links</h3>@if(Auth::user()->role !== 'author')<a href="{{ route('admin.social-links.create') }}" class="btn btn-red"><i class="fa-solid fa-plus me-2"></i>Add Link</a>@endif</div>
    @if($socialLinks->isEmpty())
        <div class="text-center py-5 text-muted"><i class="fa-solid fa-share-nodes fa-3x mb-3 text-secondary" style="opacity:.3"></i><p>No social links added yet.</p></div>
    @else
    <div class="table-responsive"><table class="table custom-table">
        <thead><tr><th>Icon</th><th>Platform</th><th>URL</th><th>Order</th><th>Status</th>@if(Auth::user()->role !== 'author')<th class="text-end">Actions</th>@endif</tr></thead>
        <tbody>@foreach($socialLinks as $socialLink)<tr>
            <td><div class="avatar-initial" style="background:linear-gradient(135deg,#e40914,#7f1d1d)"><i class="{{ $socialLink->icon }}"></i></div></td>
            <td class="fw-bold">{{ $socialLink->platform }}</td>
            <td style="max-width:380px">@if($socialLink->url)<a href="{{ $socialLink->url }}" target="_blank" rel="noopener" class="text-decoration-none">{{ \Illuminate\Support\Str::limit($socialLink->url, 55) }}</a>@else<span class="text-muted">Not set</span>@endif</td>
            <td>{{ $socialLink->sort_order }}</td>
            <td>@if(Auth::user()->role !== 'author')<form action="{{ route('admin.social-links.toggle-status', $socialLink) }}" method="POST" class="status-toggle-form">@csrf @method('PATCH')<button class="status-toggle-btn {{ $socialLink->status ? 'is-active' : 'is-inactive' }}">{{ $socialLink->status ? 'Active' : 'Inactive' }}</button></form>@else<span class="badge {{ $socialLink->status ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">{{ $socialLink->status ? 'Active' : 'Inactive' }}</span>@endif</td>
            @if(Auth::user()->role !== 'author')<td class="text-end"><a href="{{ route('admin.social-links.edit', $socialLink) }}" class="action-btn btn-edit"><i class="fa-solid fa-pencil"></i></a><form action="{{ route('admin.social-links.destroy', $socialLink) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this social link?')">@csrf @method('DELETE')<button class="action-btn btn-delete"><i class="fa-solid fa-trash-can"></i></button></form></td>@endif
        </tr>@endforeach</tbody>
    </table></div>
    @endif
</div>
@endsection
