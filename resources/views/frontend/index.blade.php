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
                        <img src="{{ url('frontend/assets/images/extracted/about-team-shot.png') }}"
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

    <section id="services" class="services-section">
        <div class="container">
            <p class="eyebrow reveal">Our Services</p>
            <h2 class="section-title reveal delay-1">Bespoke Digital Solutions for Every Business</h2>
            <p class="muted reveal delay-1">We offer a complete range of services to help your brand grow online, from
                the very first line of code through to ongoing support.</p>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3 reveal">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-laptop-code"></i></span>
                        <h3>Web Development</h3>
                        <p>Custom websites built with modern technology, designed for strong performance, easy management
                            and long term scalability.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-1">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-bullhorn"></i></span>
                        <h3>Digital Marketing</h3>
                        <p>Results focused marketing strategies that grow your brand, reach the right audience and turn
                            clicks into paying customers.</p>
                        <a href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-2">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-pen-nib"></i></span>
                        <h3>Graphic Designing</h3>
                        <p>Creative, memorable designs that tell your brand's story and leave a lasting impression on every
                            visitor.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-3">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-headset"></i></span>
                        <h3>IT Support</h3>
                        <p>Reliable, responsive support and maintenance that keeps your systems running smoothly, day in
                            and day out.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
            </div>
        </div>
    </section>


    <section class="reviews-section section-pad" id="reviews">
        <div class="container">
            <div class="reviews-panel reveal">
                <div class="reviews-copy">
                    <p class="eyebrow">Client Reviews</p>
                    <h2 class="reviews-title">We've helped a lot of businesses&mdash;<br>but don't just take <span>our word for it</span></h2>
                    <p class="reviews-text">We're proud to help businesses grow with reliable digital solutions,
                        outstanding service and lasting partnerships. Our clients trust us to deliver quality work that
                        makes a real difference.</p>

                    <div class="review-stats">
                        <div class="review-stat">
                            <span><i class="fa-regular fa-face-smile"></i></span>
                            <strong>120+</strong>
                            <small>Happy Clients</small>
                        </div>
                        <div class="review-stat">
                            <span><i class="fa-regular fa-star"></i></span>
                            <strong>5.0/5</strong>
                            <small>Client Rating</small>
                        </div>
                        <div class="review-stat">
                            <span><i class="fa-solid fa-award"></i></span>
                            <strong>98%</strong>
                            <small>Project Success Rate</small>
                        </div>
                    </div>

                    <div class="review-controls" aria-label="Review slider controls">
                        <button class="review-prev" type="button" aria-label="Previous review"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <button class="review-next" type="button" aria-label="Next review"><i
                                class="fa-solid fa-chevron-right"></i></button>
                        <div class="review-pagination"></div>
                    </div>
                </div>

                <div class="reviews-stage">
                    <p class="eyebrow">What Our Clients Say</p>
                    <div class="reviews-slider-custom swiper">
                        <div class="reviews-track swiper-wrapper">
                            @php
                                $documentTestimonials = collect([
                                    (object) ['name' => 'James Wilson', 'designation' => 'Director', 'company' => '', 'rating' => 5, 'avatar' => null, 'review' => 'SSF Tech created a professional website that exceeded our expectations. The process was smooth, and the results have been excellent.'],
                                    (object) ['name' => 'Sarah Thompson', 'designation' => 'Business Owner', 'company' => '', 'rating' => 5, 'avatar' => null, 'review' => 'The team was responsive, knowledgeable and delivered our project on time. We highly recommend SSF Tech.'],
                                    (object) ['name' => 'Michael Bennett', 'designation' => 'Managing Director', 'company' => '', 'rating' => 5, 'avatar' => null, 'review' => 'Our new website looks fantastic and has helped us attract more customers. A great experience from start to finish.'],
                                    (object) ['name' => 'Emma Richardson', 'designation' => 'Marketing Manager', 'company' => '', 'rating' => 5, 'avatar' => null, 'review' => 'Reliable service, excellent communication and outstanding results. We look forward to working with SSF Tech again.'],
                                ]);
                                $reviewSlides = $documentTestimonials->concat($testimonials);
                            @endphp
                            @foreach ($reviewSlides as $testimonial)
                                <div class="reviews-slide swiper-slide">
                                    <article class="review-card">
                                        <div class="review-card-head">
                                            <span class="review-quote">&ldquo;</span>
                                            <div class="review-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="{{ $i <= $testimonial->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <img class="review-avatar"
                                            src="{{ url($testimonial->avatar ?: 'frontend/assets/images/extracted/client-avatar-2.png') }}"
                                            alt="{{ $testimonial->name }}">
                                        <p>{{ $testimonial->review }}</p>
                                        <strong>{{ $testimonial->name }}</strong>
                                        <small>{{ trim(($testimonial->designation ? $testimonial->designation . ', ' : '') . $testimonial->company, ', ') }}</small>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



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
                                            <img src="{{ url($client->image) }}" alt="{{ $client->name }}">
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

    <section class="portfolio-section section-pad" id="portfolio">
        <div class="container">
            <div class="portfolio-head reveal">
                <div>
                    <p class="eyebrow">Our Work</p>
                    <h2 class="section-title">Digital Experiences We've Created for <span>Our Clients</span>
                        </h2>
                    <p class="muted">From modern websites to complete digital solutions, we help businesses achieve
                        their goals. Browse our recent work to see what we've created.</p>
                </div>
                <a href="#contact" class="btn btn-brand">Start Your Project <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="portfolio-controls reveal delay-1">
                <div class="portfolio-tabs" aria-label="Project categories">
                    <button class="active" type="button" data-filter="all"><i
                            class="fa-solid fa-table-cells-large"></i> All
                        Projects</button>
                    <button type="button" data-filter="website"><i class="fa-solid fa-code"></i>
                        Websites</button>
                    <button type="button" data-filter="ecommerce"><i class="fa-solid fa-cart-shopping"></i>
                        E-Commerce</button>
                    <button type="button" data-filter="webapp"><i class="fa-solid fa-grip"></i> Web
                        Apps</button>
                </div>
                <div class="device-tabs" aria-label="Device preview">
                    <button class="active" type="button" data-device="desktop"><i class="fa-solid fa-desktop"></i>
                        Desktop</button>
                    <button type="button" data-device="tablet"><i class="fa-solid fa-tablet-screen-button"></i>
                        Tablet</button>
                    <button type="button" data-device="mobile"><i class="fa-solid fa-mobile-screen-button"></i>
                        Mobile</button>
                </div>
            </div>
            <div class="portfolio-slider swiper reveal delay-2">
                <div class="swiper-wrapper">
                    @foreach ($projects as $project)
                        <div class="swiper-slide" data-category="{{ $project->category }}">
                            <article class="project-card" data-project-url="{{ $project->project_url ?? '#contact' }}">
                                <div class="project-visual">
                                    <div class="browser-frame">
                                        <!-- Desktop Layout -->
                                        <img class="project-img-desktop" src="{{ url($project->image_desktop) }}"
                                            alt="{{ $project->title }} desktop preview">

                                        <!-- Tablet Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-tablet"
                                            src="{{ url($project->image_tablet ?? $project->image_desktop) }}"
                                            alt="{{ $project->title }} tablet preview">

                                        <!-- Mobile Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-mobile"
                                            src="{{ url($project->image_mobile ?? $project->image_desktop) }}"
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
                <div class="portfolio-pagination"></div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section section-pad">
        <div class="container">
            <div class="contact-shell">
                <div class="contact-info reveal">
                    <p class="eyebrow">Get In Touch</p>
                    <h2 class="section-title light">Outshine Your Competitors with <span>Smart Digital Solutions</span></h2>
                    <p class="contact-copy">Have a project in mind? Get in touch with our team today and let's create a
                        digital solution that helps your business grow.</p>
                    <div class="contact-details">
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-phone"></i></span>
                            <div>
                                <small>Call Us</small>
                                <strong>+44 1234 567 890</strong>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-envelope"></i></span>
                            <div>
                                <small>Email Us</small>
                                <strong>hello@ssftech.co.uk</strong>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span><i class="fa-solid fa-location-dot"></i></span>
                            <div>
                                <small>Visit Us</small>
                                <strong>London, United Kingdom</strong>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <span><i class="fa-regular fa-clock"></i></span>
                            <div>
                                <small>Working Hours</small>
                                <strong>Mon - Fri: 9:00 AM - 6:00 PM</strong>
                            </div>
                        </div>
                    </div>
                    <div class="contact-socials">
                        <p>Follow Us</p>
                        <div>
                            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
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
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="name" placeholder="Your Name"
                                    aria-label="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="email" name="email" placeholder="Your Email"
                                    aria-label="Your Email" autocomplete="email" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control uk-phone-mask" type="tel" name="phone"
                                    placeholder="+44 7123 456789" aria-label="UK Phone Number" inputmode="tel"
                                    autocomplete="tel" maxlength="15" pattern="^\+44\s\d{4}\s\d{6}$"
                                    title="Enter a UK number in this format: +44 7123 456789" required>
                            </div>
                            <div class="col-md-6">
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
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">What services does
                                    SSF Tech offer?</button></h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">We offer a full range of digital services including web
                                    development, mobile app development, digital marketing, UI and UX design, and IT
                                    support, all tailored to suit your business needs.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">How long does a typical project
                                    take?</button></h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Most projects take between two and six weeks, depending on the
                                    scope of work, the amount of content involved, any integrations required and how
                                    quickly feedback is provided during review.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">Do you work with startups and small
                                    businesses?</button></h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, we build practical and affordable digital solutions for
                                    startups, growing brands and established teams alike.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq4">What is your pricing model?</button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Pricing is based on your specific project requirements,
                                    timeline and the level of ongoing support you need, so every quote is tailored to you.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq5">How do you ensure data
                                    security?</button></h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">We follow secure development practices, careful access
                                    control, protected deployments and regular backup recommendations to help keep your
                                    data safe.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq6">Do you provide support after
                                    launch?</button></h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, ongoing support is available after your website, app or
                                    campaign goes live, helping keep everything stable and continually improving.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
