@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Overview')

@section('content')
@php
    $bgGradients = [
        'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)',
        'linear-gradient(135deg, #10b981 0%, #047857 100%)',
        'linear-gradient(135deg, #a855f7 0%, #6b21a8 100%)',
        'linear-gradient(135deg, #f59e0b 0%, #b45309 100%)',
        'linear-gradient(135deg, #ec4899 0%, #be185d 100%)'
    ];
@endphp

<!-- Statistics Section -->
<div class="dashboard-cards-slider swiper mb-5">
    @php
        $isAdmin = Auth::user()->role === 'administrator';
    @endphp
    <div class="swiper-wrapper">
    <!-- Total Projects Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <span class="card-trend"><i class="fa-solid fa-circle-up me-1"></i> Active</span>
            </div>
            <div>
                <div class="card-value">{{ $projectsCount }}</div>
                <div class="card-label">Total Projects</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $projectsCount * 10)) }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Inquiries Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon" style="background: rgba(16, 185, 129, 0.08); color: #10b981; border-color: rgba(16, 185, 129, 0.15);">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <span class="card-trend" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border-color: rgba(16, 185, 129, 0.15);"><i class="fa-solid fa-bolt me-1"></i> Live</span>
            </div>
            <div>
                <div class="card-value">{{ $messagesCount }}</div>
                <div class="card-label">Total Inquiries</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $messagesCount * 8)) }}%; background: linear-gradient(90deg, #10b981 0%, #34d399 100%); box-shadow: 0 0 8px rgba(16, 185, 129, 0.3);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Partners Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon" style="background: rgba(245, 158, 11, 0.08); color: #f59e0b; border-color: rgba(245, 158, 11, 0.15);">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <span class="card-trend" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; border-color: rgba(245, 158, 11, 0.15);"><i class="fa-solid fa-star me-1"></i> Trusted</span>
            </div>
            <div>
                <div class="card-value">{{ $clientsCount }}</div>
                <div class="card-label">Total Partners</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $clientsCount * 8)) }}%; background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%); box-shadow: 0 0 8px rgba(245, 158, 11, 0.3);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Reviews Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon" style="background: rgba(236, 72, 153, 0.08); color: #ec4899; border-color: rgba(236, 72, 153, 0.15);">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <span class="card-trend" style="background: rgba(236, 72, 153, 0.1); color: #ec4899; border-color: rgba(236, 72, 153, 0.15);"><i class="fa-solid fa-heart me-1"></i> Reviews</span>
            </div>
            <div>
                <div class="card-value">{{ $testimonialsCount }}</div>
                <div class="card-label">Client Reviews</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $testimonialsCount * 12)) }}%; background: linear-gradient(90deg, #ec4899 0%, #f472b6 100%); box-shadow: 0 0 8px rgba(236, 72, 153, 0.3);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total FAQs Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon" style="background: rgba(14, 165, 233, 0.08); color: #0284c7; border-color: rgba(14, 165, 233, 0.15);">
                    <i class="fa-solid fa-circle-question"></i>
                </div>
                <span class="card-trend" style="background: rgba(14, 165, 233, 0.1); color: #0284c7; border-color: rgba(14, 165, 233, 0.15);"><i class="fa-solid fa-list me-1"></i> Content</span>
            </div>
            <div>
                <div class="card-value">{{ $faqsCount }}</div>
                <div class="card-label">Total FAQs</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $faqsCount * 12)) }}%; background: linear-gradient(90deg, #0284c7 0%, #38bdf8 100%);"></div>
                </div>
            </div>
        </div>
    </div>

    @if($isAdmin)
    <!-- Total Users Card -->
    <div class="swiper-slide">
        <div class="dashboard-card">
            <div class="card-icon-wrapper">
                <div class="card-icon" style="background: rgba(168, 85, 247, 0.08); color: #a855f7; border-color: rgba(168, 85, 247, 0.15);">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span class="card-trend" style="background: rgba(168, 85, 247, 0.1); color: #a855f7; border-color: rgba(168, 85, 247, 0.15);"><i class="fa-solid fa-user-shield me-1"></i> Active</span>
            </div>
            <div>
                <div class="card-value">{{ $usersCount }}</div>
                <div class="card-label">System Users</div>
                <div class="card-progress">
                    <div class="card-progress-bar" style="width: {{ min(100, max(15, $usersCount * 25)) }}%; background: linear-gradient(90deg, #a855f7 0%, #c084fc 100%); box-shadow: 0 0 8px rgba(168, 85, 247, 0.3);"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
    <div class="dashboard-cards-arrows" aria-label="Dashboard card slider controls">
        <button class="dashboard-cards-prev" type="button" aria-label="Previous dashboard card">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="dashboard-cards-next" type="button" aria-label="Next dashboard card">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>

<!-- Quick Shortcuts Section -->
<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="custom-table-container">
            <h5 class="fw-bold mb-4" style="font-size: 15px; letter-spacing: 0.5px; text-transform: uppercase; color: var(--text-muted);">Quick Access Shortcuts</h5>
            <div class="row g-3">
                @if(Auth::user()->role !== 'author')
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.projects.create') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="action-info">
                            <h6>Add Project</h6>
                            <p>Upload new work</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.clients.create') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="action-info">
                            <h6>Add Partner</h6>
                            <p>Upload partner logo</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.testimonials.create') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="action-info">
                            <h6>Add Review</h6>
                            <p>Create client review</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.faqs.create') }}" class="action-card">
                        <div class="action-icon"><i class="fa-solid fa-plus"></i></div>
                        <div class="action-info"><h6>Add FAQ</h6><p>Create a new question</p></div>
                    </a>
                </div>
                @endif
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.projects.index') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                        <div class="action-info">
                            <h6>Projects</h6>
                            <p>Manage portfolio</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.clients.index') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>
                        <div class="action-info">
                            <h6>Partners</h6>
                            <p>Manage partner logos</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.testimonials.index') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div class="action-info">
                            <h6>Reviews</h6>
                            <p>Manage testimonials</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.faqs.index') }}" class="action-card">
                        <div class="action-icon"><i class="fa-solid fa-circle-question"></i></div>
                        <div class="action-info"><h6>FAQs</h6><p>Manage questions</p></div>
                    </a>
                </div>
                @if($isAdmin)
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.users.create') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div class="action-info">
                            <h6>Add User</h6>
                            <p>Create system login</p>
                        </div>
                    </a>
                </div>
                @endif
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.messages.index') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-inbox"></i>
                        </div>
                        <div class="action-info">
                            <h6>Inbox</h6>
                            <p>Check messages</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ url('/') }}" target="_blank" class="action-card">
                        <div class="action-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="action-info">
                            <h6>View Site</h6>
                            <p>Open frontend</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="row">
    <div class="col-12">
        <div class="custom-table-container">
            <div class="table-title-area">
                <h3 class="table-title"><i class="fa-solid fa-envelope-open text-red me-2"></i> Recent Inquiries</h3>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-dark-custom btn-sm">View All</a>
            </div>

            @if($recentMessages->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fa-regular fa-envelope fa-3x mb-3 text-secondary" style="opacity: 0.2;"></i>
                    <p class="mb-0">No messages received yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Sender</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Service Required</th>
                                <th>Received At</th>
                                <th class="text-end" style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMessages as $msg)
                                @php
                                    $firstLetter = strtoupper(substr($msg->name, 0, 1));
                                    $gradientIndex = ord($firstLetter) % count($bgGradients);
                                    $bgGradient = $bgGradients[$gradientIndex];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="avatar-initial" style="background: {{ $bgGradient }};">{{ $firstLetter }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $msg->name }}</div>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $msg->email }}" class="text-info text-decoration-none">{{ $msg->email }}</a>
                                    </td>
                                    <td>
                                        @php
                                            $catClass = 'website';
                                            if (str_contains(strtolower($msg->service), 'marketing')) $catClass = 'ecommerce';
                                            elseif (str_contains(strtolower($msg->service), 'design')) $catClass = 'webapp';
                                        @endphp
                                        <span class="badge badge-cat badge-{{ $catClass }}">{{ $msg->service ?? 'General Inquiry' }}</span>
                                    </td>
                                    <td>{{ $msg->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="action-btn btn-view" title="View Message">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete" title="Delete Message">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dashboardSlider = document.querySelector('.dashboard-cards-slider');

        if (!dashboardSlider || !window.Swiper) {
            return;
        }

        new window.Swiper(dashboardSlider, {
            loop: false,
            rewind: false,
            slidesPerView: 1,
            spaceBetween: 18,
            speed: 700,
            grabCursor: true,
            autoplay: {
                delay: 2400,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            navigation: {
                nextEl: '.dashboard-cards-next',
                prevEl: '.dashboard-cards-prev'
            },
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 18
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 24
                }
            }
        });
    });
</script>
@endsection
