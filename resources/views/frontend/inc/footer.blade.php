<footer class="site-footer" id="site-footer">
    <div class="container">
        <div class="footer-invitation">
            <div><p class="eyebrow">Your ambition. Our expertise.</p><h2>Have a big idea?<br><span>Let&#39;s make it work.</span></h2></div>
            <a class="btn btn-brand" href="{{ route('index') }}#contact">Start a conversation <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
        </div>
        <div class="footer-shell">
            <div class="row g-4 footer-main">
                <div class="col-lg-3 col-md-6 footer-about">
                    <a class="brand-lockup footer-brand" href="{{ route('index') }}#home" aria-label="SSF Tech home">
                        <div class="footer-logo">
                            <img src="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech" loading="lazy" decoding="async">
                        </div>
                    </a>
                    <p class="footer-tagline">Innovative technology solutions that empower businesses and drive
                        digital
                        transformation.</p>
                    @if($socialLinks->isNotEmpty())
                    <div class="follow-us">
                        <h4>Follow Us</h4>
                        <div class="socials">
                            @foreach($socialLinks as $socialLink)
                                <a href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLink->platform }}"><i class="{{ $socialLink->icon }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-3 col-md-6 footer-links footer-links-about">
                    <h4>About Us</h4>
                    <a href="{{ route('index') }}#about"><span><i class="fa-solid fa-chevron-right"></i></span>About Us</a>
                    <a href="{{ route('index') }}#contact"><span><i class="fa-solid fa-chevron-right"></i></span>Contact Us</a>
                    <a href="{{ route('index') }}#portfolio">Our Work</a>
                    <a href="{{ route('index') }}#faqs">FAQs</a>
                </div>
                @if($footerServices->isNotEmpty())
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    @foreach($footerServices as $service)
                        <a href="{{ route('index') }}#services"><span><i class="fa-solid fa-chevron-right"></i></span>{{ $service->title }}</a>
                    @endforeach
                </div>
                @endif
                @if($siteSetting?->contact_address || $siteSetting?->contact_phone || $siteSetting?->contact_email)
                <div class="col-lg-3 col-md-6 footer-contact-social">
                    <h4>Contact Us</h4>
                    <div class="footer-contact-list">
                        @if($siteSetting?->contact_address)
                        <div class="footer-contact-item top-icon">
                            <span><i class="fa-solid fa-location-dot"></i></span>
                            <div>{!! nl2br(e($siteSetting->contact_address)) !!}</div>
                        </div>
                        @endif
                        @if($siteSetting?->contact_phone)
                            <a class="footer-contact-item text-decoration-none" href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSetting->contact_phone) }}"><span><i class="fa-solid fa-phone"></i></span>{{ $siteSetting->contact_phone }}</a>
                        @endif
                        @if($siteSetting?->contact_email)
                            <a class="footer-contact-item text-decoration-none" href="mailto:{{ $siteSetting->contact_email }}"><span><i class="fa-solid fa-envelope"></i></span>{{ $siteSetting->contact_email }}</a>
                        @endif
                    </div>
                </div>
                @endif
                <!-- <div class="col-12 footer-newsletter">
              <h4>Subscribe To Our Newsletter</h4>
              <p>Subscribe To Newsletter To Stay Up To Date On Our Latest News.</p>
              <form class="newsletter">
                <label class="newsletter-icon" for="newsletter-email"><i class="fa-solid fa-envelope"></i></label>
                <input id="newsletter-email" type="email" placeholder="Enter Your Email" aria-label="Newsletter email">
                <button type="submit">Subscribe <i class="fa-solid fa-arrow-right"></i></button>
              </form>
            </div> -->
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-decor footer-bottom-decor-left"></div>
            <div class="footer-bottom-copy">
                <span class="footer-bottom-badge"><i class="fa-solid fa-shield-halved"></i></span>
                <p>&copy; {{ date('Y') }} SSF Tech. All rights reserved.</p>
                <small>SSF Tech is a leading technology division under SSF Group, delivering cutting-edge solutions
                    with
                    excellence.</small>
            </div>
            <div class="footer-bottom-decor footer-bottom-decor-right"></div>
        </div>
    </div>
</footer>
