@extends('admin.layouts.admin')

@section('title', 'Add New Partner')
@section('page_title', 'Create Partner')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-plus text-red me-2"></i> Add New Partner</h3>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-dark-custom btn-sm">
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

            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name">Partner Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-custom" placeholder="e.g. AWS, Microsoft, Google Cloud" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="image">Partner Logo</label>
                    <input type="file" name="image" id="image" class="form-control form-control-custom" accept="image/*" required>
                    <small class="text-muted d-block mt-2">Upload a clean logo image. PNG, JPG, SVG, GIF, or WEBP up to 2MB.</small>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
