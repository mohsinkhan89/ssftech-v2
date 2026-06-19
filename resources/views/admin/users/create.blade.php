@extends('admin.layouts.admin')

@section('title', 'Add New System User')
@section('page_title', 'Create User')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-user-plus text-red me-2"></i> Add New System User</h3>
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark-custom btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger bg-danger-subtle border-danger-subtle text-danger alert-dismissible fade show rounded-3 p-3 mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-custom" placeholder="e.g. John Doe" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control form-control-custom" placeholder="e.g. john@example.com" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="role">Access Role</label>
                    <select name="role" id="role" class="form-select form-select-custom" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="administrator" {{ old('role') == 'administrator' ? 'selected' : '' }}>Super Administrator (Full Access + User Management)</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Full Access except User Management)</option>
                        <option value="author" {{ old('role') == 'author' ? 'selected' : '' }}>Author (Read-only View Access)</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-custom" placeholder="Min 8 characters" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-custom" placeholder="Re-type password" required>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
