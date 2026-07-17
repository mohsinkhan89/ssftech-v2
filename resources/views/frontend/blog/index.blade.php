@extends('frontend.layouts.master')

@section('title')
    <title>Our Blog & Insights | SSF Tech</title>
@endsection
@section('metas')
    <meta name="description" content="Explore SSF Tech insights on web design, development, digital marketing, branding and technology.">
@endsection
@section('canonical', route('blog.index'))
@section('social_metas')
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SSF Tech">
    <meta property="og:title" content="Our Blog &amp; Insights | SSF Tech">
    <meta property="og:description" content="Explore SSF Tech insights on web design, development, digital marketing, branding and technology.">
    <meta property="og:url" content="{{ route('blog.index') }}">
    @if($popularArticles->isNotEmpty())<meta property="og:image" content="{{ url($popularArticles->first()->image) }}">@endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Our Blog &amp; Insights | SSF Tech">
    <meta name="twitter:description" content="Explore SSF Tech insights on web design, development, digital marketing, branding and technology.">
    @if($popularArticles->isNotEmpty())<meta name="twitter:image" content="{{ url($popularArticles->first()->image) }}">@endif
@endsection

@section('body')
    <section class="blog-hero">
        <div class="container">
            <div class="blog-hero-copy reveal">
                <div class="blog-breadcrumb"><a href="{{ route('index') }}">Home</a><i class="fa-solid fa-chevron-right"></i><span>Blog</span></div>
                <h1>Our Blog <span>&amp; Insights</span></h1>
                <p>Stay updated with the latest insights, trends, and strategies in digital design, development, and marketing.</p>
            </div>
        </div>
    </section>

    <section class="blog-catalog section-pad">
        <div class="container">
            <div class="blog-catalog-layout">
                <div class="blog-results">
                    <form class="blog-toolbar" action="{{ route('blog.index') }}" method="GET">
                        @if($search !== '')<input type="hidden" name="search" value="{{ $search }}">@endif
                        <div class="blog-filter-group">
                            <select name="category" aria-label="Filter by category" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item['name'] }}" @selected($category === $item['name'])>{{ $item['name'] }} ({{ $item['count'] }})</option>
                                @endforeach
                            </select>
                            <select name="sort" aria-label="Sort articles" onchange="this.form.submit()">
                                <option value="latest" @selected($sort === 'latest')>Latest</option>
                                <option value="oldest" @selected($sort === 'oldest')>Oldest</option>
                            </select>
                        </div>
                        <span>Showing {{ $articles->count() }} results</span>
                    </form>

                    <div class="blog-list">
                        @forelse($articles as $article)
                            <article class="blog-list-card reveal">
                                <img src="{{ url($article->image) }}" alt="{{ $article->title }}" loading="lazy" decoding="async">
                                <div class="blog-list-card-body">
                                    <span class="blog-list-category"><i class="{{ $article->icon }}"></i> {{ $article->category }}</span>
                                    <h2><a class="blog-title-link" href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a></h2>
                                    <p>{{ $article->excerpt }}</p>
                                    <div class="blog-list-footer">
                                        <div><span><i class="fa-regular fa-calendar"></i> {{ $article->date }}</span><span><i class="fa-regular fa-clock"></i> {{ $article->read_time }}</span></div>
                                        <a href="{{ route('blog.show', $article->slug) }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="blog-empty-state">
                                <i class="fa-regular fa-folder-open"></i>
                                <h2>No articles found</h2>
                                <p>Try another search term or category.</p>
                                <a href="{{ route('blog.index') }}" class="btn btn-brand">View All Articles</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <aside class="blog-sidebar">
                    <div class="blog-sidebar-card">
                        <h3>Search</h3>
                        <form class="blog-search" action="{{ route('blog.index') }}" method="GET"><input type="search" name="search" value="{{ $search }}" placeholder="Search articles..." aria-label="Search articles"><button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button></form>
                    </div>

                    @if($categories->isNotEmpty())
                        <div class="blog-sidebar-card">
                            <h3>Categories</h3>
                            <a class="blog-category-link" href="{{ route('blog.index') }}"><span><i class="fa-solid fa-table-cells-large"></i> All Categories</span><strong>({{ $categories->sum('count') }})</strong></a>
                            @foreach($categories as $item)
                                <a class="blog-category-link" href="{{ route('blog.index', ['category' => $item['name']]) }}"><span><i class="{{ $item['icon'] }}"></i> {{ $item['name'] }}</span><strong>({{ $item['count'] }})</strong></a>
                            @endforeach
                        </div>
                    @endif

                    @if($popularArticles->isNotEmpty())
                        <div class="blog-sidebar-card">
                            <h3>Popular Posts</h3>
                            @foreach($popularArticles as $article)
                                <a class="popular-post" href="{{ route('blog.show', $article->slug) }}">
                                    <img src="{{ url($article->image) }}" alt="{{ $article->title }}" loading="lazy" decoding="async">
                                    <span><strong>{{ \Illuminate\Support\Str::limit($article->title, 48) }}</strong><small>{{ $article->date }}</small></span>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <div class="blog-sidebar-card blog-newsletter">
                        <span class="blog-newsletter-icon"><i class="fa-solid fa-paper-plane"></i></span>
                        <h3>Subscribe to Our Newsletter</h3>
                        <p>Get the latest insights and updates delivered straight to your inbox.</p>
                        <form onsubmit="return false;"><input type="email" placeholder="Enter your email address" aria-label="Email address"><button type="submit">Subscribe Now <i class="fa-solid fa-arrow-right"></i></button></form>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
