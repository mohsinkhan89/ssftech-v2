@extends('frontend.layouts.master')
@section('title')
    <title>SSF Tech | Web Development and Digital Marketing Agency UK</title>
@endsection
@section('metas')
    <meta name="description"
        content="SSF Tech is a UK based web development and digital marketing agency. We design, build and grow websites that deliver real results for your business.">
@endsection
@section('css')
    <style>
        /* Desktop image display (default/preview-desktop) */
        .portfolio-slider .project-img-desktop {
            display: block !important;
        }

        .portfolio-slider .project-img-tablet,
        .portfolio-slider .project-img-mobile {
            display: none !important;
        }

        /* Tablet active display */
        .portfolio-slider.preview-tablet .project-img-tablet {
            display: block !important;
        }

        .portfolio-slider.preview-tablet .project-img-desktop,
        .portfolio-slider.preview-tablet .project-img-mobile {
            display: none !important;
        }

        /* Mobile active display */
        .portfolio-slider.preview-mobile .project-img-mobile {
            display: block !important;
        }

        .portfolio-slider.preview-mobile .project-img-desktop,
        .portfolio-slider.preview-mobile .project-img-tablet {
            display: none !important;
        }
    </style>
@endsection
@section('body')
    <section id="home" class="hero-section modern-hero">
        <div class="hero-bg">
            <video class="hero-video" autoplay muted loop playsinline preload="metadata" poster="{{ url('frontend/assets/images/extracted/hero-circuit-shot.png') }}" aria-hidden="true">
                <source src="{{ url('frontend/assets/video/header-video.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="hero-tech-grid" aria-hidden="true"></div>
        <div class="container position-relative">
            <div class="hero-stage">
            <div class="hero-editorial">
                <p class="eyebrow hero-anim">Smarter Digital Solutions</p>
                <h1 class="hero-anim delay-1">Creating Digital Experiences That <span>Deliver Results</span></h1>
                <p class="hero-copy hero-anim delay-2"><strong>You dream, we design, we deliver.</strong><br>We create high performing websites and digital marketing strategies that help businesses grow, attract more customers and achieve real results.</p>
                <div class="hero-actions hero-anim delay-3">
                    <a href="#portfolio" class="btn btn-brand">View Our Work <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
            </div>
            <div class="hero-form-card hero-quote-card hero-anim delay-3">
                <div class="hero-form-head">
                    <span><i class="fa-solid fa-paper-plane"></i></span>
                    <div><small>Start your project</small><h3>Get a Free Quote</h3></div>
                </div>
                <form class="contact-form hero-contact-form js-contact-form" id="heroContactForm" data-response="#heroFormResponse" data-button="#heroSubmitBtn">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row g-3">
                        <div class="col-md-6"><input class="form-control" type="text" name="name" placeholder="Your Name" aria-label="Your Name" required></div>
                        <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="Your Email" aria-label="Your Email" autocomplete="email" required></div>
                        <div class="col-md-6"><input class="form-control uk-phone-mask" type="tel" name="phone" placeholder="+44 7123 456789" aria-label="UK Phone Number" inputmode="tel" autocomplete="tel" maxlength="15" pattern="^\+44\s\d{4}\s\d{6}$" title="Enter a UK number in this format: +44 7123 456789" required></div>
                        <div class="col-md-6">
                            <select class="form-select" name="service" aria-label="Select Service" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)<option value="{{ $service->title }}">{{ $service->title }}</option>@endforeach
                                @if($services->isEmpty())<option value="General Enquiry">General Enquiry</option>@endif
                            </select>
                        </div>
                        <div class="col-12"><textarea class="form-control" name="message" rows="3" placeholder="Tell us about your project..." aria-label="Project details" required></textarea></div>
                        <div class="col-12">
                            <div id="heroFormResponse" class="mb-3 d-none"></div>
                            <button class="btn btn-brand hero-form-action" type="submit" id="heroSubmitBtn">Request Quote <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
            <div class="hero-bottom-line">
                <div><strong>You dream, we design, we deliver.</strong><span>Web development &amp; digital marketing &middot; UK</span></div>
                <a href="#about">Scroll to discover <span><i class="fa-solid fa-arrow-down"></i></span></a>
            </div>
        </div>
    </section>

    @if($clients->isNotEmpty())
    <section class="clients-section">
        <div class="container">
            <div class="clients-panel reveal">
                <div class="clients-head">
                    <p class="eyebrow text-center">Our Partners</p>
                    <h2 class="section-title text-center">Building Success Through <span>Trusted Partnerships</span></h2>
                    <p class="clients-description">We partner with innovative businesses and leading technology providers to create digital solutions that deliver lasting results.</p>
                </div>

                @if($clients->isNotEmpty())
                    <div class="clients-carousel-wrap">
                        <div class="client-logo-slider swiper">
                            <div class="client-logo-track swiper-wrapper">
                                @foreach($clients as $client)
                                    <div class="client-logo-slide swiper-slide">
                                        @if($client->link)
                                            <a href="{{ $client->link }}" class="client-logo-card" target="_blank" rel="noopener noreferrer" aria-label="Visit {{ $client->name }}">
                                                <img src="{{ url($client->image) }}" alt="{{ $client->name }}" loading="lazy" decoding="async">
                                            </a>
                                        @else
                                            <div class="client-logo-card">
                                                <img src="{{ url($client->image) }}" alt="{{ $client->name }}" loading="lazy" decoding="async">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="client-pagination"></div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <section id="about" class="section-pad about-section about-refined">
        <div class="container">
            <div class="about-refined-grid">
                <div class="about-refined-content reveal delay-2">
                    <div class="about-refined-heading">
                        <p class="eyebrow">About Us</p>
                        <h2 class="section-title">Your Trusted Partner for <span>Digital Success</span></h2>
                        <p class="muted">Welcome to SSF Tech, a trusted website &amp; software development company based in the UK.</p>
                    </div>
                    <p class="about-refined-description">We turn your vision into a captivating website through expert design and development. From sleek, modern interfaces to seamless functionality, we specialise in boosting conversions and creating digital experiences that help your brand succeed online.</p>
                    <div class="about-refined-stats">
                        <div class="about-stat"><span class="about-stat-index">01</span><strong><span class="stat-number" data-count="5">5</span><span class="stat-plus">+</span></strong><small>Years of experience</small></div>
                        <div class="about-stat"><span class="about-stat-index">02</span><strong><span class="stat-number" data-count="150">150</span><span class="stat-plus">+</span></strong><small>Happy clients</small></div>
                        <div class="about-stat"><span class="about-stat-index">03</span><strong><span class="stat-number" data-count="250">250</span><span class="stat-plus">+</span></strong><small>Projects delivered</small></div>
                    </div>
                </div>
                <div class="about-visual-pair reveal" aria-label="The SSF Tech team at work">
                    <figure class="about-visual-main">
                        <img src="{{ url('frontend/assets/images/stock/development-team.webp') }}" alt="Software developers building digital products together" loading="lazy" decoding="async" width="1600" height="1068">
                    </figure>
                    <figure class="about-visual-secondary">
                        <img src="{{ url('frontend/assets/images/extracted/about-team-shot.webp') }}" alt="SSF Tech team planning a digital project" loading="lazy" decoding="async">
                    </figure>
                    <div class="about-visual-label"><span>People. Purpose. Technology.</span><strong>Good ideas deserve<br>great execution.</strong></div>
                </div>
            </div>
        </div>
    </section>

    @if($services->isNotEmpty())
    <section id="services" class="services-section">
        <div class="container">
            <div class="services-section-heading">
                <p class="eyebrow reveal">Our Services</p>
                <h2 class="section-title reveal delay-1">Bespoke Digital Solutions for <span>Every Business</span></h2>
                <p class="muted reveal delay-1">We offer a complete range of services to help your brand grow online, from the very first line of code through to ongoing support.</p>
            </div>
            @php
                $serviceCategories = collect(\App\Models\Service::CATEGORIES)->filter(fn ($label, $key) => $services->contains('category', $key));
                $categorySummaries = [
                    'development' => ['Build your digital foundation.', 'Websites, applications and connected experiences built around your users.', 'fa-laptop-code'],
                    'crm' => ['Better relationships. Smarter sales.', 'Connect customer data, automate follow-ups and give your team a clearer view of every opportunity.', 'fa-address-book'],
                    'erp' => ['One business. Connected operations.', 'Bring finance, people, inventory and everyday workflows together in systems built for your organisation.', 'fa-building-columns'],
                    'marketing' => ['Get discovered. Build demand.', 'Strategy, creative content and measurable campaigns to help the right customers find your business.', 'fa-bullseye'],
                ];
            @endphp
            <div class="service-category-tabs" role="tablist" aria-label="Service categories">
                @foreach($serviceCategories as $key => $label)
                    <button class="service-category-tab {{ $loop->first ? 'active' : '' }}" type="button" role="tab" id="service-tab-{{ $key }}" data-bs-toggle="tab" data-bs-target="#service-panel-{{ $key }}" aria-controls="service-panel-{{ $key }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"><i class="fa-solid {{ $categorySummaries[$key][2] }}"></i><span>{{ $label }}</span><small>{{ $services->where('category', $key)->count() }}</small></button>
                @endforeach
            </div>
            <div class="tab-content service-category-panels">
                @foreach($serviceCategories as $key => $label)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="service-panel-{{ $key }}" role="tabpanel" aria-labelledby="service-tab-{{ $key }}" tabindex="0">
                        <div class="service-category-intro"><div><p class="eyebrow">{{ $label }}</p><h3>{{ $categorySummaries[$key][0] }}</h3><p>{{ $categorySummaries[$key][1] }}</p></div><a href="#contact" class="service-category-cta">Discuss your requirements <i class="fa-solid fa-arrow-right"></i></a></div>
                        <div class="services-grid">
                            <div class="swiper-wrapper">
                                @foreach($services->where('category', $key) as $service)
                                    <div class="swiper-slide" id="service-{{ $service->id }}" data-service-card data-service-category="{{ $key }}"><article class="service-card service-card-with-image">
                                        <div class="service-card-image"><img src="{{ url($service->cardImagePath()) }}" alt="" loading="lazy" decoding="async" width="1000" height="600"><span class="service-image-category">{{ $label }}</span></div>
                                        <div class="service-card-content">
                                        <div class="service-card-top"><span class="service-icon"><i class="{{ $service->icon }}"></i></span><span class="service-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} /</span></div>
                                        <h3>{{ $service->title }}</h3><p>{{ $service->description }}</p>
                                        <a href="#contact" class="js-select-service" data-service="{{ $service->title }}">Let's talk <i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </article></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="industries" class="industries-section industry-showcase">
        <div class="container">
            <div class="section-heading-row"><div><p class="eyebrow">Industries We Serve</p><h2 class="section-title light">Helping Businesses Thrive<br><span>Across Every Industry</span></h2></div><p class="muted">Whatever industry you operate in, our team has the experience and knowledge to build a digital solution that fits your goals and your customers.</p></div>
            @php
                $industryShowcase = [
                    ['Retail & E-commerce', 'fa-cart-shopping', 'Turn browsing into buying.', 'Fast storefronts, intuitive product discovery and a checkout experience built around your customers.', 'E-commerce platforms', 'Payment integrations', 'stock/ecommerce.webp'],
                    ['Education & Learning', 'fa-graduation-cap', 'Make knowledge more accessible.', 'Learning platforms, course websites and student portals that make every interaction simpler.', 'Learning platforms', 'Student portals', 'stock/education.webp'],
                    ['Professional Services', 'fa-briefcase', 'Build trust before the first call.', 'Clear, credible websites and practical business applications that help your expertise stand out.', 'Business websites', 'Custom applications', 'stock/professional-services.webp'],
                    ['Health & Lifestyle', 'fa-heart-pulse', 'Better experiences. Greater care.', 'Welcoming digital experiences that help people discover your services, make enquiries and stay connected.', 'Service websites', 'Booking integrations', 'stock/healthcare.webp'],
                    ['Transport & Logistics', 'fa-truck-fast', 'Keep your business moving.', 'Booking experiences, operational dashboards and connected systems for a smoother working day.', 'Booking platforms', 'System integrations', 'stock/logistics.webp'],
                ];
            @endphp
            <div class="industry-showcase-grid">
                <div class="industry-selector" role="tablist" aria-label="Industries" aria-orientation="vertical">
                    @foreach($industryShowcase as $industry)
                        <button class="industry-choice {{ $loop->first ? 'active' : '' }}" id="industry-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#industry-panel-{{ $loop->index }}" type="button" role="tab" aria-controls="industry-panel-{{ $loop->index }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}"><span>0{{ $loop->iteration }}</span>{{ $industry[0] }}<i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                    @endforeach
                </div>
                <div class="tab-content industry-panels">
                    @foreach($industryShowcase as $industry)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="industry-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="industry-tab-{{ $loop->index }}" tabindex="0">
                            <img src="{{ url('frontend/assets/images/'.$industry[6]) }}" alt="" loading="lazy" decoding="async">
                            <div class="industry-panel-copy"><span class="industry-panel-icon"><i class="fa-solid {{ $industry[1] }}"></i></span><p class="eyebrow">{{ $industry[0] }}</p><h3>{{ $industry[2] }}</h3><p>{{ $industry[3] }}</p><div class="industry-tags"><span>{{ $industry[4] }}</span><span>{{ $industry[5] }}</span></div><a href="#contact">Discuss your project <i class="fa-solid fa-arrow-right"></i></a></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if($testimonials->isNotEmpty())
    <section class="reviews-section section-pad" id="reviews">
        <div class="container">
            <div class="reviews-panel reveal">
                <div class="reviews-copy">
                    <p class="eyebrow">Client Reviews</p>
                    <h2 class="section-title light reviews-title">Results that earn trust.<br><span>Relationships that last.</span></h2>
                    <p class="muted reviews-text">Great digital work is measured by the difference it makes. Here&#39;s what our clients say about the ideas, communication and results we bring to every project.</p>

                    <div class="review-stats">
                        <div class="review-stat">
                            <span class="review-stat-index">01</span>
                            <strong><span class="stat-number" data-count="{{ $happyClients }}">{{ $happyClients }}</span><span class="stat-plus">+</span></strong>
                            <small>Happy Clients</small>
                        </div>
                        <div class="review-stat">
                            <span class="review-stat-index">02</span>
                            <strong><span class="stat-number" data-count="{{ $averageRating }}" data-decimals="1">{{ $averageRating }}</span><span class="stat-plus">/5</span></strong>
                            <small>Client Rating</small>
                        </div>
                        <div class="review-stat">
                            <span class="review-stat-index">03</span>
                            <strong><span class="stat-number" data-count="98">98</span><span class="stat-plus">%</span></strong>
                            <small>Project Success Rate</small>
                        </div>
                    </div>

                </div>

                <div class="reviews-stage">
                    <div class="reviews-carousel-shell">
                        <div class="reviews-slider-custom swiper">
                            <div class="reviews-track swiper-wrapper">
                                @foreach ($testimonials as $testimonial)
                                    <div class="reviews-slide swiper-slide">
                                        <article class="review-card">
                                        <div class="review-card-head">
                                            <span class="review-quote" aria-hidden="true"><i class="fa-solid fa-quote-left"></i></span>
                                            <div class="review-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="{{ $i <= $testimonial->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        @if ($testimonial->avatar)
                                            <img class="review-avatar" src="{{ url($testimonial->avatar) }}" loading="lazy" decoding="async"
                                                alt="{{ $testimonial->name }}">
                                        @else
                                            @php
                                                $nameParts = collect(preg_split('/\s+/', trim($testimonial->name)))->filter();
                                                $initials = $nameParts
                                                    ->take(2)
                                                    ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                                    ->implode('');
                                            @endphp
                                            <span class="review-avatar review-avatar-initials"
                                                aria-hidden="true">{{ $initials ?: '?' }}</span>
                                        @endif
                                        <p>{{ $testimonial->review }}</p>
                                        <h3 class="review-author-name">{{ $testimonial->name }}</h3>
                                        <small>{{ trim(($testimonial->designation ? $testimonial->designation . ', ' : '') . $testimonial->company, ', ') }}</small>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="review-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    @endif


    @if($blogs->isNotEmpty())
    <section class="insights-section section-pad" id="blog">
        <div class="container">
            <div class="insights-head reveal">
                <div>
                    <p class="eyebrow">Our Blog</p>
                    <h2 class="section-title light">Latest Insights &amp; <span>Digital Trends</span></h2>
                    <p>We share practical insights, proven strategies, and the latest in design and technology to help
                        your business grow smarter and faster.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-brand insights-all"><i class="fa-solid fa-newspaper"></i> View All
                    Articles <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            @if($blogs->isNotEmpty())
            <div class="insights-slider swiper reveal delay-2">
                <div class="swiper-wrapper">
                @foreach($blogs as $blog)
                    <div class="swiper-slide">
                        <article class="insight-card"><img src="{{ url($blog->image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async"><div class="insight-card-body"><div class="insight-meta"><span class="insight-category"><i class="{{ $blog->icon }}"></i> {{ $blog->category }}</span><span><i class="fa-regular fa-calendar"></i> {{ $blog->date }}</span><span><i class="fa-regular fa-clock"></i> {{ $blog->read_time }}</span></div><h3><a class="blog-title-link" href="{{ route('blog.show',$blog->slug) }}">{{ $blog->title }}</a></h3><p>{{ $blog->excerpt }}</p><a href="{{ route('blog.show',$blog->slug) }}">Read More <i class="fa-solid fa-arrow-right"></i></a></div></article>
                    </div>
                @endforeach
                </div>
            </div>
            @if($blogs->count() > 1)<div class="insights-pagination"></div>@endif
            @endif
        </div>
    </section>
    @endif

    @if($projects->isNotEmpty())
    <section class="portfolio-section section-pad" id="portfolio">
        <div class="container">
            <div class="portfolio-head">
                <div>
                    <p class="eyebrow reveal">Our Work</p>
                    <h2 class="section-title reveal delay-1">Digital Experiences We&#39;ve Created<br><span>for Our Clients</span></h2>
                    <p class="muted reveal delay-2">From modern websites to complete digital solutions, we help businesses achieve
                        their goals. Browse our recent work to see what we've created.</p>
                </div>
            </div>
            <div class="portfolio-controls reveal delay-3">
                <div class="device-tabs" role="group" aria-label="Device preview">
                    <button class="active" type="button" data-device="desktop" aria-pressed="true"><i class="fa-solid fa-desktop"></i>
                        Desktop</button>
                    <button type="button" data-device="tablet" aria-pressed="false"><i class="fa-solid fa-tablet-screen-button"></i>
                        Tablet</button>
                    <button type="button" data-device="mobile" aria-pressed="false"><i class="fa-solid fa-mobile-screen-button"></i>
                        Mobile</button>
                </div>
            </div>
            <div class="portfolio-slider swiper reveal delay-4">
                <div class="swiper-wrapper">
                    @foreach ($projects as $project)
                        <div class="swiper-slide" data-category="{{ $project->category }}">
                            <article class="project-card" data-project-url="{{ $project->project_url ?? '#contact' }}">
                                <div class="project-visual">
                                    <div class="browser-frame">
                                        <!-- Desktop Layout -->
                                        <img class="project-img-desktop" src="{{ url($project->image_desktop) }}" loading="lazy" decoding="async"
                                            alt="{{ $project->title }} desktop preview">

                                        <!-- Tablet Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-tablet" loading="lazy" decoding="async"
                                            src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ url($project->image_tablet ?? $project->image_desktop) }}"
                                            alt="{{ $project->title }} tablet preview">

                                        <!-- Mobile Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-mobile" loading="lazy" decoding="async"
                                            src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ url($project->image_mobile ?? $project->image_desktop) }}"
                                            alt="{{ $project->title }} mobile preview">
                                    </div>
                                </div>
                                <div class="project-meta">
                                    <h3 class="project-title">{{ $project->title }}</h3>
                                    <span>{{ $project->category == 'webapp' ? 'Web App' : ($project->category == 'ecommerce' ? 'E-Commerce' : 'Website') }}</span>
                                    <a href="{{ $project->project_url ?? '#contact' }}"
                                        aria-label="View {{ $project->title }} project">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                @if($projects->count() > 1)<div class="portfolio-pagination"></div>@endif
            </div>
        </div>
    </section>
    @endif

    @include('frontend.partials.delivery-process')

    <section id="contact" class="contact-section section-pad">
        <div class="container">
            <div class="contact-section-heading"><p class="eyebrow">Get In Touch</p><h2 class="section-title">Outshine Your Competitors with <span>Smart Digital Solutions</span></h2><p class="muted">Have a project in mind? Get in touch with our team today and let&#39;s create a digital solution that helps your business grow.</p></div>
            <div class="contact-shell">
                <div class="contact-info reveal">
                    <div class="contact-panel-top"><span class="contact-panel-mark"><i class="fa-solid fa-comments"></i></span><span>LET'S CONNECT</span></div>
                    <h3 class="contact-panel-title">Send Us a Message</h3>
                    <p class="contact-copy">Fill out the form and we&#39;ll get back to you shortly.</p>
                    <div class="contact-details">
                        @if($siteSetting?->contact_phone)
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-phone"></i></span>
                            <div>
                                <small>Call Us</small>
                                <strong><a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSetting->contact_phone) }}">{{ $siteSetting->contact_phone }}</a></strong>
                            </div>
                        </div>
                        @endif
                        @if($siteSetting?->contact_email)
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-envelope"></i></span>
                            <div>
                                <small>Email Us</small>
                                <strong><a href="mailto:{{ $siteSetting->contact_email }}">{{ $siteSetting->contact_email }}</a></strong>
                            </div>
                        </div>
                        @endif
                        @if($siteSetting?->contact_address)
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-location-dot"></i></span>
                            <div>
                                <small>Visit Us</small>
                                <strong>{!! nl2br(e($siteSetting->contact_address)) !!}</strong>
                            </div>
                        </div>
                        @endif
                        <div class="contact-detail">
                            <span><i class="fa-regular fa-clock"></i></span>
                            <div>
                                <small>Working Hours</small>
                                <strong>Mon - Fri: 9:00 AM - 6:00 PM</strong>
                            </div>
                        </div>
                    </div>
                    @if($socialLinks->isNotEmpty())
                    <div class="contact-socials">
                        <p>Follow Us</p>
                        <div>
                            @foreach($socialLinks as $socialLink)
                                <a href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLink->platform }}"><i class="{{ $socialLink->icon }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="contact-form-card reveal delay-2">
                    <div class="contact-form-head">
                        <span><i class="fa-regular fa-envelope"></i></span>
                        <div>
                            <h3>Send Us a Message</h3>
                            <p>Fill out the form and we&#39;ll get back to you shortly.</p>
                        </div>
                    </div>
                    <form class="contact-form js-contact-form" id="contactForm" data-response="#formResponse"
                        data-button="#submitBtn">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6">
                                <label class="field-label" for="enquiry-name">Your name<span aria-hidden="true"> *</span></label>
                                <input id="enquiry-name" class="form-control" type="text" name="name" placeholder="Your Name"
                                    aria-label="Your Name" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label class="field-label" for="enquiry-email">Email address<span aria-hidden="true"> *</span></label>
                                <input id="enquiry-email" class="form-control" type="email" name="email" placeholder="Your Email"
                                    aria-label="Your Email" autocomplete="email" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label class="field-label" for="enquiry-phone">Phone number<span aria-hidden="true"> *</span></label>
                                <input id="enquiry-phone" class="form-control uk-phone-mask" type="tel" name="phone"
                                    placeholder="+44 7123 456789" aria-label="UK Phone Number" inputmode="tel"
                                    autocomplete="tel" maxlength="15" pattern="^\+44\s\d{4}\s\d{6}$"
                                    title="Enter a UK number in this format: +44 7123 456789" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label class="field-label" for="enquiry-service">Interested in<span aria-hidden="true"> *</span></label>
                                <select id="enquiry-service" class="form-select" name="service" aria-label="Select Service" required>
                                    <option value="">Select Service</option>
                                    @foreach(\App\Models\Service::CATEGORIES as $key => $label)
                                        @if($services->where('category', $key)->isNotEmpty())
                                            <optgroup label="{{ $label }}">
                                                @foreach($services->where('category', $key) as $service)
                                                    <option value="{{ $service->title }}">{{ $service->title }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                    @if($services->isEmpty())<option value="General Enquiry">General Enquiry</option>@endif
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="field-label" for="enquiry-message">Project details<span aria-hidden="true"> *</span></label>
                                <textarea id="enquiry-message" class="form-control" name="message" rows="4" placeholder="Tell us about your project..."
                                    aria-label="Project details" required></textarea>
                            </div>
                            <div class="col-12">
                                <div id="formResponse" class="mb-3 d-none"></div>
                                <button class="btn btn-brand hero-form-action" type="submit" id="submitBtn">
                                    Send Message <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if($faqs->isNotEmpty())
    <section class="faq-section section-pad" id="faqs">
        <div class="container">
            <div class="faq-section-heading"><p class="eyebrow">FAQ&#39;S</p><h2 class="section-title">Frequently Asked <span>Questions</span></h2><p class="muted">Find answers to some of the most common questions about our services, our process and how we work.</p></div>
            <div class="faq-shell">
                <aside class="faq-intro reveal">
                    <div class="faq-help-photo"><img src="{{ url('frontend/assets/images/stock/professional-services.webp') }}" alt="Developers collaborating in an office" loading="lazy" decoding="async"><span><i class="fa-solid fa-comment-dots"></i> PEOPLE BEHIND THE TECHNOLOGY</span></div>
                    <div class="faq-question-card">
                        <span class="faq-help-label">STILL HAVE QUESTIONS?</span>
                        <h3>Still have questions?</h3>
                        <p>Can&#39;t find the answer you&#39;re looking for? Our team is here to help!</p>
                        <a class="btn btn-brand" href="#contact">Ask a Question <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </aside>
                <div class="faq-content reveal delay-2">
                    <div class="accordion faq-list" id="faqAccordion">
                        @forelse ($faqs as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="faq{{ $faq->id }}"><span class="faq-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><span class="faq-question-text">{{ $faq->question }}</span><span class="faq-toggle" aria-hidden="true"></span></button>
                                </h3>
                                <div id="faq{{ $faq->id }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">{{ $faq->answer }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="faq-copy mb-0">FAQs will be available soon.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatUkPhone(value) {
                let digits = value.replace(/\D/g, '');

                if (digits.startsWith('44')) {
                    digits = digits.slice(2);
                }

                if (digits.startsWith('0')) {
                    digits = digits.slice(1);
                }

                digits = digits.slice(0, 10);

                if (!digits) {
                    return '';
                }

                if (digits.length <= 4) {
                    return '+44 ' + digits;
                }

                return '+44 ' + digits.slice(0, 4) + ' ' + digits.slice(4);
            }

            document.querySelectorAll('.uk-phone-mask').forEach(function(input) {
                input.addEventListener('input', function() {
                    input.value = formatUkPhone(input.value);
                });

                input.addEventListener('blur', function() {
                    input.value = formatUkPhone(input.value);
                });
            });

            document.querySelectorAll('.js-contact-form').forEach(function(form) {
                const responseDiv = document.querySelector(form.dataset.response);
                const submitBtn = document.querySelector(form.dataset.button);
                const responseContainer = form.closest('.hero-form-card, .contact-form-card') || form;
                const originalButtonHtml = submitBtn ? submitBtn.innerHTML : '';
                let responseTimer;

                if (!responseDiv || !submitBtn) {
                    return;
                }

                function showFormResponse(className, message) {
                    clearTimeout(responseTimer);

                    if (responseDiv.parentElement !== responseContainer) {
                        responseContainer.appendChild(responseDiv);
                    }

                    responseDiv.className = className + ' frontend-alert-in-form';
                    responseDiv.innerHTML = message;
                    responseDiv.classList.remove('d-none');
                    responseDiv.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
                    responseDiv.style.opacity = '1';
                    responseDiv.style.transform = 'translateX(0)';

                    responseTimer = setTimeout(function() {
                        responseDiv.style.opacity = '0';
                        responseDiv.style.transform = 'translateX(calc(100% + 40px))';

                        setTimeout(function() {
                            responseDiv.className = 'mb-3 d-none';
                            responseDiv.innerHTML = '';
                        }, 350);
                    }, 3500);
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const phoneInput = form.querySelector('.uk-phone-mask');
                    if (phoneInput) {
                        phoneInput.value = formatUkPhone(phoneInput.value);
                    }

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Sending... <i class="fa-solid fa-spinner fa-spin ms-2"></i>';

                    responseDiv.className = 'mb-3 d-none';
                    clearTimeout(responseTimer);

                    const formData = new FormData(form);

                    fetch('{{ route('contact.submit') }}', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        })
                        .then(response => response.json().then(data => ({
                            status: response.status,
                            body: data
                        })))
                        .then(res => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalButtonHtml;

                            if (res.status === 200 && res.body.success) {
                                showFormResponse(
                                    'alert frontend-alert frontend-alert-success',
                                    '<i class="fa-solid fa-circle-check me-2"></i>' + res.body.message
                                );
                                form.reset();
                            } else {
                                let errMsg = 'Something went wrong. Please try again.';
                                if (res.body.errors) {
                                    errMsg = Object.values(res.body.errors).flat().join('<br>');
                                } else if (res.body.message) {
                                    errMsg = res.body.message;
                                }
                                showFormResponse(
                                    'alert frontend-alert frontend-alert-error',
                                    '<i class="fa-solid fa-triangle-exclamation me-2"></i>' + errMsg
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalButtonHtml;

                            showFormResponse(
                                'alert frontend-alert frontend-alert-error',
                                '<i class="fa-solid fa-triangle-exclamation me-2"></i> Network error. Please check your connection and try again.'
                            );
                        });
                });
            });
        });
    </script>
@endsection
