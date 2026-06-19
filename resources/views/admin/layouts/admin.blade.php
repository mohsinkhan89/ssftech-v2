<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - SSF Tech</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Custom Style -->
    <style>
        :root {
            --red: #e40914;
            --red-glow: rgba(228, 9, 20, 0.35);
            --red-dark: #ba0610;
            --bg-dark: #050609;
            --panel-bg: rgba(15, 18, 28, 0.65);
            --border-color: rgba(255, 255, 255, 0.05);
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --sidebar-width: 270px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 10% 10%, #151b2c 0%, #07090f 60%, #020305 100%);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Subtle glowing background blobs */
        body::before {
            content: '';
            position: absolute;
            top: 15%;
            right: 10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(228, 9, 20, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        /* Scrollbar customization */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--red);
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(10, 13, 22, 0.7);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-right: 1px solid var(--border-color);
            padding: 30px 24px;
            z-index: 1000;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 35px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .sidebar-brand img {
            width: 145px;
            filter: drop-shadow(0 0 12px rgba(228, 9, 20, 0.25));
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid transparent;
        }

        .nav-link-custom:hover {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.03);
            border-color: rgba(255, 255, 255, 0.03);
            transform: translateX(4px);
        }

        .nav-link-custom.active {
            color: #fff;
            background: linear-gradient(135deg, var(--red) 0%, rgba(186, 6, 16, 0.6) 100%);
            box-shadow: 0 8px 25px rgba(228, 9, 20, 0.3);
            border-color: rgba(228, 9, 20, 0.2);
        }

        .nav-link-custom i {
            font-size: 18px;
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .nav-link-custom:hover i {
            transform: scale(1.15);
        }

        .sidebar-footer {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 40px;
            transition: margin-left 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 1;
        }

        .header-panel {
            background: var(--panel-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.02);
            padding: 8px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            transition: all 0.3s ease;
        }

        .admin-profile:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.08);
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--red) 0%, #ff4b55 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            box-shadow: 0 4px 12px rgba(228, 9, 20, 0.35);
        }

        .admin-info span {
            display: block;
        }

        .admin-name {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .admin-role {
            font-size: 11px;
            color: var(--text-secondary);
        }

        /* Dashboard Cards & Layout */
        .dashboard-card {
            background: var(--panel-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.02) 0%, transparent 100%);
            pointer-events: none;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            border-color: rgba(228, 9, 20, 0.25);
        }

        .card-icon-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .card-icon {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            background: rgba(228, 9, 20, 0.08);
            color: var(--red);
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 0 12px rgba(228, 9, 20, 0.05);
            border: 1px solid rgba(228, 9, 20, 0.15);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover .card-icon {
            background: var(--red);
            color: #fff;
            box-shadow: 0 6px 20px var(--red-glow);
            transform: scale(1.05);
        }

        .card-trend {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.15);
        }

        .card-value {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -1px;
            background: linear-gradient(180deg, #fff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
        }

        /* Modern Progress Bar in Cards */
        .card-progress {
            height: 4px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2px;
            margin-top: 15px;
            overflow: hidden;
        }

        .card-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--red) 0%, #ff4b55 100%);
            border-radius: 2px;
            box-shadow: 0 0 8px var(--red-glow);
        }

        /* Quick Action Grid Card */
        .action-card {
            background: linear-gradient(135deg, rgba(25, 30, 48, 0.45) 0%, rgba(10, 12, 20, 0.45) 100%);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: #fff;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .action-card:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(228, 9, 20, 0.3);
            transform: translateX(4px);
            color: #fff;
        }

        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .action-card:hover .action-icon {
            background: var(--red);
            color: white;
            box-shadow: 0 4px 15px var(--red-glow);
        }

        .action-info h6 {
            margin: 0;
            font-weight: 600;
            font-size: 14px;
        }

        .action-info p {
            margin: 0;
            font-size: 11px;
            color: var(--text-secondary);
        }

        /* Tables styling */
        .custom-table-container {
            background: var(--panel-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .table-title-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-title {
            font-size: 19px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .custom-table {
            color: var(--text-primary) !important;
            margin-bottom: 0;
        }

        .custom-table th {
            color: var(--text-secondary);
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            padding: 16px;
            font-size: 12.5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-table td {
            padding: 18px 16px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            font-size: 14px;
            color: #cbd5e1;
        }

        .custom-table tbody tr {
            transition: all 0.25s ease;
            position: relative;
        }

        .custom-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.015);
        }

        /* Profile avatar initials generator */
        .avatar-initial {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        /* Buttons and inputs */
        .btn-red {
            background: var(--red);
            color: white;
            border: none;
            font-weight: 600;
            padding: 11px 24px;
            border-radius: 10px;
            box-shadow: 0 6px 20px var(--red-glow);
            transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 14px;
        }

        .btn-red:hover {
            background: var(--red-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(228, 9, 20, 0.55);
        }

        .btn-dark-custom {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-size: 13.5px;
        }

        .btn-dark-custom:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-control-custom {
            background: rgba(0, 0, 0, 0.4) !important;
            border: 1px solid var(--border-color) !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 12px 18px !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }

        .form-control-custom:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(228, 9, 20, 0.25) !important;
            outline: none;
        }

        .form-select-custom {
            background: rgba(0, 0, 0, 0.4) url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 18px center/12px 10px !important;
            border: 1px solid var(--border-color) !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 12px 18px !important;
            font-size: 14px !important;
        }

        .form-select-custom:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(228, 9, 20, 0.25) !important;
        }

        label {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        /* Project badge with glowing effect */
        .badge-cat {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-website {
            background: rgba(56, 189, 248, 0.08);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.15);
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.05);
        }

        .badge-ecommerce {
            background: rgba(245, 158, 11, 0.08);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.15);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.05);
        }

        .badge-webapp {
            background: rgba(168, 85, 247, 0.08);
            color: #a855f7;
            border: 1px solid rgba(168, 85, 247, 0.15);
            box-shadow: 0 0 10px rgba(168, 85, 247, 0.05);
        }

        /* Actions styling */
        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin-right: 5px;
            border: none;
        }

        .btn-edit {
            background: rgba(59, 130, 246, 0.08);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .btn-edit:hover {
            background: #3b82f6;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transform: scale(1.08);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.1);
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transform: scale(1.08);
        }

        .btn-view {
            background: rgba(16, 185, 129, 0.08);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.1);
        }

        .btn-view:hover {
            background: #10b981;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            transform: scale(1.08);
        }

        /* Alert overrides */
        .alert-custom {
            background: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
            border-radius: 12px;
            padding: 16px 22px;
            margin-bottom: 30px;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media(max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
                padding: 24px;
            }

            .sidebar-toggle {
                display: block !important;
            }
        }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="adminSidebar">
        <div>
            <div class="sidebar-brand">
                <a href="{{ url('/') }}" target="_blank">
                    <img src="{{ url('frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech Logo">
                </a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ url('/admin') }}"
                        class="nav-link-custom {{ Request::is('admin') || Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}"
                        class="nav-link-custom {{ Request::is('admin/projects*') ? 'active' : '' }}">
                        <i class="fa-solid fa-folder-open"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}"
                        class="nav-link-custom {{ Request::is('admin/messages*') ? 'active' : '' }}">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" id="logoutForm">
                @csrf
                <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()"
                    class="nav-link-custom text-danger" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.1);">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </form>
        </div>
    </div>

    <!-- Main Content wrapper -->
    <div class="main-wrapper">
        <!-- Header panel -->
        <div class="header-panel">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-dark-custom sidebar-toggle d-none" id="sidebarToggleBtn"
                    aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="d-none d-md-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-secondary text-decoration-none" style="font-size: 13px;">Admin</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-size: 13px;">@yield('page_title', 'Dashboard')</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Notifications Bell -->
                <button class="btn btn-dark-custom p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; position: relative;">
                    <i class="fa-regular fa-bell"></i>
                    <span class="position-absolute translate-middle p-1 bg-danger border border-light rounded-circle" style="top: 10px; right: 2px; box-shadow: 0 0 6px var(--red-glow); background-color: var(--red) !important;"></span>
                </button>
                
                <div class="admin-profile">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="admin-info d-none d-sm-block">
                        <span class="admin-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="admin-role">System Admin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Content -->
        <div class="fade-in">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap & Custom Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar responsive toggle
        const toggleBtn = document.getElementById('sidebarToggleBtn');
        const sidebar = document.getElementById('adminSidebar');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function(e) {
                sidebar.classList.toggle('active');
                e.stopPropagation();
            });

            document.addEventListener('click', function(e) {
                if (!sidebar.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
        }
    </script>
    @yield('js')
</body>

</html>
