<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SSF Tech</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --red: #e40914;
            --red-glow: rgba(228, 9, 20, 0.4);
            --red-dark: #ba0610;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 50% 50%, #151928 0%, #06080d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Decorative ambient glow blobs */
        body::before {
            content: '';
            position: absolute;
            top: 20%;
            left: 25%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(228, 9, 20, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(20px);
            animation: floatGlow 8s ease-in-out infinite alternate;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: 20%;
            right: 25%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            filter: blur(20px);
            animation: floatGlow 10s ease-in-out infinite alternate-reverse;
        }

        @keyframes floatGlow {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-30px) scale(1.1);
            }
        }

        .login-card {
            background: rgba(18, 22, 33, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 45px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            animation: cardEntrance 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
            z-index: 10;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-logo img {
            width: 160px;
            filter: drop-shadow(0 0 10px rgba(228, 9, 20, 0.3));
        }

        .form-title {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        .form-title span {
            color: var(--red);
        }

        .form-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .form-control-custom {
            background: rgba(0, 0, 0, 0.4) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 12px 16px 12px 46px !important;
            font-size: 14px !important;
            width: 100%;
            transition: all 0.3s ease !important;
        }

        .form-control-custom:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(228, 9, 20, 0.25) !important;
            outline: none;
        }

        .form-control-custom:focus+i {
            color: var(--red);
        }

        .btn-red {
            background: var(--red);
            color: white;
            border: none;
            font-weight: 700;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            box-shadow: 0 4px 15px var(--red-glow);
            transition: all 0.25s ease;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .btn-red:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(228, 9, 20, 0.55);
        }

        .btn-red:active {
            transform: translateY(0);
        }

        .form-check-label {
            color: #a0aec0;
            font-size: 13px;
        }

        .form-check-input {
            background-color: rgba(0, 0, 0, 0.5) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }

        .form-check-input:checked {
            background-color: var(--red) !important;
            border-color: var(--red) !important;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-logo">
            <img src="{{ url('frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech Logo">
        </div>

        <h2 class="form-title">Admin <span>Access</span></h2>

        @if ($errors->any())
            <div class="error-message">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ url('/admin/login') }}" method="POST">
            @csrf

            <div class="form-group-custom">
                <input type="email" name="email" class="form-control-custom" placeholder="Email Address" required
                    value="{{ old('email') }}">
                <i class="fa-regular fa-envelope"></i>
            </div>

            <div class="form-group-custom">
                <input type="password" name="password" class="form-control-custom" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-red">Login</button>
        </form>
    </div>

</body>

</html>
