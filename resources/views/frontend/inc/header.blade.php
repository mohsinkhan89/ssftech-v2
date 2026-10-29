<header class="site-header fixed-top">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand brand-lockup" href="{{ route('index') }}#home" aria-label="SSF Tech home">
                <div class="header-logo">
                    <img src="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech" decoding="async" fetchpriority="high">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#about">About Us</a></li>
                    <li class="nav-item nav-services-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}" aria-haspopup="true">Services <i class="fa-solid fa-chevron-down nav-services-chevron"></i></a>
                        @if($navServices->isNotEmpty())
                            @php
                                $navServiceGroups = collect(\App\Models\Service::CATEGORIES)
                                    ->filter(fn ($label, $key) => $navServices->contains('category', $key));
                            @endphp
                            <div class="nav-services-dropdown" aria-label="Services mega menu">
                                <div class="nav-services-categories" role="tablist" aria-label="Service categories">
                                    <p>Our services</p>
                                    @foreach($navServiceGroups as $categoryKey => $categoryLabel)
                                        <button class="nav-mega-category {{ $loop->first ? 'active' : '' }}" type="button" role="tab" data-mega-category="{{ $categoryKey }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <span>{{ $categoryLabel }}</span><i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    @endforeach
                                </div>
                                <div class="nav-services-panels">
                                    @foreach($navServiceGroups as $categoryKey => $categoryLabel)
                                        <div class="nav-services-panel {{ $loop->first ? 'active' : '' }}" data-mega-panel="{{ $categoryKey }}" role="tabpanel">
                                            <div class="nav-services-panel-head"><small>Explore</small><strong>{{ $categoryLabel }}</strong></div>
                                            <div class="nav-services-links">
                                                @foreach($navServices->where('category', $categoryKey) as $navService)
                                                    <a href="{{ route('services.detail', [$navService->category, \Illuminate\Support\Str::slug($navService->title)]) }}">
                                                        <i class="{{ $navService->icon }}"></i><span>{{ $navService->title }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#portfolio">Portfolio</a></li>
                    @if($hasActiveBlogs)
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}#faqs">FAQs</a></li>
                </ul>
                <a class="btn btn-brand nav-quote" href="{{ route('index') }}#contact">Let's talk <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
    </nav>
</header>
