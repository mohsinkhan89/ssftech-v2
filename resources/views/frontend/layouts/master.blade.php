<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    @hasSection('title')
        @yield('title')
    @else
        <title>SSF Tech - Digital Solutions</title>
    @endif
    @yield('metas')
    @hasSection('social_metas')
        @yield('social_metas')
    @else
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="SSF Tech">
        <meta property="og:title" content="SSF Tech - Digital Solutions">
        <meta property="og:description" content="SSF Tech provides website development, digital design and marketing solutions for growing businesses.">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="SSF Tech - Digital Solutions">
        <meta name="twitter:description" content="SSF Tech provides website development, digital design and marketing solutions for growing businesses.">
        <meta name="twitter:image" content="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}">
    @endif
    @yield('css')

    <link rel="apple-touch-icon" sizes="57x57" href="{{url('frontend/assets/images/favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('frontend/assets/images/favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('frontend/assets/images/favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('frontend/assets/images/favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('frontend/assets/images/favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('frontend/assets/images/favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('frontend/assets/images/favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('frontend/assets/images/favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('frontend/assets/images/favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('frontend/assets/images/favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('frontend/assets/images/favicons//favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('frontend/assets/images/favicons//favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('frontend/assets/images/favicons//favicon-16x16.png')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#e40914">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#e40914">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('frontend/assets/css/style.css') }}?v={{ $siteSetting?->css_version ?: env('ASSET_VERSION', '1.0.0') }}">
</head>

<body>
    <div class="site-loader" role="status" aria-live="polite" aria-label="Loading SSF Tech">
        <div class="loader-grid" aria-hidden="true"></div>
        <div class="loader-core">
            <div class="loader-orbit">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="loader-mark">
                <img src="{{ url($siteSetting?->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech">
            </div>
            <div class="loader-copy">
                <strong>SSF Tech</strong>
                <small>Initializing digital solutions</small>
            </div>
            <div class="loader-progress" aria-hidden="true"><span></span></div>
        </div>
    </div>
    @include('frontend.inc.header')
    <main>
        @yield('body')
    </main>
    @include('frontend.inc.footer')
    @include('frontend.inc.cookie-consent')

    <button class="back-to-top" type="button" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('frontend/assets/js/main.js') }}?v={{ $siteSetting?->js_version ?: env('ASSET_VERSION', '1.0.0') }}"></script>
</body>

</html>
