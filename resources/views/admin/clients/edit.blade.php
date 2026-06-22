@extends('admin.layouts.admin')

@section('title', 'Edit Partner')
@section('page_title', 'Modify Partner')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-pencil text-red me-2"></i> Edit Partner Details</h3>
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

            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Partner Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-custom" placeholder="e.g. AWS, Microsoft, Google Cloud" value="{{ old('name', $client->name) }}" required>
                </div>

                @if($client->image)
                    <div class="mb-3">
                        <label>Current Logo</label>
                        <div class="bg-white rounded-3 border p-3 d-inline-flex align-items-center justify-content-center" style="width: 180px; height: 110px;">
                            <img src="{{ url($client->image) }}" alt="{{ $client->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="image">Replace Partner Logo</label>
                    <input type="file" name="image" id="image" class="form-control form-control-custom" accept="image/*">
                    <small class="text-muted d-block mt-2">Leave empty to keep the current logo. PNG, JPG, SVG, GIF, or WEBP up to 2MB.</small>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Update Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
