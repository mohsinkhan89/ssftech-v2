@extends('admin.layouts.admin')
@section('title', 'Add Service')
@section('page_title', 'Create Service')

@section('content')
<div class="row"><div class="col-lg-9 col-xl-7 mx-auto"><div class="custom-table-container">
    <div class="table-title-area mb-4"><h3 class="table-title"><i class="fa-solid fa-plus text-red me-2"></i> Add Service</h3><a href="{{ route('admin.services.index') }}" class="btn btn-dark-custom btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> Back to List</a></div>
    @if($errors->any())<div class="alert alert-danger rounded-3 p-3 mb-4"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('admin.services.store') }}" method="POST">@csrf
        <div class="row g-3">
            <div class="col-md-7"><label for="title">Service Title</label><input type="text" name="title" id="title" class="form-control form-control-custom" value="{{ old('title') }}" required></div>
            <div class="col-md-5"><label for="icon">Font Awesome Icon Class</label><input type="text" name="icon" id="icon" class="form-control form-control-custom" value="{{ old('icon', 'fa-solid fa-gear') }}" required><small class="text-muted">Example: fa-solid fa-laptop-code</small></div>
            <div class="col-12"><label for="description">Description</label><textarea name="description" id="description" rows="5" class="form-control form-control-custom" required>{{ old('description') }}</textarea></div>
            <div class="col-md-6"><label for="link">Learn More Link</label><input type="text" name="link" id="link" class="form-control form-control-custom" value="{{ old('link', '#contact') }}"></div>
            <div class="col-md-3"><label for="sort_order">Display Order</label><input type="number" min="0" name="sort_order" id="sort_order" class="form-control form-control-custom" value="{{ old('sort_order', 0) }}"></div>
            <div class="col-md-3 d-flex align-items-end"><div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="status" value="1" id="status" @checked(old('status', true))><label class="form-check-label mb-0" for="status">Show on frontend</label></div></div>
        </div>
        <div class="d-grid mt-4"><button type="submit" class="btn btn-red py-2 fw-semibold"><i class="fa-solid fa-floppy-disk me-2"></i> Save Service</button></div>
    </form>
</div></div></div>
@endsection
