@extends('frontend.layouts.master')

@section('title')
    <title>Digital Services | Web, CRM, ERP & Marketing | SSF Tech</title>
@endsection
@section('metas')
    <meta name="description" content="Explore SSF Tech services across development and design, CRM solutions, ERP systems and digital marketing.">
@endsection
@section('canonical', route('services.index'))

@section('body')
    @php
        $categoryContent = [
            'development' => ['fa-laptop-code', 'Build your digital foundation.', 'High-performing websites, applications and digital experiences designed around your customers and commercial goals.', 'Strategy, UX and interface design', 'Websites and custom applications'],
            'crm' => ['fa-address-book', 'Better relationships. Smarter sales.', 'Bring customer information, communication and sales activity together so your team can follow every opportunity clearly.', 'Customer data and sales pipelines', 'Automation and system integrations'],
            'erp' => ['fa-building-columns', 'One business. Connected operations.', 'Connect finance, people, inventory and daily workflows through practical systems shaped around how your organisation works.', 'Connected business operations', 'Reporting and workflow automation'],
            'marketing' => ['fa-bullseye', 'Get discovered. Build demand.', 'Focused strategy, creative content and measurable campaigns that help the right audience discover and choose your business.', 'Search and paid campaigns', 'Content and conversion strategy'],
        ];
    @endphp

    <section class="services-page-hero">
        <div class="container">
            <div class="services-page-hero-grid">
                <div class="services-page-hero-copy reveal">
                    <div class="blog-breadcrumb"><a href="{{ route('index') }}">Home</a><i class="fa-solid fa-chevron-right"></i><span>Services</span></div>
                    <h1>Everything your business needs to <span>move forward.</span></h1>
                    <p>One experienced team for the customer experiences, business systems and digital growth strategies behind a stronger organisation.</p>
                    <div class="services-page-hero-actions">
                        <a class="btn btn-brand" href="#main-services">Explore our services <span class="button-orb"><i class="fa-solid fa-arrow-down"></i></span></a>
                        <a class="btn btn-brand services-page-outline-cta" href="{{ route('index') }}#contact">Start your project <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
                <div class="services-page-hero-visual reveal delay-2">
                    <img src="{{ url('frontend/assets/images/stock/development-team.webp') }}" alt="SSF Tech digital services team" decoding="async">
                    <span class="services-page-hero-visual-icon"><i class="fa-solid fa-layer-group"></i></span>
                    <div class="services-page-hero-visual-copy"><small>One experienced team</small><strong>{{ $serviceCategories->count() }} core services.<br>Built around your goals.</strong></div>
                    <div class="services-page-hero-tags">@foreach($serviceCategories as $key => $label)<a href="#category-{{ $key }}">{{ $label }}</a>@endforeach</div>
                </div>
            </div>
        </div>
    </section>

    <main class="services-page-main" id="main-services">
        <section class="services-page-overview section-pad">
            <div class="container">
                <div class="services-section-heading">
                    <p class="eyebrow reveal">Our Services</p>
                    <h2 class="section-title reveal delay-1">Bespoke Digital Solutions for <span>Every Business</span></h2>
                    <p class="muted reveal delay-2">Four connected areas of expertise to help you create better customer experiences, simplify operations and build sustainable growth.</p>
                </div>
                <div class="services-page-main-grid">
                    @foreach($serviceCategories as $key => $label)
                        @php $content = $categoryContent[$key] ?? ['fa-layer-group', $label, 'Flexible digital expertise shaped around your business.', 'Practical digital strategy', 'Reliable delivery and support']; $representativeService = $services->firstWhere('category', $key); @endphp
                        <article class="services-page-main-card reveal" id="category-{{ $key }}" data-service-card data-service-category="{{ $key }}">
                            <div class="services-page-main-visual">
                                @if($representativeService)<img src="{{ url($representativeService->cardImagePath()) }}" alt="{{ $label }}" loading="lazy" decoding="async">@endif
                                <div class="services-page-main-index">0{{ $loop->iteration }}</div><span class="services-page-main-icon"><i class="fa-solid {{ $content[0] }}"></i></span>
                            </div>
                            <div class="services-page-main-content">
                                <p class="eyebrow">{{ $label }}</p><h3>{{ $content[1] }}</h3><p>{{ $content[2] }}</p>
                                <ul><li><i class="fa-solid fa-check"></i>{{ $content[3] }}</li><li><i class="fa-solid fa-check"></i>{{ $content[4] }}</li></ul>
                                <a class="btn btn-brand services-page-card-cta" href="{{ route('services.show', $key) }}">Explore {{ $label }} <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        @include('frontend.partials.delivery-process')
    </main>

    <section class="services-page-cta">
        <div class="container">
            <div class="services-page-cta-inner services-page-cta-background">
                <div class="services-page-cta-copy"><p class="eyebrow">You dream, we design, we deliver.</p><h2>Not sure which service is right for you?</h2><p>Tell us what you want to achieve. We’ll recommend the clearest route forward.</p></div>
                <a class="btn btn-brand" href="{{ route('index') }}#contact">Get a free quote <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
        </div>
    </section>
@endsection
