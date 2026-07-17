@extends('frontend.layouts.master')

@php
    $seoTitle = $article->meta_title ?: $article->title . ' | SSF Tech';
    $seoDescription = $article->meta_description ?: $article->excerpt;
    $seoImage = $article->hero_image ?: ($article->featured_image ?: $article->image);
@endphp

@section('title')
    <title>{{ $seoTitle }}</title>
@endsection

@section('metas')
    <meta name="description" content="{{ $seoDescription }}">
@endsection
@section('canonical', route('blog.show', $article->slug))
@section('social_metas')
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="SSF Tech">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ route('blog.show', $article->slug) }}">
    <meta property="og:image" content="{{ url($seoImage) }}">
    <meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">
    <meta property="article:section" content="{{ $article->category }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ url($seoImage) }}">
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $seoTitle,
        'description' => $seoDescription,
        'image' => url($seoImage),
        'datePublished' => $article->published_at?->toIso8601String(),
        'dateModified' => $article->updated_at?->toIso8601String(),
        'author' => ['@type' => 'Person', 'name' => $article->author_name],
        'publisher' => ['@type' => 'Organization', 'name' => 'SSF Tech'],
        'mainEntityOfPage' => route('blog.show', $article->slug),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@section('body')
    <section class="article-hero {{ $article->hero_image ? 'has-hero-image' : '' }}" @if($article->hero_image) style="--article-hero-image: url('{{ url($article->hero_image) }}')" @endif>
        <div class="container article-hero-inner">
            <div class="article-hero-copy reveal">
                <div class="blog-breadcrumb">
                    <a href="{{ route('index') }}">Home</a><i class="fa-solid fa-chevron-right"></i>
                    <a href="{{ route('blog.index') }}">Blog</a><i class="fa-solid fa-chevron-right"></i><span>Article</span>
                </div>
                <h1>{{ $article->title }}</h1>
                <p>{{ $article->excerpt }}</p>
                <div class="article-meta">
                    <span><i class="{{ $article->icon }}"></i> {{ $article->category }}</span>
                    <span><i class="fa-regular fa-calendar"></i> {{ $article->date }}</span>
                    <span><i class="fa-regular fa-clock"></i> {{ $article->read_time }}</span>
                    <span><i class="fa-regular fa-user"></i> By {{ $article->author_name }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="article-page section-pad">
        <div class="container">
            <div class="article-layout">
                <article class="article-content">
                    @if($article->featured_image)
                        <img class="article-featured reveal" src="{{ url($article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" decoding="async">
                    @endif
                    <div class="article-prose reveal">
                        <div class="article-rich-text">{!! $article->description !!}</div>
                        @if($article->content_banner)
                            <div class="article-content-banner" style="--article-content-image: url('{{ url($article->content_banner) }}')"><strong>Content that <span>educates</span> today,<br><span>converts</span> tomorrow.</strong></div>
                        @endif
                        <div class="article-tags"><strong>Tags:</strong>@foreach(array_filter(array_map('trim', explode(',', $article->tags ?? ''))) as $tag)<span>{{ $tag }}</span>@endforeach</div>
                        <div class="article-share"><strong>Share this article:</strong><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a><a href="#" aria-label="Copy link"><i class="fa-solid fa-link"></i></a></div>

                        <div class="article-author">
                            <img src="{{ url('frontend/assets/images/extracted/client-avatar-1.png') }}" alt="{{ $article->author_name }}" loading="lazy" decoding="async">
                            <div><h3>{{ $article->author_name }}</h3><span>{{ $article->author_role }}</span><p>{{ $article->author_bio }}</p></div>
                        </div>
                    </div>
                </article>

                @include('frontend.blog.sidebar')
            </div>

            <nav class="article-navigation reveal" aria-label="Article navigation">
                <div>@if($previousArticle)<small>Previous Post</small><a href="{{ route('blog.show', $previousArticle->slug) }}"><i class="fa-solid fa-arrow-left"></i> {{ $previousArticle->title }}</a>@endif</div>
                <div>@if($nextArticle)<small>Next Post</small><a href="{{ route('blog.show', $nextArticle->slug) }}">{{ $nextArticle->title }} <i class="fa-solid fa-arrow-right"></i></a>@endif</div>
            </nav>

            <div class="related-heading"><h2>Related Articles</h2><a href="{{ route('blog.index') }}">View All Articles <i class="fa-solid fa-arrow-right"></i></a></div>
            @if($relatedArticles->isNotEmpty())
                <div class="related-slider swiper reveal">
                    <div class="swiper-wrapper">
                        @foreach($relatedArticles as $related)
                            <div class="swiper-slide">
                                <article class="related-card">
                                    <a href="{{ route('blog.show', $related->slug) }}"><img src="{{ url($related->image) }}" alt="{{ $related->title }}" loading="lazy" decoding="async"></a>
                                    <div><span>{{ $related->category }}</span><h3><a class="blog-title-link" href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h3><small><i class="fa-regular fa-calendar"></i> {{ $related->date }} &nbsp; <i class="fa-regular fa-clock"></i> {{ $related->read_time }}</small></div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($relatedArticles->count() > 1)<div class="related-pagination"></div>@endif
            @endif
        </div>
    </section>
@endsection
