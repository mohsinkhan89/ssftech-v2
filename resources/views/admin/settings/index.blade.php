@extends('admin.layouts.admin')
@section('title', 'Settings')
@section('page_title', 'Site Settings')

@section('content')
@if(session('success'))<div class="alert alert-custom"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>@endif

<div class="row g-4 mb-4">
    <div class="col-lg-5">
        <div class="custom-table-container h-100 mb-0">
            <h3 class="table-title mb-4"><i class="fa-regular fa-image text-red me-2"></i> Website Logo</h3>
            <div class="p-4 rounded-3 text-center mb-4" style="background:#0f172a;">
                <img src="{{ url($siteSetting->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="Current logo" style="max-width:220px;max-height:100px;object-fit:contain;">
            </div>
            @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.settings.logo') }}" method="POST" enctype="multipart/form-data">@csrf
                    <label for="logo">Upload New Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control form-control-custom" accept=".png,.jpg,.jpeg,.webp,.svg" required>
                    <small class="text-muted d-block mt-2">PNG, JPG, WEBP or SVG. Maximum 2MB.</small>
                    @error('logo')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                    <button class="btn btn-red w-100 mt-4"><i class="fa-solid fa-upload me-2"></i>Update Logo</button>
                </form>
            @endif
        </div>
    </div>
    <div class="col-lg-7">
        <div class="custom-table-container h-100 mb-0">
            <div class="table-title-area"><h3 class="table-title"><i class="fa-solid fa-share-nodes text-red me-2"></i> Social Media Links</h3>@if(Auth::user()->role !== 'author')<a href="{{ route('admin.social-links.create') }}" class="btn btn-red"><i class="fa-solid fa-plus me-2"></i>Add Link</a>@endif</div>
            @if($socialLinks->isEmpty())
                <div class="text-center py-5 text-muted"><p>No social links added yet.</p></div>
            @else
                <div class="table-responsive"><table class="table custom-table"><thead><tr><th>Platform</th><th>URL</th><th>Status</th>@if(Auth::user()->role !== 'author')<th class="text-end">Actions</th>@endif</tr></thead><tbody>
                @foreach($socialLinks as $socialLink)<tr>
                    <td><i class="{{ $socialLink->icon }} text-danger me-2"></i><strong>{{ $socialLink->platform }}</strong></td>
                    <td>@if($socialLink->url)<a href="{{ $socialLink->url }}" target="_blank" rel="noopener" class="text-decoration-none">{{ \Illuminate\Support\Str::limit($socialLink->url, 32) }}</a>@else<span class="text-muted">Not set</span>@endif</td>
                    <td>@if(Auth::user()->role !== 'author')<form action="{{ route('admin.social-links.toggle-status', $socialLink) }}" method="POST" class="status-toggle-form">@csrf @method('PATCH')<button class="status-toggle-btn {{ $socialLink->status ? 'is-active' : 'is-inactive' }}">{{ $socialLink->status ? 'Active' : 'Inactive' }}</button></form>@else{{ $socialLink->status ? 'Active' : 'Inactive' }}@endif</td>
                    @if(Auth::user()->role !== 'author')<td class="text-end"><a href="{{ route('admin.social-links.edit', $socialLink) }}" class="action-btn btn-edit"><i class="fa-solid fa-pencil"></i></a><form action="{{ route('admin.social-links.destroy', $socialLink) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this social link?')">@csrf @method('DELETE')<button class="action-btn btn-delete"><i class="fa-solid fa-trash-can"></i></button></form></td>@endif
                </tr>@endforeach
                </tbody></table></div>
            @endif
        </div>
    </div>
</div>

