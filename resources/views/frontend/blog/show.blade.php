@extends('frontend.layouts.master')

@section('title')
    <title>{{ $article->title }} | SSF Tech</title>
@endsection

@section('metas')
    <meta name="description" content="{{ $article->excerpt }}">
@endsection

@section('body')
    <section class="article-hero" style="--article-hero-image: url('{{ url($article->hero_image ?? $article->image) }}')">
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
                    <img class="article-featured reveal" src="{{ url($article->featured_image ?? $article->image) }}" alt="{{ $article->title }}">
                    <div class="article-prose reveal">
                        <div class="article-rich-text">{!! $article->description !!}</div>
                        <div class="article-content-banner" style="--article-content-image: url('{{ url($article->content_banner ?? $article->image) }}')"><strong>Content that <span>educates</span> today,<br><span>converts</span> tomorrow.</strong></div>
                        <div class="article-tags"><strong>Tags:</strong>@foreach(array_filter(array_map('trim', explode(',', $article->tags ?? ''))) as $tag)<span>{{ $tag }}</span>@endforeach</div>
                        <div class="article-share"><strong>Share this article:</strong><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a><a href="#" aria-label="Copy link"><i class="fa-solid fa-link"></i></a></div>

                        <div class="article-author">
                            <img src="{{ url('frontend/assets/images/extracted/client-avatar-1.png') }}" alt="{{ $article->author_name }}">
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
            <div class="related-articles">
                @foreach($relatedArticles as $related)
                    <article class="related-card reveal">
                        <a href="{{ route('blog.show', $related->slug) }}"><img src="{{ url($related->image) }}" alt="{{ $related->title }}"></a>
                        <div><span>{{ $related->category }}</span><h3><a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h3><small><i class="fa-regular fa-calendar"></i> {{ $related->date }} &nbsp; <i class="fa-regular fa-clock"></i> {{ $related->read_time }}</small></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
