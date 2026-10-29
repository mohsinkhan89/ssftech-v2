@extends('frontend.layouts.master')

@section('title')
    <title>{{ $selectedService->title }} | {{ $categoryLabel }} | SSF Tech</title>
@endsection
@section('metas')
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($selectedService->description), 155) }}">
@endsection
@section('canonical', route('services.detail', [$category, \Illuminate\Support\Str::slug($selectedService->title)]))

@section('body')
    <section class="single-service-hero">
        <div class="container">
            <div class="single-service-hero-grid">
                <div class="single-service-hero-copy reveal">
                    <div class="blog-breadcrumb"><a href="{{ route('index') }}">Home</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('services.index') }}">Services</a><i class="fa-solid fa-chevron-right"></i><a href="{{ route('services.show', $category) }}">{{ $categoryLabel }}</a></div>
                    <p class="eyebrow">{{ $categoryLabel }}</p>
                    <h1>{{ $selectedService->title }}</h1>
                    <p>{{ $selectedService->description }}</p>
                    <div class="services-page-hero-actions"><a class="btn btn-brand" href="{{ route('index') }}#contact">Discuss your project <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a><a class="services-page-text-link" href="#service-overview">Explore the service <i class="fa-solid fa-arrow-down"></i></a></div>
                </div>
                <div class="single-service-hero-visual reveal delay-2">
                    <img src="{{ url($selectedService->cardImagePath()) }}" alt="{{ $selectedService->title }}" decoding="async">
                    <span class="single-service-hero-icon"><i class="{{ $selectedService->icon }}"></i></span>
                    <div class="single-service-hero-label"><small>SSF Tech service</small><strong>Designed around your goals.</strong></div>
                </div>
            </div>
        </div>
    </section>

    <main class="single-service-main" id="service-overview">
        <section class="single-service-overview section-pad">
            <div class="container">
                <div class="single-service-overview-grid">
                    <div class="single-service-overview-copy reveal"><p class="eyebrow">Built for real business outcomes</p><h2>A practical service with <span>purpose behind every decision.</span></h2><p>{{ $selectedService->description }}</p><p>We combine clear strategy, thoughtful execution and dependable communication to create a solution that fits your business today and remains useful as you grow.</p></div>
                    <div class="single-service-benefits reveal delay-2">
                        <article><span><i class="fa-solid fa-compass"></i></span><div><h3>Clear direction</h3><p>A focused plan shaped around your priorities, audience and commercial objectives.</p></div></article>
                        <article><span><i class="fa-solid fa-wand-magic-sparkles"></i></span><div><h3>Purposeful execution</h3><p>Every detail is considered, refined and built to support a better user experience.</p></div></article>
                        <article><span><i class="fa-solid fa-chart-line"></i></span><div><h3>Ready to grow</h3><p>A flexible foundation that can evolve alongside your organisation and future goals.</p></div></article>
                    </div>
                </div>
            </div>
        </section>

        <section class="single-service-feature section-pad">
            <div class="container"><div class="single-service-feature-grid"><div class="single-service-feature-visual"><img src="{{ url($selectedService->cardImagePath()) }}" alt="" loading="lazy" decoding="async"><span><i class="{{ $selectedService->icon }}"></i></span></div><div class="single-service-feature-copy"><p class="eyebrow">How we help</p><h2>Expert thinking.<br><span>Simple collaboration.</span></h2><p>From the first conversation to final delivery, our team keeps the work transparent, focused and easy to understand.</p><ul><li><i class="fa-solid fa-check"></i>A dedicated team that understands your brief</li><li><i class="fa-solid fa-check"></i>Regular communication and visible progress</li><li><i class="fa-solid fa-check"></i>Quality assurance before every launch</li><li><i class="fa-solid fa-check"></i>Support when your needs evolve</li></ul><a class="btn btn-brand" href="{{ route('index') }}#contact">Start a conversation <span class="button-orb"><i class="fa-solid fa-arrow-right"></i></span></a></div></div></div>
        </section>

        @include('frontend.partials.delivery-process')

        @if($relatedServices->isNotEmpty())
            <section class="single-service-related section-pad"><div class="container"><div class="single-service-related-head"><div><p class="eyebrow">Explore more</p><h2>Related <span>{{ $categoryLabel }}</span> services</h2></div><a href="{{ route('services.show', $category) }}">View all services <i class="fa-solid fa-arrow-right"></i></a></div><div class="single-service-related-grid">@foreach($relatedServices as $related)<a class="single-service-related-card" href="{{ route('services.detail', [$category, \Illuminate\Support\Str::slug($related->title)]) }}"><img src="{{ url($related->cardImagePath()) }}" alt="{{ $related->title }}" loading="lazy"><span><i class="{{ $related->icon }}"></i></span><div><small>{{ $categoryLabel }}</small><h3>{{ $related->title }}</h3><p>{{ \Illuminate\Support\Str::limit($related->description, 105) }}</p><strong>View service <i class="fa-solid fa-arrow-right"></i></strong></div></a>@endforeach</div></div></section>
        @endif
    </main>
@endsection
