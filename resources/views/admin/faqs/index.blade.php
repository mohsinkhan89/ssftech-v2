@extends('admin.layouts.admin')

@section('title', 'Manage FAQs')
@section('page_title', 'Frequently Asked Questions')

@section('content')
@if(session('success'))
    <div class="alert alert-custom d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="custom-table-container">
    <div class="table-title-area">
        <h3 class="table-title"><i class="fa-solid fa-circle-question text-red me-2"></i> FAQs</h3>
        @if(Auth::user()->role !== 'author')
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-red">
                <i class="fa-solid fa-plus me-2"></i> Add FAQ
            </a>
        @endif
    </div>

    @if($faqs->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-regular fa-circle-question fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No FAQs found. Add your first FAQ using the button above.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Order</th>
                        <th>Status</th>
                        @if(Auth::user()->role !== 'author')
                            <th class="text-end" style="width: 120px;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td class="fw-semibold" style="min-width: 240px;">{{ $faq->question }}</td>
                            <td style="max-width: 480px;">{{ \Illuminate\Support\Str::limit($faq->answer, 140) }}</td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                @if(Auth::user()->role !== 'author')
                                    <form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST" class="status-toggle-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="status-toggle-btn {{ $faq->status ? 'is-active' : 'is-inactive' }}">
                                            {{ $faq->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                @else
                                    <span class="badge {{ $faq->status ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                        {{ $faq->status ? 'Active' : 'Inactive' }}
                                    </span>
                                @endif
                            </td>
                            @if(Auth::user()->role !== 'author')
                                <td class="text-end">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="action-btn btn-edit" title="Edit FAQ">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="Delete FAQ">
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
