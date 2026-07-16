@extends('frontend.layouts.master')

@section('title')
    <title>Our Blog & Insights | SSF Tech</title>
@endsection
@section('metas')
    <meta name="description" content="Explore SSF Tech insights on web design, development, digital marketing, branding and technology.">
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
                    <div class="blog-toolbar">
                        <div class="blog-filter-group">
                            <select aria-label="Filter by category"><option>All Categories</option><option>Web Design</option><option>Development</option><option>Marketing</option><option>Branding</option><option>Technology</option></select>
                            <select aria-label="Sort articles"><option>Latest</option><option>Oldest</option><option>Most Popular</option></select>
                        </div>
                        <span>Showing 1–6 of {{ $articles->count() }} results</span>
                    </div>

                    <div class="blog-list">
                        @foreach($articles as $article)
                            <article class="blog-list-card reveal">
                                <img src="{{ url($article->image) }}" alt="{{ $article->title }}">
                                <div class="blog-list-card-body">
                                    <span class="blog-list-category"><i class="{{ $article->icon }}"></i> {{ $article->category }}</span>
                                    <h2>{{ $article->title }}</h2>
                                    <p>{{ $article->excerpt }}</p>
                                    <div class="blog-list-footer">
                                        <div><span><i class="fa-regular fa-calendar"></i> {{ $article->date }}</span><span><i class="fa-regular fa-clock"></i> {{ $article->read_time }}</span></div>
                                        <a href="{{ route('blog.show', $article->slug) }}">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <nav class="blog-pagination" aria-label="Blog pagination">
                        <a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><span>…</span><a href="#">8</a><a href="#" aria-label="Next page"><i class="fa-solid fa-chevron-right"></i></a>
                    </nav>
                </div>

                <aside class="blog-sidebar">
                    <div class="blog-sidebar-card">
                        <h3>Search</h3>
                        <form class="blog-search" onsubmit="return false;"><input type="search" placeholder="Search articles..." aria-label="Search articles"><button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button></form>
                    </div>

                    <div class="blog-sidebar-card">
                        <h3>Categories</h3>
                        @foreach([
                            ['name' => 'All Categories', 'count' => 24, 'icon' => 'fa-solid fa-table-cells-large'],
                            ['name' => 'Web Design', 'count' => 6, 'icon' => 'fa-solid fa-laptop-code'],
                            ['name' => 'Development', 'count' => 5, 'icon' => 'fa-solid fa-code'],
                            ['name' => 'Marketing', 'count' => 6, 'icon' => 'fa-solid fa-bullhorn'],
                            ['name' => 'Branding', 'count' => 4, 'icon' => 'fa-solid fa-pen-nib'],
                            ['name' => 'Technology', 'count' => 3, 'icon' => 'fa-solid fa-microchip'],
                        ] as $category)
                            <a class="blog-category-link" href="#"><span><i class="{{ $category['icon'] }}"></i> {{ $category['name'] }}</span><strong>({{ $category['count'] }})</strong></a>
                        @endforeach
                    </div>

                    <div class="blog-sidebar-card">
                        <h3>Popular Posts</h3>
                        @foreach($articles->take(5) as $article)
                            <a class="popular-post" href="{{ route('blog.show', $article->slug) }}">
                                <img src="{{ url($article->image) }}" alt="">
                                <span><strong>{{ \Illuminate\Support\Str::limit($article->title, 48) }}</strong><small>{{ $article->date }}</small></span>
                            </a>
                        @endforeach
                    </div>

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
