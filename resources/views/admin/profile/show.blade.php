@extends('admin.layouts.admin')
@section('title', 'My Profile')
@section('page_title', 'My Profile')

@section('content')
@if(session('success'))
    <div class="alert alert-custom"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>
@endif

<div class="row g-4">
    <div class="col-lg-4">
        <div class="custom-table-container text-center h-100 mb-0">
            <div class="admin-avatar mx-auto mb-3" style="width:88px;height:88px;border-radius:24px;font-size:32px;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h3 class="h5 fw-bold mb-1">{{ $user->name }}</h3>
            <p class="text-muted mb-3">{{ $user->email }}</p>
            <span class="badge bg-danger-subtle text-danger px-3 py-2 text-capitalize">{{ $user->role }}</span>
            <hr class="my-4">
            <div class="text-start small text-muted">
                <p><i class="fa-regular fa-calendar me-2 text-danger"></i>Account created {{ $user->created_at->format('M d, Y') }}</p>
                <p class="mb-0"><i class="fa-solid fa-shield-halved me-2 text-danger"></i>Authenticated account</p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="custom-table-container mb-4">
            <h3 class="table-title mb-4"><i class="fa-regular fa-user text-red me-2"></i>Profile Information</h3>
            <form action="{{ route('admin.profile.update') }}" method="POST">@csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6"><label for="name">Full Name</label><input class="form-control form-control-custom" id="name" name="name" value="{{ old('name', $user->name) }}" required>@error('name')<small class="text-danger">{{ $message }}</small>@enderror</div>
                    <div class="col-md-6"><label for="email">Email Address</label><input type="email" class="form-control form-control-custom" id="email" name="email" value="{{ old('email', $user->email) }}" required>@error('email')<small class="text-danger">{{ $message }}</small>@enderror</div>
                </div>
                <button class="btn btn-red mt-4"><i class="fa-solid fa-floppy-disk me-2"></i>Save Profile</button>
            </form>
        </div>

        <div class="custom-table-container mb-0" id="password">
            <h3 class="table-title mb-4"><i class="fa-solid fa-lock text-red me-2"></i>Change Password</h3>
            <form action="{{ route('admin.profile.password') }}" method="POST">@csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-12"><label for="current_password">Current Password</label><input type="password" class="form-control form-control-custom" id="current_password" name="current_password" required>@error('current_password')<small class="text-danger">{{ $message }}</small>@enderror</div>
                    <div class="col-md-6"><label for="password">New Password</label><input type="password" class="form-control form-control-custom" id="password" name="password" minlength="8" required>@error('password')<small class="text-danger">{{ $message }}</small>@enderror</div>
                    <div class="col-md-6"><label for="password_confirmation">Confirm Password</label><input type="password" class="form-control form-control-custom" id="password_confirmation" name="password_confirmation" minlength="8" required></div>
                </div>
                <button class="btn btn-red mt-4"><i class="fa-solid fa-key me-2"></i>Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
