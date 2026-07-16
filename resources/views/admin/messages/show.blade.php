@extends('admin.layouts.admin')

@section('title', 'Message Details')
@section('page_title', 'Inquiry Details')

@section('styles')
<style>
    .message-detail-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px;
    }

    .message-detail-label {
        color: #64748b;
        display: block;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .message-detail-value {
        color: #0f172a;
        font-size: 15px;
        font-weight: 600;
        word-break: break-word;
    }

    .message-date-row {
        border-top: 1px dashed #cbd5e1;
        margin-top: 6px;
        padding-top: 18px;
    }

    .message-body-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        color: #334155;
        font-size: 15px;
        line-height: 1.75;
        min-height: 150px;
        padding: 22px;
        white-space: pre-wrap;
    }

    .message-actions {
        gap: 14px;
    }

    @media (max-width: 575px) {
        .message-actions,
        .message-actions form,
        .message-actions .btn {
            width: 100%;
        }

        .message-actions {
            align-items: stretch !important;
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-9 col-lg-10 mx-auto">
        <div class="custom-table-container">
            <!-- Header actions -->
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-envelope-open text-red me-2"></i> Message from {{ $message->name }}</h3>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-dark-custom btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <!-- Details grid -->
            @php
                $service = $message->service ?? 'General Inquiry';
                $serviceClass = 'website';

                if (str_contains(strtolower($service), 'marketing')) {
                    $serviceClass = 'ecommerce';
                } elseif (str_contains(strtolower($service), 'design')) {
                    $serviceClass = 'webapp';
                }
            @endphp

            <div class="message-detail-card row g-4 mb-4">
                <div class="col-md-6">
                    <span class="message-detail-label">Sender Name</span>
                    <strong class="message-detail-value">{{ $message->name }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="message-detail-label">Email Address</span>
                    <a href="mailto:{{ $message->email }}" class="text-info fw-semibold text-decoration-none d-inline-flex align-items-center gap-1">
                        {{ $message->email }} <i class="fa-solid fa-paper-plane" style="font-size: 11px;"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <span class="message-detail-label">Phone Number</span>
                    @if($message->phone)
                        <a href="tel:{{ $message->phone }}" class="message-detail-value text-decoration-none">{{ $message->phone }}</a>
                    @else
                        <span class="text-muted">Not Provided</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <span class="message-detail-label">Service Requested</span>
                    <span class="badge badge-cat badge-{{ $serviceClass }} mt-1">{{ $service }}</span>
                </div>
                <div class="col-12 message-date-row">
                    <span class="message-detail-label">Date Received</span>
                    <span class="message-detail-value">{{ $message->created_at->format('l, F d, Y - h:i A') }} ({{ $message->created_at->diffForHumans() }})</span>
                </div>
            </div>

            <!-- Message Body -->
            <div class="mb-4">
                <label class="d-block mb-2">Message Body</label>
                <div class="message-body-box">{{ $message->message }}</div>
            </div>

            <!-- Footer actions -->
            <div class="message-actions d-flex justify-content-between align-items-center">
                <a href="mailto:{{ $message->email }}?subject=Re: SSF Tech Inquiry ({{ $message->service ?? 'Inquiry' }})" class="btn btn-red">
                    <i class="fa-solid fa-reply me-2"></i> Reply via Email
                </a>

                @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message permanently?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-trash-can me-1"></i> Delete Message
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
