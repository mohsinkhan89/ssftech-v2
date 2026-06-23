<!doctype html>
<html lang="en">

<head>
    @yield('metas')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <title>SSF Tech - Digital Solutions</title>
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('frontend/assets/css/style.css') }}">
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
                <img src="{{ url('frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="">
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

    <button class="back-to-top" type="button" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('frontend/assets/js/main.js') }}"></script>
</body>

</html>
