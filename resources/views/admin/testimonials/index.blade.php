@extends('admin.layouts.admin')

@section('title', 'Manage Reviews')
@section('page_title', 'Client Reviews')

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
        <h3 class="table-title"><i class="fa-solid fa-comments text-red me-2"></i> Client Reviews</h3>
        @if(Auth::user()->role !== 'author')
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-red">
            <i class="fa-solid fa-plus me-2"></i> Add Review
        </a>
        @endif
    </div>

    @if($testimonials->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-regular fa-comments fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No reviews found. Add your first client review using the button above.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Avatar</th>
                        <th>Client</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Order</th>
                        @if(Auth::user()->role !== 'author')
                        <th class="text-end" style="width: 120px;">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                        <tr>
                            <td>
                                <div class="avatar-initial overflow-hidden" style="background: linear-gradient(135deg, #e40914 0%, #7f1d1d 100%);">
                                    @if($testimonial->avatar)
                                        <img src="{{ url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $testimonial->name }}</div>
                                <small class="text-muted">{{ trim(($testimonial->designation ? $testimonial->designation . ', ' : '') . $testimonial->company, ', ') }}</small>
                            </td>
                            <td style="max-width: 420px;">
                                {{ \Illuminate\Support\Str::limit($testimonial->review, 115) }}
                            </td>
                            <td>
                                <span class="text-danger">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $testimonial->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                    @endfor
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $testimonial->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                    {{ $testimonial->is_active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td>{{ $testimonial->sort_order }}</td>
                            @if(Auth::user()->role !== 'author')
                            <td class="text-end">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="action-btn btn-edit" title="Edit Review">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Review">
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
