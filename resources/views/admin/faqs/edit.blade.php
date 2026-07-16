@extends('admin.layouts.admin')

@section('title', 'Edit FAQ')
@section('page_title', 'Update FAQ')

@section('content')
<div class="row">
    <div class="col-lg-9 col-xl-7 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-pen-to-square text-red me-2"></i> Edit FAQ</h3>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-dark-custom btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger rounded-3 p-3 mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question" class="form-control form-control-custom" value="{{ old('question', $faq->question) }}" maxlength="255" required>
                    </div>
                    <div class="col-12">
                        <label for="answer">Answer</label>
                        <textarea name="answer" id="answer" rows="6" class="form-control form-control-custom" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="sort_order">Display Order</label>
                        <input type="number" min="0" name="sort_order" id="sort_order" class="form-control form-control-custom" value="{{ old('sort_order', $faq->sort_order) }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="status" @checked(old('status', $faq->status))>
                            <label class="form-check-label mb-0" for="status">Show on frontend</label>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold"><i class="fa-solid fa-floppy-disk me-2"></i> Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
