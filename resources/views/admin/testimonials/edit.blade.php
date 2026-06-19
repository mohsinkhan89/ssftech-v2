@extends('admin.layouts.admin')

@section('title', 'Edit Review')
@section('page_title', 'Modify Review')

@section('content')
<div class="row">
    <div class="col-lg-9 col-xl-7 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-pencil text-red me-2"></i> Edit Client Review</h3>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-dark-custom btn-sm">
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

            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name">Client Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-custom" value="{{ old('name', $testimonial->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company" class="form-control form-control-custom" value="{{ old('company', $testimonial->company) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control form-control-custom" value="{{ old('designation', $testimonial->designation) }}">
                    </div>
                    <div class="col-md-3">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-select form-select-custom" required>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ $i }}/5</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sort_order">Order</label>
                        <input type="number" min="0" name="sort_order" id="sort_order" class="form-control form-control-custom" value="{{ old('sort_order', $testimonial->sort_order) }}">
                    </div>
                    <div class="col-12">
                        <label for="review">Review Text</label>
                        <textarea name="review" id="review" rows="5" class="form-control form-control-custom" required>{{ old('review', $testimonial->review) }}</textarea>
                    </div>
                    <div class="col-md-8">
                        <label for="avatar">Client Avatar</label>
                        <input type="file" name="avatar" id="avatar" class="form-control form-control-custom" accept="image/*">
                        <small class="text-muted d-block mt-2">Leave empty to keep current image.</small>
                    </div>
                    <div class="col-md-4">
                        @if($testimonial->avatar)
                            <img src="{{ url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="rounded-circle mb-3" style="width: 76px; height: 76px; object-fit: cover;">
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $testimonial->is_active))>
                            <label class="form-check-label mb-0" for="is_active">Show on frontend</label>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
