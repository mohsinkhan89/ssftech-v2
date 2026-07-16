@extends('admin.layouts.admin')
@section('title', 'Manage Services')
@section('page_title', 'Services')

@section('content')
@if(session('success'))
    <div class="alert alert-custom d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i><div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="custom-table-container">
    <div class="table-title-area">
        <h3 class="table-title"><i class="fa-solid fa-layer-group text-red me-2"></i> Services</h3>
        @if(Auth::user()->role !== 'author')
            <a href="{{ route('admin.services.create') }}" class="btn btn-red"><i class="fa-solid fa-plus me-2"></i> Add Service</a>
        @endif
    </div>
    @if($services->isEmpty())
        <div class="text-center py-5 text-muted"><i class="fa-solid fa-layer-group fa-3x mb-3 text-secondary" style="opacity:.3"></i><p>No services found.</p></div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead><tr><th>Icon</th><th>Service</th><th>Description</th><th>Order</th><th>Status</th>@if(Auth::user()->role !== 'author')<th class="text-end">Actions</th>@endif</tr></thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td><div class="avatar-initial" style="background:linear-gradient(135deg,#e40914,#7f1d1d)"><i class="{{ $service->icon }}"></i></div></td>
                        <td><div class="fw-bold">{{ $service->title }}</div><small class="text-muted">{{ $service->link ?: '#contact' }}</small></td>
                        <td style="max-width:460px">{{ \Illuminate\Support\Str::limit($service->description, 130) }}</td>
                        <td>{{ $service->sort_order }}</td>
                        <td>
                            @if(Auth::user()->role !== 'author')
                                <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST" class="status-toggle-form">@csrf @method('PATCH')
                                    <button type="submit" class="status-toggle-btn {{ $service->status ? 'is-active' : 'is-inactive' }}">{{ $service->status ? 'Active' : 'Inactive' }}</button>
                                </form>
                            @else
                                <span class="badge {{ $service->status ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">{{ $service->status ? 'Active' : 'Inactive' }}</span>
                            @endif
                        </td>
                        @if(Auth::user()->role !== 'author')
                            <td class="text-end">
                                <a href="{{ route('admin.services.edit', $service) }}" class="action-btn btn-edit" title="Edit Service"><i class="fa-solid fa-pencil"></i></a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?')">@csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Service"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
