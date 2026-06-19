@extends('admin.layouts.admin')

@section('title', 'Message Details')
@section('page_title', 'Inquiry Details')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="custom-table-container">
            <!-- Header actions -->
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-envelope-open text-red me-2"></i> Message from {{ $message->name }}</h3>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-dark-custom btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <!-- Details grid -->
            <div class="row g-3 mb-4 p-3 rounded" style="background: rgba(0, 0, 0, 0.2); border: 1px solid var(--border-color);">
                <div class="col-md-6">
                    <span class="text-secondary d-block fs-7">Sender Name</span>
                    <strong class="fs-6">{{ $message->name }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-secondary d-block fs-7">Email Address</span>
                    <a href="mailto:{{ $message->email }}" class="text-info fw-semibold fs-6 text-decoration-none d-inline-flex align-items-center gap-1">
                        {{ $message->email }} <i class="fa-solid fa-paper-plane" style="font-size: 11px;"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <span class="text-secondary d-block fs-7">Phone Number</span>
                    @if($message->phone)
                        <a href="tel:{{ $message->phone }}" class="text-white fs-6 text-decoration-none">{{ $message->phone }}</a>
                    @else
                        <span class="text-muted fs-6">Not Provided</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <span class="text-secondary d-block fs-7">Service Requested</span>
                    <span class="badge badge-cat badge-website mt-1">{{ $message->service ?? 'General Inquiry' }}</span>
                </div>
                <div class="col-12 mt-3 pt-3 border-top border-secondary" style="border-top-style: dashed !important;">
                    <span class="text-secondary d-block fs-7">Date Received</span>
                    <span class="fs-6 text-white">{{ $message->created_at->format('l, F d, Y - h:i A') }} ({{ $message->created_at->diffForHumans() }})</span>
                </div>
            </div>

            <!-- Message Body -->
            <div class="mb-4">
                <label class="d-block mb-2">Message Body</label>
                <div class="p-4 rounded-3 text-white" style="background: rgba(0,0,0,0.3); border: 1px solid var(--border-color); line-height: 1.7; min-height: 150px; font-size: 15px; white-space: pre-wrap;">{{ $message->message }}</div>
            </div>

            <!-- Footer actions -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="mailto:{{ $message->email }}?subject=Re: SSF Tech Inquiry ({{ $message->service ?? 'Inquiry' }})" class="btn btn-red">
                    <i class="fa-solid fa-reply me-2"></i> Reply via Email
                </a>

                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message permanently?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-trash-can me-1"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
