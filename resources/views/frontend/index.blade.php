@extends('frontend.layouts.master')
@section('title')
    <title>Home - SSF Tech</title>
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
            <div class="row min-vh-hero align-items-center">
                <div class="col-lg-6 col-xl-5">
                    <p class="eyebrow hero-anim">Welcome to SSF Tech</p>
                    <h1 class="hero-anim delay-1">Navigating New <span>Horizons!</span></h1>
                    <h2 class="hero-anim delay-2">You dream, we design, we deliver</h2>
                    <p class="hero-copy hero-anim delay-3">We are a result-driven web development and digital
                        marketing company
                        helping brands grow with powerful digital solutions.</p>
                    <div class="hero-actions hero-anim delay-4">
                        <a href="#contact" class="btn btn-brand">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#portfolio" class="play-link" aria-label="View our work">
                            <span class="play-circle"><i class="fa-solid fa-play"></i></span>
                            View Our Work
                        </a>
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
                    <h2 class="section-title">Building Digital Experiences That <span>Drive Results</span></h2>
                    <p class="muted">Welcome to SSF Tech, your premier website development company in the UK. We
                        transform your
                        vision into captivating websites with our expert development services. From sleek designs to
                        seamless
                        functionality, we specialize in boosting conversions and crafting digital brilliance for
                        your brand's
                        online success.</p>
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
                <div class="col-lg-6 reveal delay-2">
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
            <h2 class="section-title light reveal delay-1">Empowering Businesses Across Industries</h2>
            <div class="industry-grid reveal delay-2">
                <div><i class="fa-solid fa-graduation-cap"></i>Education &<br>Learning</div>
                <div><i class="fa-solid fa-microphone-lines"></i>On-Demand<br>Solutions</div>
                <div><i class="fa-solid fa-photo-film"></i>Media &<br>Entertainment</div>
                <div><i class="fa-solid fa-kitchen-set"></i>Foods &<br>Drink</div>
                <div><i class="fa-solid fa-spa"></i>Health &<br>Fitness</div>
                <div><i class="fa-regular fa-heart"></i>Lifestyle</div>
                <div><i class="fa-solid fa-truck-fast"></i>Transportation &<br>Logistic</div>
            </div>
        </div>
    </section>

    <section class="cta-wrap">
        <div class="container">
            <div class="cta-banner reveal">
                <div class="cta-content">
                    <p>Let's Build Something Amazing Together</p>
                    <h2>Ready to elevate your<br>business to the next level?</h2>
                    <a href="#contact" class="btn btn-brand">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services-section">
        <div class="container">
            <p class="eyebrow reveal">Our Services</p>
            <h2 class="section-title reveal delay-1">Solutions We Provide</h2>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3 reveal">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-laptop-code"></i></span>
                        <h3>Web Development</h3>
                        <p>Custom websites built with modern technologies for performance and scalability.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-1">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-bullhorn"></i></span>
                        <h3>Digital Marketing</h3>
                        <p>Results-driven marketing strategies to grow your brand and reach the right audience.</p>
                        <a href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-2">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-pen-nib"></i></span>
                        <h3>Graphic Designing</h3>
                        <p>Creative designs that speak your brand's story and leave a lasting impression.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-xl-3 reveal delay-3">
                    <article class="service-card"><span class="service-icon"><i class="fa-solid fa-headset"></i></span>
                        <h3>IT Support</h3>
                        <p>Reliable support and maintenance services to keep your business running smoothly.</p><a
                            href="#contact">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </article>
                </div>
            </div>
        </div>
    </section>



    <section class="clients-section">
        <div class="container">
            <div class="clients-panel reveal">
                <p class="eyebrow text-center">Our Clients</p>
                <h2 class="section-title light text-center">Trusted by Innovative Businesses</h2>
                <p class="clients-copy">We've had the privilege of working with a diverse range of clients across
                    industries.
                    Here are some of the brands that trust us.</p>
                <div class="client-logo-grid">
                    @forelse($clients as $client)
                        <div class="client-logo-card"><i class="{{ $client->icon }}"></i><span>{{ $client->name }}</span></div>
                    @empty
                        <div class="client-logo-card"><i class="fa-solid fa-handshake"></i><span>Your Brand</span></div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="portfolio-section section-pad" id="portfolio">
        <div class="container">
            <div class="portfolio-head reveal">
                <div>
                    <p class="eyebrow">Our Work</p>
                    <h2 class="section-title">Digital Experiences<br>We've Crafted for <span>Our Clients.</span>
                    </h2>
                    <p class="muted">We design and develop high-performing websites that help businesses grow.
                        Here are some of
                        our recent projects.</p>
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
                <button class="portfolio-arrow portfolio-prev" type="button" aria-label="Previous project"><i
                        class="fa-solid fa-chevron-left"></i></button>
                <div class="swiper-wrapper">
                    @foreach($projects as $project)
                        <div class="swiper-slide" data-category="{{ $project->category }}">
                            <article class="project-card" data-project-url="{{ $project->project_url ?? '#contact' }}">
                                <div class="project-visual">
                                    <div class="browser-frame">
                                        <!-- Desktop Layout -->
                                        <img class="project-img-desktop" src="{{ url($project->image_desktop) }}" alt="{{ $project->title }} desktop preview">
                                        
                                        <!-- Tablet Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-tablet" src="{{ url($project->image_tablet ?? $project->image_desktop) }}" alt="{{ $project->title }} tablet preview">
                                        
                                        <!-- Mobile Layout (Fallback to desktop if not set) -->
                                        <img class="project-img-mobile" src="{{ url($project->image_mobile ?? $project->image_desktop) }}" alt="{{ $project->title }} mobile preview">
                                    </div>
                                </div>
                                <div class="project-meta">
                                    <strong>{{ $project->title }}</strong>
                                    <span>{{ $project->category == 'webapp' ? 'Web App' : ($project->category == 'ecommerce' ? 'E-Commerce' : 'Website') }}</span>
                                    <a href="{{ $project->project_url ?? '#contact' }}" aria-label="View {{ $project->title }} project">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <button class="portfolio-arrow portfolio-next" type="button" aria-label="Next project"><i
                        class="fa-solid fa-chevron-right"></i></button>
                <div class="portfolio-pagination"></div>
            </div>
        </div>
    </section>

    <section class="faq-section section-pad">
        <div class="container">
            <div class="faq-shell">
                <div class="faq-intro reveal">
                    <span class="faq-badge"><i class="fa-solid fa-circle-question"></i> Support Center</span>
                    <p class="eyebrow">Frequently Asked Questions</p>
                    <h2 class="section-title light">Clear answers before we start building.</h2>
                    <p class="faq-copy">From timelines to support, these are the questions clients usually ask
                        before starting a
                        website or digital project with SSF Tech.</p>
                    <div class="faq-mini-grid">
                        <div><strong>2-4</strong><span>Week launch window</span></div>
                        <div><strong>100%</strong><span>Responsive delivery</span></div>
                    </div>
                </div>
                <div class="faq-content reveal delay-2">
                    <div class="accordion faq-list" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">How
                                    long does it take to build a website?</button></h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">It typically takes 2-4 weeks depending on the
                                    complexity and features
                                    required.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">Will my
                                    website be mobile-friendly?</button></h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes. Every layout is built to work smoothly on mobile,
                                    tablet, laptop, and
                                    desktop screens.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">Do you
                                    provide website maintenance?</button></h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, we provide ongoing maintenance, updates, backups,
                                    and technical
                                    support.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq4">Can you
                                    redesign my existing website?</button></h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, we can refresh your existing website with a modern
                                    design and better
                                    performance.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq5">Is SEO
                                    included in the packages?</button></h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Basic on-page SEO setup is included, with advanced SEO
                                    available as an
                                    add-on.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header"><button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq6">Do you offer
                                    support after the project is
                                    completed?</button></h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">Yes, post-launch support is available to keep your
                                    website stable and
                                    updated.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section section-pad">
        <div class="container">
            <div class="contact-divider"></div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 reveal">
                    <p class="eyebrow">Get In Touch</p>
                    <h2 class="section-title">Let's Start <span>Your Project</span></h2>
                    <p class="muted">Have a project in mind? Fill out the form and we'll get back to you shortly.
                    </p>
                    <form class="contact-form" id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="name" placeholder="Your Name" aria-label="Your Name" required>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="email" name="email" placeholder="Your Email" aria-label="Your Email" required>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" type="tel" name="phone" placeholder="Your Phone" aria-label="Your Phone">
                            </div>
                            <div class="col-12">
                                <select class="form-select" name="service" aria-label="Service you need">
                                    <option value="" selected disabled>Service You Need</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Graphic Designing">Graphic Designing</option>
                                    <option value="IT Support">IT Support</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="Tell us about your project..." aria-label="Project details" required></textarea>
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
                <div class="col-lg-6 reveal delay-2">
                    <aside class="contact-card">
                        <h3>We're here to help you turn your ideas into powerful digital solutions.</h3>
                        <ul>
                            <li><span><i class="fa-solid fa-phone"></i></span> +44 1234 567890</li>
                            <li><span><i class="fa-regular fa-envelope"></i></span> info@ssftech.co.uk</li>
                            <li><span><i class="fa-solid fa-location-dot"></i></span> London, United Kingdom</li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const responseDiv = document.getElementById('formResponse');
        const submitBtn = document.getElementById('submitBtn');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Sending... <i class="fa-solid fa-spinner fa-spin ms-2"></i>';
                
                responseDiv.className = 'mb-3 d-none';
                
                const formData = new FormData(form);
                
                fetch('{{ route("contact.submit") }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(res => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Send Message <i class="fa-solid fa-arrow-right"></i>';
                    
                    if (res.status === 200 && res.body.success) {
                        // Success
                        responseDiv.className = 'alert alert-success bg-success-subtle border-success-subtle text-success p-3 rounded';
                        responseDiv.innerHTML = '<i class="fa-solid fa-circle-check me-2"></i>' + res.body.message;
                        responseDiv.classList.remove('d-none');
                        form.reset();
                    } else {
                        // Error
                        let errMsg = 'Something went wrong. Please try again.';
                        if (res.body.errors) {
                            errMsg = Object.values(res.body.errors).flat().join('<br>');
                        } else if (res.body.message) {
                            errMsg = res.body.message;
                        }
                        responseDiv.className = 'alert alert-danger bg-danger-subtle border-danger-subtle text-danger p-3 rounded';
                        responseDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2"></i>' + errMsg;
                        responseDiv.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Send Message <i class="fa-solid fa-arrow-right"></i>';
                    
                    responseDiv.className = 'alert alert-danger bg-danger-subtle border-danger-subtle text-danger p-3 rounded';
                    responseDiv.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2"></i> Network error. Please check your connection and try again.';
                    responseDiv.classList.remove('d-none');
                });
            });
        }
    });
</script>
@endsection
