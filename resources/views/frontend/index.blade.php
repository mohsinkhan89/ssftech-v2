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
    <section id="home" class="hero-section">
        <div class="hero-bg">
            <video class="hero-video" autoplay muted loop playsinline
                poster="{{ url('frontend/assets/images/extracted/hero-circuit-shot.png') }}">
                <source src="{{ url('frontend/assets/video/header-video.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="hero-pulse"></div>
        <div class="container position-relative">
            <div class="row min-vh-hero align-items-center g-5">
                <div class="col-lg-6 col-xl-6">
                    <p class="eyebrow hero-anim">Smarter Digital Solutions</p>
                    <h1 class="hero-anim delay-1">Creating Digital Experiences That <span>Deliver Results</span></h1>
                    <h2 class="hero-anim delay-2">You dream, we design, we deliver</h2>
                    <p class="hero-copy hero-anim delay-3">We create high performing websites and digital marketing
                        strategies that help businesses grow, attract more customers and achieve real results.</p>
                    <div class="hero-actions hero-anim delay-4">
                        <a href="#contact" class="btn btn-brand">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#portfolio" class="play-link" aria-label="View our work">
                            <span class="play-circle"><i class="fa-solid fa-play"></i></span>
                            View Our Work
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-xl-6 mm-0">
                    <div class="hero-form-card hero-anim delay-3">
                        <div class="hero-form-head">
                            <span><i class="fa-solid fa-paper-plane"></i></span>
                            <div>
                                <small>Start your project</small>
                                <h3>Get a Free Quote</h3>
                            </div>
                        </div>
                        <form class="contact-form hero-contact-form js-contact-form" id="heroContactForm"
                            data-response="#heroFormResponse" data-button="#heroSubmitBtn">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-6 col-md-6">
                                    <input class="form-control" type="text" name="name" placeholder="Your Name"
                                        aria-label="Your Name" required>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input class="form-control" type="email" name="email" placeholder="Your Email"
                                        aria-label="Your Email" autocomplete="email" required>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input class="form-control uk-phone-mask" type="tel" name="phone"
                                        placeholder="+44 7123 456789" aria-label="UK Phone Number" inputmode="tel"
                                        autocomplete="tel" maxlength="15" pattern="^\+44\s\d{4}\s\d{6}$"
                                        title="Enter a UK number in this format: +44 7123 456789" required>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <select class="form-select" name="service" aria-label="Select Service" required>
                                        <option value="">Select Service</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Digital Marketing">Digital Marketing</option>
                                        <option value="Graphic Designing">Graphic Designing</option>
                                        <option value="IT Support">IT Support</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="3" placeholder="Tell us about your project..."
                                        aria-label="Project details" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div id="heroFormResponse" class="mb-3 d-none"></div>
                                    <button class="btn btn-brand" type="submit" id="heroSubmitBtn">
                                        Request Quote <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="section-pad about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <p class="eyebrow">About Us</p>
                    <h2 class="section-title">Your Trusted Partner for <span>Digital Success</span></h2>
                    <p class="muted">Welcome to SSF Tech, a trusted website development company based in the UK. We turn
                        your vision into a captivating website through expert design and development. From sleek, modern
                        interfaces to seamless functionality, we specialise in boosting conversions and creating digital
                        experiences that help your brand succeed online.</p>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-icon"><i class="fa-regular fa-calendar-days"></i></span>
                            <div class="about-points">
                                <strong>5+</strong>
                                <small>Years Experience</small>
                            </div>
                        </div>
                        <div class="stat-item"><span class="stat-icon"><i class="fa-solid fa-users"></i></span>
                            <div class="about-points">
                                <strong>150+</strong><small>Happy Clients</small>
                            </div>
                        </div>
                        <div class="stat-item"><span class="stat-icon"><i class="fa-solid fa-award"></i></span>
                            <div class="about-points">
                                <strong>250+</strong><small>Projects Delivered</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal mm-0 delay-2">
                    <div class="about-image float-soft">
                        <img src="{{ url('frontend/assets/images/extracted/about-team-shot.webp') }}" loading="lazy" decoding="async"
                            alt="Digital team working together">
                        <div class="mission-card">
                            <span><i class="fa-solid fa-bullseye"></i></span>
                            <strong>Your Growth,<br>Our Mission</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="industries" class="industries-section">
        <div class="container">
            <p class="eyebrow reveal">Industries We Serve</p>
            <h2 class="section-title light reveal delay-1">Helping Businesses Thrive Across Every Industry</h2>
            <p class="muted text-white reveal delay-1">Whatever industry you operate in, our team has the experience and
                knowledge to build a digital solution that fits your goals and your customers.</p>
            <div class="industry-grid reveal delay-2">
                <div><i class="fa-solid fa-graduation-cap"></i>Education and<br>Learning</div>
                <div><i class="fa-solid fa-microphone-lines"></i>On Demand<br>Solutions</div>
                <div><i class="fa-solid fa-photo-film"></i>Media and<br>Entertainment</div>
                <div><i class="fa-solid fa-kitchen-set"></i>Food and<br>Drink</div>
                <div><i class="fa-solid fa-spa"></i>Health and<br>Fitness</div>
                <div><i class="fa-regular fa-heart"></i>Lifestyle</div>
                <div><i class="fa-solid fa-truck-fast"></i>Transportation and<br>Logistics</div>
            </div>
        </div>
    </section>

    <section class="cta-wrap">
        <div class="container">
            <div class="cta-banner reveal">
                <div class="cta-content">
                    <p>Ready to Build Something Amazing?</p>
                    <h2>Let's build something amazing together.</h2>
                    <p>Get in touch today and discover how SSF Tech can help your brand grow online.</p>
                    <a href="#contact" class="btn btn-brand">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    @if($services->isNotEmpty())
    <section id="services" class="services-section">
        <div class="container">
            <p class="eyebrow reveal">Our Services</p>
            <h2 class="section-title reveal delay-1">Bespoke Digital Solutions for Every Business</h2>
            <p class="muted reveal delay-1">We offer a complete range of services to help your brand grow online, from
                the very first line of code through to ongoing support.</p>
            <div class="services-slider swiper reveal delay-2">
                <div class="swiper-wrapper">
                    @foreach ($services as $service)
                        <div class="swiper-slide">
                            <article class="service-card">
                                <span class="service-icon"><i class="{{ $service->icon }}"></i></span>
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->description }}</p>
                                <a href="{{ $service->link ?: '#contact' }}">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="service-pagination"></div>
        </div>
    </section>
    @endif

    @if($testimonials->isNotEmpty())
    <section class="reviews-section section-pad" id="reviews">
        <div class="container">
            <div class="reviews-panel reveal">
                <div class="reviews-copy">
                    <p class="eyebrow">Client Reviews</p>
                    <h2 class="section-title light reviews-title">We've helped a lot of businesses but don't just take <span>our word for it</span></h2>
                    <p class="muted reviews-text">We're proud to help businesses grow with reliable digital solutions,
                        outstanding service and lasting partnerships. Our clients trust us to deliver quality work that
                        makes a real difference.</p>

                    <div class="review-stats">
                        <div class="review-stat">
                            <span><i class="fa-regular fa-face-smile"></i></span>
                            <strong>{{ $happyClients }}+</strong>
                            <small>Happy Clients</small>
                        </div>
                        <div class="review-stat">
                            <span><i class="fa-regular fa-star"></i></span>
                            <strong>{{ $averageRating }}/5</strong>
                            <small>Client Rating</small>
                        </div>
                        <div class="review-stat">
                            <span><i class="fa-solid fa-award"></i></span>
                            <strong>98%</strong>
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
                                                aria-label="{{ $testimonial->name }}">{{ $initials ?: '?' }}</span>
                                        @endif
                                        <p>{{ $testimonial->review }}</p>
                                        <strong>{{ $testimonial->name }}</strong>
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


    @if($clients->isNotEmpty())
    <section class="clients-section">
        <div class="container">
            <div class="clients-panel reveal">
                <div class="clients-head">
                    <p class="eyebrow text-center">Our Partners</p>
                    <h2 class="section-title text-center">Building Success Through <span>Trusted Partnerships</span></h2>
                    <p class="clients-copy">We partner with innovative businesses and leading technology providers to
                        create digital solutions that deliver lasting results.</p>
                </div>

                @if($clients->isNotEmpty())
                    <div class="clients-carousel-wrap">
                        <div class="client-logo-slider swiper">
                            <div class="client-logo-track swiper-wrapper">
                                @foreach($clients as $client)
                                    <div class="client-logo-slide swiper-slide">
                                        <div class="client-logo-card">
                                            <img src="{{ url($client->image) }}" alt="{{ $client->name }}" loading="lazy" decoding="async">
                                        </div>
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
                    <h2 class="section-title reveal delay-1">Digital Experiences We've <br> Created for <span>Our Clients</span></h2>
                    <p class="muted reveal delay-2">From modern websites to complete digital solutions, we help businesses achieve
                        their goals. Browse our recent work to see what we've created.</p>
                </div>
                <a href="#contact" class="btn btn-brand reveal delay-2">Start Your Project <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="portfolio-controls reveal delay-3">
                <div class="portfolio-tabs" aria-label="Project categories">
                    <button class="active" type="button" data-filter="all" aria-pressed="true"><i
                            class="fa-solid fa-table-cells-large"></i> All
                        Projects</button>
                    <button type="button" data-filter="website" aria-pressed="false"><i class="fa-solid fa-code"></i>
                        Websites</button>
                    <button type="button" data-filter="ecommerce" aria-pressed="false"><i class="fa-solid fa-cart-shopping"></i>
                        E-Commerce</button>
                    <button type="button" data-filter="webapp" aria-pressed="false"><i class="fa-solid fa-grip"></i> Web
                        Apps</button>
                </div>
                <div class="device-tabs" aria-label="Device preview">
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
                                    <strong>{{ $project->title }}</strong>
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

    <section id="contact" class="contact-section section-pad">
        <div class="container">
            <div class="contact-shell">
                <div class="contact-info reveal">
                    <p class="eyebrow">Get In Touch</p>
                    <h2 class="section-title light">Outshine Your Competitors with <span>Smart Digital Solutions</span></h2>
                    <p class="contact-copy">Have a project in mind? Get in touch with our team today and let's create a
                        digital solution that helps your business grow.</p>
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
                            <p>Fill out the form and we'll get back to you shortly.</p>
                        </div>
                    </div>
                    <form class="contact-form js-contact-form" id="contactForm" data-response="#formResponse"
                        data-button="#submitBtn">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6">
                                <input class="form-control" type="text" name="name" placeholder="Your Name"
                                    aria-label="Your Name" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="Your Email"
                                    aria-label="Your Email" autocomplete="email" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input class="form-control uk-phone-mask" type="tel" name="phone"
                                    placeholder="+44 7123 456789" aria-label="UK Phone Number" inputmode="tel"
                                    autocomplete="tel" maxlength="15" pattern="^\+44\s\d{4}\s\d{6}$"
                                    title="Enter a UK number in this format: +44 7123 456789" required>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <input class="form-control" type="text" name="service" placeholder="Subject"
                                    aria-label="Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="Tell us about your project..."
                                    aria-label="Project details" required></textarea>
                            </div>
                            <div class="col-12">
                                <div id="formResponse" class="mb-3 d-none"></div>
                                <button class="btn btn-brand" type="submit" id="submitBtn">
                                    Send Message <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if($faqs->isNotEmpty())
    <section class="faq-section section-pad">
        <div class="container">
            <div class="faq-shell">
                <div class="faq-intro reveal">
                    <p class="eyebrow">FAQ'S</p>
                    <h2 class="section-title light">Frequently Asked <span>Questions</span></h2>
                    <p class="faq-copy">Find answers to some of the most common questions about our services, our process
                        and how we work.</p>
                    <div class="faq-question-card">
                        <span class="faq-question-icon"><i class="fa-solid fa-headset"></i></span>
                        <h3>Still have questions?</h3>
                        <p>Can't find the answer you're looking for? Our team is here to help!</p>
                        <a class="btn btn-brand" href="#contact">
                            Ask a Question <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="faq-content reveal delay-2">
                    <div class="accordion faq-list" id="faqAccordion">
                        @forelse ($faqs as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="faq{{ $faq->id }}">{{ $faq->question }}</button>
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
                const originalButtonHtml = submitBtn ? submitBtn.innerHTML : '';
                let responseTimer;

                if (!responseDiv || !submitBtn) {
                    return;
                }

                function showFormResponse(className, message) {
                    clearTimeout(responseTimer);

                    responseDiv.className = className;
                    responseDiv.innerHTML = message;
                    responseDiv.classList.remove('d-none');
                    responseDiv.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
                    responseDiv.style.opacity = '1';
                    responseDiv.style.transform = 'translateY(0)';

                    responseTimer = setTimeout(function() {
                        responseDiv.style.opacity = '0';
                        responseDiv.style.transform = 'translateY(-8px)';

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
                                    'alert alert-success bg-success-subtle border-success-subtle text-success p-3 rounded',
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
                                    'alert alert-danger bg-danger-subtle border-danger-subtle text-danger p-3 rounded',
                                    '<i class="fa-solid fa-triangle-exclamation me-2"></i>' + errMsg
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalButtonHtml;

                            showFormResponse(
                                'alert alert-danger bg-danger-subtle border-danger-subtle text-danger p-3 rounded',
                                '<i class="fa-solid fa-triangle-exclamation me-2"></i> Network error. Please check your connection and try again.'
                            );
                        });
                });
            });
        });
    </script>
@endsection
