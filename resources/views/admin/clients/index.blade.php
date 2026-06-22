@extends('admin.layouts.admin')

@section('title', 'Manage Partners')
@section('page_title', 'Trusted Partners')

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
        <h3 class="table-title"><i class="fa-solid fa-handshake text-red me-2"></i> Trusted Partners</h3>
        @if(Auth::user()->role !== 'author')
        <a href="{{ route('admin.clients.create') }}" class="btn btn-red">
            <i class="fa-solid fa-plus me-2"></i> Add Partner
        </a>
        @endif
    </div>

    @if($clients->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-handshake fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No partners found. Add your first partner using the button above.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 150px;">Logo</th>
                        <th>Partner Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        @if(Auth::user()->role !== 'author')
                        <th class="text-end" style="width: 120px;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td style="vertical-align: middle;">
                                <div class="rounded d-flex align-items-center justify-content-center bg-white" style="width: 116px; height: 70px; border: 1px solid var(--border-light); padding: 10px;">
                                    @if($client->image)
                                        <img src="{{ url($client->image) }}" alt="{{ $client->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    @else
                                        <span class="text-muted small">No logo</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $client->name }}</div>
                            </td>
                            <td>
                                @if(Auth::user()->role !== 'author')
                                    <form action="{{ route('admin.clients.toggle-status', $client->id) }}" method="POST" class="status-toggle-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="status-toggle-btn {{ $client->status ? 'is-active' : 'is-inactive' }}">
                                            {{ $client->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                @else
                                    <span class="badge {{ $client->status ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                        {{ $client->status ? 'Active' : 'Inactive' }}
                                    </span>
                                @endif
                            </td>
                            <td>{{ $client->created_at->format('M d, Y') }}</td>
                            @if(Auth::user()->role !== 'author')
                            <td class="text-end">
                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="action-btn btn-edit" title="Edit Partner">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this partner?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Partner">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
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
