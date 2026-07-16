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
                <h1>
                    @if($article->slug === 'digital-marketing-growth')
                        Digital Marketing Strategies<br>That Deliver <span>Real Business Growth</span>
                    @else
                        {{ $article->title }}
                    @endif
                </h1>
                <p>{{ $article->excerpt }}</p>
                <div class="article-meta">
                    <span><i class="{{ $article->icon }}"></i> {{ $article->category }}</span>
                    <span><i class="fa-regular fa-calendar"></i> {{ $article->date }}</span>
                    <span><i class="fa-regular fa-clock"></i> {{ $article->read_time }}</span>
                    <span><i class="fa-regular fa-user"></i> By Sarah Johnson</span>
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
                        <p>In today’s competitive digital landscape, having a great product or service isn’t enough. You need a strategic digital approach that not only attracts attention but also converts it into measurable business results.</p>

                        <h2>1. Understand Your Audience Deeply</h2>
                        <p>Successful marketing starts with understanding. Create detailed buyer personas, analyse user behaviour, and identify pain points. The more you understand your audience, the better you can create messages that resonate.</p>

                        <blockquote><i class="fa-solid fa-quote-left"></i><div>Marketing is no longer about the stuff that you make, but about the stories you tell.<cite>— Seth Godin</cite></div></blockquote>

                        <h2>2. Build a Strong Digital Presence</h2>
                        <p>Your website is your digital storefront. Ensure it’s fast, mobile-friendly, SEO-optimised, and delivers a seamless user experience. Combine this with consistent branding across all channels to build trust and credibility.</p>

                        <div class="article-stats">
                            <div><i class="fa-solid fa-globe"></i><strong>94%</strong><span>Users judge credibility based on design</span></div>
                            <div><i class="fa-regular fa-clock"></i><strong>53%</strong><span>Visitors abandon if a site takes &gt;3s</span></div>
                            <div><i class="fa-solid fa-mobile-screen"></i><strong>67%</strong><span>Traffic comes from mobile devices</span></div>
                            <div><i class="fa-solid fa-arrow-trend-up"></i><strong>2.8x</strong><span>More conversions with strong UX</span></div>
                        </div>

                        <h2>3. Create Valuable, Engaging Content</h2>
                        <p>Content is the bridge between your brand and your audience. Publish useful articles, videos, case studies, and guides that educate, inspire, and solve problems. Valuable content drives traffic, builds authority, and nurtures leads.</p>

                        <div class="article-content-banner" style="--article-content-image: url('{{ url($article->content_banner ?? $article->image) }}')"><strong>Content that <span>educates</span> today,<br><span>converts</span> tomorrow.</strong></div>

                        <h2>4. Leverage Data and Analytics</h2>
                        <p>Data-driven decisions lead to better outcomes. Track KPIs, analyse user behaviour, and continuously optimise campaigns to maximise ROI. The right data reveals what’s working—and what’s not.</p>

                        <div class="article-takeaways">
                            <strong>Key Takeaways</strong>
                            <ul><li>Know your audience and tailor your message</li><li>Build a strong, optimised digital presence</li><li>Create content that adds real value</li><li>Use data to refine your strategies and drive growth</li></ul>
                        </div>

                        <div class="article-tags"><strong>Tags:</strong><span>Digital Marketing</span><span>Growth Strategy</span><span>Lead Generation</span><span>Business Growth</span><span>SEO</span></div>
                        <div class="article-share"><strong>Share this article:</strong><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a><a href="#" aria-label="Copy link"><i class="fa-solid fa-link"></i></a></div>

                        <div class="article-author">
                            <img src="{{ url('frontend/assets/images/extracted/client-avatar-1.png') }}" alt="Sarah Johnson">
                            <div><h3>Sarah Johnson</h3><span>Digital Marketing Strategist at SSF Tech</span><p>Sarah helps brands grow their online presence through data-driven marketing strategies, content that converts, and performance-focused campaigns.</p></div>
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
