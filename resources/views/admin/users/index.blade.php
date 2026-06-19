@extends('admin.layouts.admin')

@section('title', 'Manage System Users')
@section('page_title', 'Users Management')

@section('content')

@if(session('success'))
    <div class="alert alert-custom d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close btn-close-whitems-auto" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1); background: none; border: none; font-size: 20px; float: right;"><i class="fa-solid fa-xmark"></i></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger bg-danger-subtle border-danger-subtle text-danger alert-dismissible fade show rounded-3 p-3 mb-4" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close btn-close-whitems-auto" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1); background: none; border: none; font-size: 20px; float: right;"><i class="fa-solid fa-xmark"></i></button>
    </div>
@endif

<div class="custom-table-container">
    <div class="table-title-area">
        <h3 class="table-title"><i class="fa-solid fa-users text-red me-2"></i> System Users</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-red">
            <i class="fa-solid fa-user-plus me-2"></i> Add New User
        </a>
    </div>

    @if($users->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-users fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No system users found.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $bgGradients = [
                            'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)',
                            'linear-gradient(135deg, #10b981 0%, #047857 100%)',
                            'linear-gradient(135deg, #a855f7 0%, #6b21a8 100%)',
                            'linear-gradient(135deg, #f59e0b 0%, #b45309 100%)',
                            'linear-gradient(135deg, #ec4899 0%, #be185d 100%)'
                        ];
                    @endphp
                    @foreach($users as $user)
                        @php
                            $firstLetter = strtoupper(substr($user->name, 0, 1));
                            $gradientIndex = ord($firstLetter) % count($bgGradients);
                            $bgGradient = $bgGradients[$gradientIndex];
                        @endphp
                        <tr>
                            <td>
                                <div class="avatar-initial" style="background: {{ $bgGradient }};">{{ $firstLetter }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->name }} @if($user->id === Auth::id()) <span class="badge bg-dark ms-1">You</span> @endif</div>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-info text-decoration-none">{{ $user->email }}</a>
                            </td>
                            <td>
                                @if($user->role === 'administrator')
                                    <span class="badge bg-danger rounded-pill px-3 py-2 text-uppercase fs-8" style="letter-spacing: 0.5px;">Super Admin</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge bg-primary rounded-pill px-3 py-2 text-uppercase fs-8" style="letter-spacing: 0.5px;">Admin</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2 text-uppercase fs-8" style="letter-spacing: 0.5px;">Author</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn btn-edit" title="Edit User">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                @if($user->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete User">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="action-btn btn-delete" style="opacity: 0.4; cursor: not-allowed;" title="You cannot delete yourself" disabled>
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
