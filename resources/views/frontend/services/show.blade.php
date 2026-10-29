@extends('frontend.layouts.master')

@php
    $categoryContent = [
        'development' => ['fa-laptop-code', 'Build your digital foundation.', 'Websites, applications and connected experiences designed around your users and commercial goals.', 'frontend/assets/images/stock/development-team.webp'],
        'crm' => ['fa-address-book', 'Better relationships. Smarter sales.', 'Connect customer data, automate follow-ups and give your team a clearer view of every opportunity.', 'frontend/assets/images/stock/crm-collaboration.webp'],
        'erp' => ['fa-building-columns', 'One business. Connected operations.', 'Bring people, information and everyday workflows together in systems built for your organisation.', 'frontend/assets/images/stock/business-analytics.webp'],
        'marketing' => ['fa-bullseye', 'Get discovered. Build demand.', 'Strategy, creative content and measurable campaigns that turn attention into meaningful growth.', 'frontend/assets/images/stock/marketing-strategy.webp'],
    ][$category];
@endphp

@section('title')
    <title>{{ $categoryLabel }} Services | SSF Tech</title>
@endsection
@section('metas')
    <meta name="description" content="Explore SSF Tech {{ $categoryLabel }} services and find the right digital solution for your business.">
@endsection
@section('canonical', route('services.show', $category))

@section('body')
    <section class="service-detail-hero">
        <div class="container">
            <div class="service-detail-hero-grid">
                <div class="service-detail-hero-copy reveal">
                    <div class="blog-breadcrumb"><a href="{{ route('index') }}">Home</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('services.index') }}">Services</a><i class="fa-solid fa-chevron-right"></i><span>{{ $categoryLabel }}</span></div>
                    <p class="eyebrow">{{ $categoryLabel }}</p>
                    <h1>{{ $categoryContent[1] }}</h1>
                    <p>{{ $categoryContent[2] }}</p>
                    <div class="services-page-hero-actions"><a class="btn btn-brand" href="#available-services">Explore services <span class="button-orb"><i class="fa-solid fa-arrow-down"></i></span></a><a class="services-page-text-link" href="{{ route('index') }}#contact">Discuss your project <i class="fa-solid fa-arrow-right"></i></a></div>
                </div>
                <div class="service-detail-hero-visual reveal delay-2"><img src="{{ url($categoryContent[3]) }}" alt="{{ $categoryLabel }} team" decoding="async"><span><i class="fa-solid {{ $categoryContent[0] }}"></i></span><div><small>Specialist expertise</small><strong>{{ $services->count() }} services available</strong></div></div>
            </div>
        </div>
    </section>

    <main class="service-detail-main" id="available-services">
        <section class="service-detail-list section-pad">
            <div class="container">
                <div class="services-section-heading">
                    <p class="eyebrow">What we offer</p>
                    <h2 class="section-title">Our <span>{{ $categoryLabel }}</span> Services</h2>
                    <p class="muted">Choose the support your business needs today, with the flexibility to expand as your goals evolve.</p>
                </div>
                <div class="service-detail-grid">
                    @foreach($services as $service)
                        <article class="service-detail-card reveal" id="service-{{ $service->id }}" data-service-card data-service-category="{{ $category }}">
                            <div class="service-detail-card-image"><img src="{{ url($service->cardImagePath()) }}" alt="{{ $service->title }}" loading="lazy" decoding="async"><span><i class="{{ $service->icon }}"></i></span><small>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</small></div>
                            <div class="service-detail-card-body"><p class="eyebrow">{{ $categoryLabel }}</p><h3>{{ $service->title }}</h3><p>{{ $service->description }}</p><a class="btn btn-brand" href="{{ route('index') }}#contact">Discuss this service <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a></div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        @include('frontend.partials.delivery-process')
    </main>

    <section class="service-detail-cta">
        <div class="container"><div class="service-detail-cta-inner"><div><p class="eyebrow">Ready to move forward?</p><h2>Let’s find the right {{ strtolower($categoryLabel) }} solution.</h2><p>Share your goals with our team and we’ll recommend a practical next step.</p></div><a class="btn btn-brand" href="{{ route('index') }}#contact">Get a free quote <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a></div></div>
    </section>
@endsection
