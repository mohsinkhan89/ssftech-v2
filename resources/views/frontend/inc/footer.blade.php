<footer class="site-footer footer-modern" id="site-footer">
    <div class="container">
        <div class="footer-main-grid">
            <div class="footer-about">
                <a class="footer-brand" href="{{ route('index') }}#home" aria-label="SSF Tech home">
                    <span class="footer-logo">
                        <img src="{{ url($siteSetting?->footer_logo ?: $siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech" loading="lazy" decoding="async">
                    </span>
                </a>
                <p class="footer-tagline">Innovative technology solutions that empower businesses and drive digital transformation.</p>
                <span class="footer-status"><i></i> Available for new projects</span>
            </div>

            <nav class="footer-links" aria-label="Company links">
                <h4>Company</h4>
                <a href="{{ route('index') }}#about">About Us <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                <a href="{{ route('index') }}#portfolio">Our Work <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                <a href="{{ route('blog.index') }}">Our Blog <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                <a href="{{ route('index') }}#faqs">FAQs <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            </nav>

            @if($footerServices->isNotEmpty())
            <nav class="footer-links" aria-label="Service links">
                <h4>Expertise</h4>
                @foreach(\App\Models\Service::CATEGORIES as $key => $label)
                    @if($footerServices->contains('category', $key))
                        <a href="{{ route('index') }}#services">{{ $label }} <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    @endif
                @endforeach
            </nav>
            @endif

            <div class="footer-contact-social">
                <h4>Let&#39;s connect</h4>
                <div class="footer-contact-list">
                    @if($siteSetting?->contact_email)
                        <a class="footer-email" href="mailto:{{ $siteSetting->contact_email }}">{{ $siteSetting->contact_email }} <i class="fa-solid fa-arrow-right"></i></a>
                    @endif
                    @if($siteSetting?->contact_phone)
                        <a class="footer-contact-line" href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSetting->contact_phone) }}"><i class="fa-solid fa-phone"></i>{{ $siteSetting->contact_phone }}</a>
                    @endif
                    @if($siteSetting?->contact_address)
                        <div class="footer-contact-line"><i class="fa-solid fa-location-dot"></i><span>{!! nl2br(e($siteSetting->contact_address)) !!}</span></div>
                    @endif
                </div>
                @if($socialLinks->isNotEmpty())
                <div class="socials footer-socials">
                    @foreach($socialLinks as $socialLink)
                        <a href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $socialLink->platform }}"><i class="{{ $socialLink->icon }}"></i></a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="footer-pillars" aria-label="Our approach">
            <span>Strategy</span><i></i><span>Technology</span><i></i><span>Growth</span>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SSF Tech. All rights reserved.</p>
            <p class="footer-company-note">SSF Tech is a leading technology division under SSF Group, delivering cutting-edge solutions with excellence.</p>
        </div>
    </div>
    <div class="footer-wordmark" aria-hidden="true"><span>SSF</span> <span>TECH</span></div>
</footer>
