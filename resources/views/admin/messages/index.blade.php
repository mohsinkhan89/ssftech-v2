@extends('admin.layouts.admin')

@section('title', 'Customer Inquiries')
@section('page_title', 'Contact Messages')

@section('content')

@if(session('success'))
    <div class="alert alert-custom d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1); background: none; border: none; font-size: 20px; float: right;"><i class="fa-solid fa-xmark"></i></button>
    </div>
@endif

<div class="custom-table-container">
    <div class="table-title-area mb-4">
        <h3 class="table-title"><i class="fa-solid fa-inbox text-red me-2"></i> Received Messages</h3>
    </div>

    @if($messages->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fa-regular fa-envelope-open fa-3x mb-3 text-secondary" style="opacity: 0.3;"></i>
            <p>No customer messages or inquiries found.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Sender Name</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Service Requested</th>
                        <th>Received Date</th>
                        <th class="text-end" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $msg)
                        <tr class="{{ $msg->read_at ? '' : 'table-danger-subtle' }}">
                            <td>
                                <div class="fw-bold">{{ $msg->name }} @if(!$msg->read_at)<span class="badge bg-danger ms-1">New</span>@endif</div>
                            </td>
                            <td>
                                <a href="mailto:{{ $msg->email }}" class="text-info text-decoration-none">{{ $msg->email }}</a>
                            </td>
                            <td>
                                @if($msg->phone)
                                    <a href="tel:{{ $msg->phone }}" class="text-secondary text-decoration-none">{{ $msg->phone }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-cat badge-website">
                                    {{ $msg->service ?? 'General Inquiry' }}
                                </span>
                            </td>
                            <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="action-btn btn-view" title="View Message Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if(Auth::user()->role !== 'author')
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete Message">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
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
