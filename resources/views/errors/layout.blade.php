<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') - @yield('title') | SSF Tech</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        *{box-sizing:border-box}body{margin:0;min-height:100vh;display:grid;place-items:center;padding:28px;font-family:'Poppins',sans-serif;color:#fff;background:radial-gradient(circle at 72% 24%,rgba(228,9,20,.24),transparent 28%),linear-gradient(135deg,#02040a,#0c080d 55%,#210309);overflow:hidden}.error-grid{position:fixed;inset:0;opacity:.18;background-image:linear-gradient(rgba(228,9,20,.16) 1px,transparent 1px),linear-gradient(90deg,rgba(228,9,20,.16) 1px,transparent 1px);background-size:42px 42px;transform:perspective(500px) rotateX(64deg) scale(1.6);transform-origin:bottom}.error-shell{position:relative;z-index:1;width:min(720px,100%);padding:54px 38px;text-align:center;border:1px solid rgba(228,9,20,.42);border-radius:18px;background:linear-gradient(145deg,rgba(30,31,38,.92),rgba(5,6,10,.96));box-shadow:0 30px 80px rgba(0,0,0,.55),0 0 45px rgba(228,9,20,.14)}.error-logo{width:150px;max-height:70px;object-fit:contain;margin-bottom:24px}.error-code{margin:0;color:#e40914;font-size:clamp(82px,18vw,164px);line-height:.85;font-weight:900;letter-spacing:-8px;text-shadow:0 0 35px rgba(228,9,20,.4)}h1{margin:28px 0 12px;font-size:clamp(26px,5vw,42px);line-height:1.15;font-weight:800}p{max-width:560px;margin:0 auto 24px;color:#cbd0da;font-size:14px;line-height:1.75}.redirect-note{display:inline-flex;align-items:center;gap:8px;margin-bottom:26px;padding:8px 14px;border:1px solid rgba(228,9,20,.25);border-radius:999px;background:rgba(228,9,20,.08);color:#d7d8dc;font-size:12px}.redirect-note strong{color:#e40914;font-size:14px}.actions{display:flex;justify-content:center;gap:12px;flex-wrap:wrap}.btn{min-height:48px;display:inline-flex;align-items:center;gap:9px;padding:0 22px;border:1px solid rgba(255,255,255,.15);border-radius:8px;color:#fff;text-decoration:none;font-size:13px;font-weight:700;background:rgba(255,255,255,.05);transition:transform .25s ease,background .25s ease}.btn-primary{border-color:#e40914;background:#e40914;box-shadow:0 10px 30px rgba(228,9,20,.3)}.btn:hover{transform:translateY(-2px)}@media(max-width:575px){.error-shell{padding:40px 20px}.error-code{letter-spacing:-4px}.actions{flex-direction:column}.btn{justify-content:center;width:100%}}
    </style>
</head>
<body>
    <div class="error-grid" aria-hidden="true"></div>
    <main class="error-shell">
        <img class="error-logo" src="{{ url('frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech">
        <div class="error-code">@yield('code')</div>
        <h1>@yield('heading')</h1>
        <p>@yield('message')</p>
        <div class="redirect-note"><i class="fa-regular fa-clock"></i> Redirecting to homepage in <strong id="redirectCountdown">10</strong> seconds</div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Back to Homepage</a>
            <a class="btn" href="javascript:history.back()"><i class="fa-solid fa-arrow-left"></i> Go Back</a>
        </div>
    </main>
    <script>
        (function () {
            let seconds = 10;
            const countdown = document.getElementById('redirectCountdown');
            const timer = setInterval(function () {
                seconds -= 1;
                if (countdown) countdown.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.replace(@json(url('/')));
                }
            }, 1000);
        })();
    </script>
</body>
</html>