<div class="custom-table-container">
    <div class="row g-4 align-items-start">
        <div class="col-lg-4">
            <h3 class="table-title mb-2"><i class="fa-solid fa-address-book text-red me-2"></i> Footer Contact Details</h3>
            <p class="text-muted small mb-0">Empty fields are automatically hidden from the footer. If all fields are empty, the complete Contact Us column will be hidden.</p>
        </div>
        <div class="col-lg-8">
            @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.settings.contact-details') }}" method="POST">@csrf @method('PUT')
                    <div class="row g-3 align-items-end">
                        <div class="col-xl-4 col-md-6">
                            <label for="contact_address">Address</label>
                            <input type="text" name="contact_address" id="contact_address" class="form-control form-control-custom" value="{{ old('contact_address', $siteSetting->contact_address) }}" placeholder="Business address">
                            @error('contact_address')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <label for="contact_phone">Phone Number</label>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control form-control-custom" value="{{ old('contact_phone', $siteSetting->contact_phone) }}" placeholder="+44 7773 941324">
                            @error('contact_phone')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <label for="contact_email">Email / Gmail</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control form-control-custom" value="{{ old('contact_email', $siteSetting->contact_email) }}" placeholder="info@example.com">
                            @error('contact_email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-2 col-md-6">
                            <button class="btn btn-red w-100" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i>Save</button>
                        </div>
                    </div>
                </form>
            @else
                <p><strong>Address:</strong> {{ $siteSetting->contact_address ?: 'Not set' }}</p>
                <p><strong>Phone:</strong> {{ $siteSetting->contact_phone ?: 'Not set' }}</p>
                <p class="mb-0"><strong>Email:</strong> {{ $siteSetting->contact_email ?: 'Not set' }}</p>
            @endif
        </div>
    </div>
</div>

<div class="custom-table-container">
    <div class="row align-items-center g-4">
        <div class="col-lg-4">
            <h3 class="table-title mb-2"><i class="fa-solid fa-envelope-circle-check text-red me-2"></i> Enquiry Email Notifications</h3>
            <p class="text-muted small mb-0">New website enquiry details will be sent to these admin email addresses. Add multiple recipients using commas.</p>
        </div>
        <div class="col-lg-8">
            @if(config('mail.default') === 'log')
                <div class="alert alert-warning py-2 px-3 mb-3"><i class="fa-solid fa-triangle-exclamation me-2"></i>Email delivery is in <strong>log mode</strong>. Configure SMTP in the server <code>.env</code> to deliver emails to inboxes.</div>
            @endif
            @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.settings.notification-emails') }}" method="POST">@csrf @method('PUT')
                    <div class="row g-3 align-items-end">
                        <div class="col-md-10">
                            <label for="notification_emails">Admin Notification Emails</label>
                            <input type="text" name="notification_emails" id="notification_emails" class="form-control form-control-custom" value="{{ old('notification_emails', $siteSetting->notification_emails) }}" placeholder="admin@example.com, manager@example.com">
                            @error('notification_emails')<small class="text-danger d-block">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-2"><button class="btn btn-red w-100" type="submit"><i class="fa-solid fa-floppy-disk me-1"></i> Save</button></div>
                    </div>
                </form>
            @else
                <small class="text-muted">Notification Emails</small>
                <strong class="d-block">{{ $siteSetting->notification_emails ?: 'Not set' }}</strong>
            @endif
        </div>
    </div>
</div>

<div class="custom-table-container">
    <div class="row align-items-center g-4">
        <div class="col-lg-4">
            <h3 class="table-title mb-2"><i class="fa-solid fa-code text-red me-2"></i> Asset Versions</h3>
            <p class="text-muted small mb-0">Change a version after updating CSS or JavaScript to clear visitors' browser cache.</p>
        </div>
        <div class="col-lg-8">
            @if(Auth::user()->role !== 'author')
                <form action="{{ route('admin.settings.asset-versions') }}" method="POST">@csrf @method('PUT')
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="css_version">CSS Version</label>
                            <input type="text" name="css_version" id="css_version" class="form-control form-control-custom" value="{{ old('css_version', $siteSetting->css_version ?: '1.0.0') }}" placeholder="1.0.0" required>
                            @error('css_version')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-5">
                            <label for="js_version">JS Version</label>
                            <input type="text" name="js_version" id="js_version" class="form-control form-control-custom" value="{{ old('js_version', $siteSetting->js_version ?: '1.0.0') }}" placeholder="1.0.0" required>
                            @error('js_version')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-md-2"><button class="btn btn-red w-100" type="submit"><i class="fa-solid fa-rotate me-1"></i> Update</button></div>
                    </div>
                </form>
            @else
                <div class="row"><div class="col-6"><small class="text-muted">CSS Version</small><strong class="d-block">{{ $siteSetting->css_version }}</strong></div><div class="col-6"><small class="text-muted">JS Version</small><strong class="d-block">{{ $siteSetting->js_version }}</strong></div></div>
            @endif
        </div>
    </div>
</div>
@endsection
