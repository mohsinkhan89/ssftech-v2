@extends('admin.layouts.admin')

@section('title', 'Manage Clients')
@section('page_title', 'Innovative Clients')

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
        <h3 class="table-title"><i class="fa-solid fa-handshake text-red me-2"></i> Trusted Clients</h3>
        @if(Auth::user()->role !== 'author')
        <a href="{{ route('admin.clients.create') }}" class="btn btn-red">
            <i class="fa-solid fa-plus me-2"></i> Add Client
        </a>
        @endif
    </div>

    @if($clients->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-handshake fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No clients found. Add your first client using the button above.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">Icon</th>
                        <th>Client Name</th>
                        <th>Icon Class String</th>
                        <th>Created At</th>
                        @if(Auth::user()->role !== 'author')
                        <th class="text-end" style="width: 120px;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <div class="rounded d-flex align-items-center justify-content-center bg-dark text-white" style="width: 50px; height: 50px; border: 1px solid var(--border-light); font-size: 20px;">
                                    <i class="{{ $client->icon }}"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $client->name }}</div>
                            </td>
                            <td>
                                <code class="text-danger">{{ $client->icon }}</code>
                            </td>
                            <td>{{ $client->created_at->format('M d, Y') }}</td>
                            @if(Auth::user()->role !== 'author')
                            <td class="text-end">
                                <a href="{{ route('admin.clients.edit', $client->id) }}" class="action-btn btn-edit" title="Edit Client">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Client">
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
