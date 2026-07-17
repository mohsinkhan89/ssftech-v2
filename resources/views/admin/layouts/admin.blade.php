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
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <!-- Custom Style -->
    <style>
        :root {
            --red: #e40914;
            --red-glow: rgba(228, 9, 20, 0.2);
            --red-dark: #ba0610;
            --bg-light: #f1f5f9;
            --panel-dark: #0f172a;
            --border-light: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --sidebar-width: 270px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Scrollbar customization */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--red);
        }

        /* Sidebar Styling (Dark Mode) */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0f172a;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14.5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid transparent;
        }

        .nav-link-custom:hover {
            color: #ffffff;
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
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 20px;
        }

        /* Main Content Wrapper (Light Mode friendly) */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 40px;
            transition: margin-left 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 1;
        }

        /* Header Panel (Dark Mode) */
        .header-panel {
            background: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            animation: fadeInDown 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.03);
            padding: 8px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .admin-profile:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.08);
        }

        .admin-profile {
            cursor: pointer;
        }

        .profile-dropdown-menu {
            width: 270px;
            margin-top: 12px !important;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .18);
        }

        .profile-dropdown-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 9px;
            color: #334155;
            font-size: 13px;
            font-weight: 500;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background: #f8fafc;
            color: var(--red);
        }

        .notification-dropdown-menu {
            width: min(390px, calc(100vw - 24px));
            max-height: 520px;
            margin-top: 12px !important;
            padding: 0;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .2);
        }

        .notification-list {
            max-height: 390px;
            overflow-y: auto;
        }

        .notification-item {
            display: flex;
            gap: 12px;
            padding: 13px 16px;
            color: #334155;
            text-decoration: none;
            border-bottom: 1px solid #f1f5f9;
            transition: background .2s ease;
        }

        .notification-item:hover,
        .notification-item.is-unread {
            background: #fff7f7;
            color: #0f172a;
        }

        .notification-item-icon {
            flex: 0 0 38px;
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: rgba(228, 9, 20, .1);
            color: var(--red);
        }

        .notification-count {
            position: absolute;
            top: -7px;
            right: -7px;
            min-width: 19px;
            height: 19px;
            padding: 0 5px;
            display: grid;
            place-items: center;
            border: 2px solid #0f172a;
            border-radius: 999px;
            background: var(--red);
            color: #fff;
            font-size: 9px;
            font-weight: 700;
        }

        .sidebar-status-card {
            padding: 13px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 12px;
            background: rgba(255,255,255,.035);
            color: #cbd5e1;
            font-size: 12px;
        }

        .admin-toast-stack {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
            width: min(380px, calc(100vw - 40px));
        }

        .admin-sweet-toast {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 16px 44px 16px 16px;
            border: 1px solid #e2e8f0;
            border-left: 4px solid var(--toast-color);
            border-radius: 12px;
            background: #fff;
            color: #334155;
            box-shadow: 0 16px 42px rgba(15, 23, 42, .2);
            animation: toastSlideIn .4s cubic-bezier(.16, 1, .3, 1);
        }

        .admin-sweet-toast .toast-symbol {
            flex: 0 0 36px;
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: color-mix(in srgb, var(--toast-color) 12%, white);
            color: var(--toast-color);
            font-size: 18px;
        }

        .admin-sweet-toast .toast-close {
            position: absolute;
            top: 10px;
            right: 11px;
            border: 0;
            background: transparent;
            color: #94a3b8;
        }

        .admin-sweet-toast .toast-progress {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background: var(--toast-color);
            transform-origin: left;
            animation: toastProgress 4.5s linear forwards;
        }

        .admin-sweet-toast.toast-success { --toast-color: #10b981; }
        .admin-sweet-toast.toast-warning { --toast-color: #f59e0b; }
        .admin-sweet-toast.toast-error { --toast-color: #ef4444; }

        .fade-in .alert-custom {
            display: none !important;
        }

        @keyframes toastSlideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes toastProgress {
            to { transform: scaleX(0); }
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
            color: #94a3b8;
        }

        /* Dashboard Cards & Layout (Light Mode) */
        .dashboard-card {
            background: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 18px;
            padding: 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            color: var(--text-dark);
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.005) 0%, transparent 100%);
            pointer-events: none;
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
            border-color: rgba(228, 9, 20, 0.25);
        }

        .dashboard-cards-slider {
            width: 100%;
            overflow: hidden;
            padding: 4px 4px 34px;
        }

        .dashboard-cards-slider .swiper-wrapper {
            align-items: stretch;
        }

        .dashboard-cards-slider .swiper-slide {
            height: auto;
        }

        .dashboard-cards-slider .dashboard-card {
            min-height: 210px;
        }

        .dashboard-cards-arrows {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 18px;
        }

        .dashboard-cards-arrows button {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #fff;
            color: #0f172a;
            transition: all 0.25s ease;
        }

        .dashboard-cards-arrows button:hover {
            border-color: var(--red);
            background: var(--red);
            color: #fff;
            box-shadow: 0 8px 20px var(--red-glow);
            transform: translateY(-2px);
        }

        .dashboard-cards-arrows button.swiper-button-disabled,
        .dashboard-cards-arrows button.swiper-button-disabled:hover {
            cursor: not-allowed;
            opacity: 0.38;
            border-color: #cbd5e1;
            background: #fff;
            color: #94a3b8;
            box-shadow: none;
            transform: none;
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
            background: rgba(228, 9, 20, 0.06);
            color: var(--red);
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(228, 9, 20, 0.12);
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
            background: rgba(16, 185, 129, 0.08);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.12);
        }

        .card-value {
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -1px;
            color: #0f172a;
        }

        .card-label {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
        }

        /* Modern Progress Bar in Cards */
        .card-progress {
            height: 5px;
            background: #f1f5f9;
            border-radius: 3px;
            margin-top: 15px;
            overflow: hidden;
        }

        .card-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--red) 0%, #ff4b55 100%);
            border-radius: 3px;
        }

        /* Quick Action Grid Card (Light Mode) */
        .action-card {
            background: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.015);
        }

        .action-card:hover {
            background: #f8fafc;
            border-color: rgba(228, 9, 20, 0.25);
            transform: translateX(4px);
            color: var(--text-dark);
        }

        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .action-card:hover .action-icon {
            background: var(--red);
            color: white;
            box-shadow: 0 4px 15px var(--red-glow);
            border-color: var(--red);
        }

        .action-info h6 {
            margin: 0;
            font-weight: 600;
            font-size: 14px;
            color: #0f172a;
        }

        .action-info p {
            margin: 0;
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Tables styling (Light Mode) */
        .custom-table-container {
            background: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            color: var(--text-dark);
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
            color: #0f172a;
        }

        .custom-table {
            color: var(--text-dark) !important;
            margin-bottom: 0;
        }

        .custom-table th {
            color: var(--text-muted);
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 16px;
            font-size: 12.5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-table td {
            padding: 18px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
        }

        .custom-table tbody tr {
            transition: all 0.25s ease;
            position: relative;
        }

        .custom-table tbody tr:hover {
            background: #f8fafc;
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
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #0f172a;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-size: 13.5px;
        }

        .btn-dark-custom:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: #0f172a;
        }

        .form-control-custom {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
            border-radius: 10px !important;
            padding: 12px 18px !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }

        .form-control-custom:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(228, 9, 20, 0.15) !important;
            outline: none;
        }

        .form-select-custom {
            background: #ffffff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%230f172a' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 18px center/12px 10px !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
            border-radius: 10px !important;
            padding: 12px 18px !important;
            font-size: 14px !important;
        }

        .form-select-custom:focus {
            border-color: var(--red) !important;
            box-shadow: 0 0 0 3px rgba(228, 9, 20, 0.15) !important;
        }

        label {
            color: #475569;
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
            background: rgba(56, 189, 248, 0.1);
            color: #0284c7;
            border: 1px solid rgba(56, 189, 248, 0.2);
        }

        .badge-ecommerce {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge-webapp {
            background: rgba(168, 85, 247, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(168, 85, 247, 0.2);
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
            color: #2563eb;
            border: 1px solid rgba(59, 130, 246, 0.12);
        }

        .btn-edit:hover {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
            transform: scale(1.08);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.08);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.12);
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
            transform: scale(1.08);
        }

        .btn-view {
            background: rgba(16, 185, 129, 0.08);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.12);
        }

        .btn-view:hover {
            background: #059669;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transform: scale(1.08);
        }

        .status-toggle-form {
            display: inline-flex;
            align-items: center;
            margin: 0;
        }

        .status-toggle-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 0;
            padding: 0;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            transition: all 0.25s ease;
        }

        .status-toggle-btn::before {
            content: "";
            width: 46px;
            height: 24px;
            border-radius: 999px;
            background: #cbd5e1;
            box-shadow: inset 0 0 0 1px rgba(15, 23, 42, 0.08);
            transition: all 0.25s ease;
        }

        .status-toggle-btn::after {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            margin-left: 3px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 7px rgba(15, 23, 42, 0.25);
            transition: transform 0.25s ease;
        }

        .status-toggle-btn.is-active {
            color: #059669;
        }

        .status-toggle-btn.is-active::before {
            background: #10b981;
            box-shadow: inset 0 0 0 1px rgba(5, 150, 105, 0.12), 0 4px 12px rgba(16, 185, 129, 0.22);
        }

        .status-toggle-btn.is-active::after {
            transform: translateX(22px);
        }

        .status-toggle-btn.is-inactive {
            color: #64748b;
        }

        .status-toggle-btn:hover {
            transform: translateY(-1px);
        }

        .status-toggle-btn:hover::before {
            box-shadow: inset 0 0 0 1px rgba(239, 22, 31, 0.18), 0 4px 12px rgba(239, 22, 31, 0.16);
        }

        /* Alert overrides */
        .alert-custom {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 12px;
            padding: 16px 22px;
            margin-bottom: 30px;
        }

        .alert.auto-dismiss-alert {
            transition: opacity 0.35s ease, transform 0.35s ease;
        }

        .alert.auto-dismiss-alert.is-hiding {
            opacity: 0;
            transform: translateY(-8px);
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

    @php
        $toastType = session('success') ? 'success' : (session('warning') ? 'warning' : ((session('error') || $errors->any()) ? 'error' : null));
        $toastMessage = session('success') ?? session('warning') ?? session('error') ?? ($errors->any() ? $errors->first() : null);
    @endphp
    @if($toastMessage)
        <div class="admin-toast-stack" aria-live="polite" aria-atomic="true">
            <div class="admin-sweet-toast toast-{{ $toastType }}" role="alert" data-admin-toast>
                <span class="toast-symbol"><i class="fa-solid {{ $toastType === 'success' ? 'fa-check' : ($toastType === 'warning' ? 'fa-triangle-exclamation' : 'fa-xmark') }}"></i></span>
                <div><strong class="d-block text-dark mb-1">{{ ucfirst($toastType) }}</strong><span style="font-size:13px;">{{ $toastMessage }}</span></div>
                <button type="button" class="toast-close" aria-label="Close notification"><i class="fa-solid fa-xmark"></i></button>
                <span class="toast-progress"></span>
            </div>
        </div>
    @endif

    <!-- Sidebar -->
    <div class="sidebar" id="adminSidebar">
        <div>
            <div class="sidebar-brand">
                <a href="{{ url('/') }}" target="_blank">
                    <img src="{{ url(optional(\App\Models\SiteSetting::first())->logo ?: 'frontend/assets/images/logo/ssf-tech-logo-new.png') }}" alt="SSF Tech Logo">
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
                    <a href="{{ route('admin.clients.index') }}"
                        class="nav-link-custom {{ Request::is('admin/clients*') ? 'active' : '' }}">
                        <i class="fa-solid fa-handshake"></i>
                        <span>Partners</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}"
                        class="nav-link-custom {{ Request::is('admin/services*') ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.blogs.index') }}" class="nav-link-custom {{ Request::is('admin/blogs*') ? 'active' : '' }}"><i class="fa-solid fa-newspaper"></i><span>Blogs</span></a></li>
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="nav-link-custom {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                        <i class="fa-solid fa-comments"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.faqs.index') }}"
                        class="nav-link-custom {{ Request::is('admin/faqs*') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>FAQs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}"
                        class="nav-link-custom {{ Request::is('admin/messages*') ? 'active' : '' }}">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
                @if (Auth::user()->role === 'administrator')
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}"
                        class="nav-link-custom {{ Request::is('admin/settings*') || Request::is('admin/social-links*') ? 'active' : '' }}">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-status-card">
                <div class="d-flex align-items-center gap-2 mb-2"><span class="bg-success rounded-circle" style="width:8px;height:8px;"></span><strong class="text-white">Website Online</strong></div>
                <div class="text-secondary mb-3">Admin panel connected</div>
                <a href="{{ url('/') }}" target="_blank" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                    <span><i class="fa-solid fa-arrow-up-right-from-square me-2 text-danger"></i>View Website</span><i class="fa-solid fa-chevron-right small"></i>
                </a>
            </div>
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
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}"
                                    class="text-secondary text-decoration-none" style="font-size: 13px;">Admin</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page" style="font-size: 13px;">
                                @yield('page_title', 'Dashboard')</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Notifications Bell -->
                <div class="dropdown">
                    <button class="btn btn-dark-custom p-0 rounded-circle d-flex align-items-center justify-content-center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open notifications"
                        style="width:38px;height:38px;position:relative;">
                        <i class="fa-regular fa-bell"></i>
                        @if($unreadNotificationsCount > 0)
                            <span class="notification-count">{{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu">
                        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                            <div><strong class="text-dark">Notifications</strong><small class="d-block text-muted">Latest 10 customer requests</small></div>
                            @if($unreadNotificationsCount > 0)<span class="badge bg-danger-subtle text-danger">{{ $unreadNotificationsCount }} unread</span>@endif
                        </div>
                        <div class="notification-list">
                            @forelse($headerNotifications as $notification)
                                <a href="{{ route('admin.messages.show', $notification) }}" class="notification-item {{ $notification->read_at ? '' : 'is-unread' }}">
                                    <span class="notification-item-icon"><i class="fa-regular fa-envelope"></i></span>
                                    <span class="flex-grow-1 overflow-hidden">
                                        <strong class="d-block text-truncate" style="font-size:13px;">{{ $notification->name }}</strong>
                                        <span class="d-block text-muted text-truncate" style="font-size:11px;">{{ $notification->service ?: 'General Inquiry' }} — {{ $notification->message }}</span>
                                        <small class="text-secondary" style="font-size:10px;">{{ $notification->created_at->diffForHumans() }}</small>
                                    </span>
                                    @if(!$notification->read_at)<span class="bg-danger rounded-circle mt-2" style="width:7px;height:7px;"></span>@endif
                                </a>
                            @empty
                                <div class="text-center text-muted py-5"><i class="fa-regular fa-bell-slash fa-2x mb-2"></i><p class="mb-0 small">No notifications yet.</p></div>
                            @endforelse
                        </div>
                        <a href="{{ route('admin.messages.index') }}" class="d-block text-center text-danger fw-semibold text-decoration-none px-3 py-3 border-top" style="font-size:12px;">View All Requests <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <div class="dropdown">
                    <div class="admin-profile" data-bs-toggle="dropdown" aria-expanded="false" role="button" tabindex="0">
                        <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                        <div class="admin-info d-none d-sm-block">
                            <span class="admin-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                            <span class="admin-role">{{ Auth::user()->role === 'administrator' ? 'Super Admin' : (Auth::user()->role === 'admin' ? 'Admin' : 'Author') }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-secondary small"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown-menu">
                        <div class="px-2 py-2 mb-1"><strong class="d-block text-dark">{{ Auth::user()->name }}</strong><small class="text-muted">{{ Auth::user()->email }}</small></div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i class="fa-regular fa-user"></i> View & Edit Profile</a>
                        {{-- <a class="dropdown-item" href="{{ route('admin.profile.show') }}#password"><i class="fa-solid fa-key"></i> Change Password</a> --}}
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fa-solid fa-gear"></i> Site Settings</a>
                        <a class="dropdown-item" href="{{ url('/') }}" target="_blank"><i class="fa-solid fa-globe"></i> View Website</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('admin.logout') }}" method="POST">@csrf
                            <button type="submit" class="dropdown-item text-danger w-100"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.querySelectorAll('[data-admin-toast]').forEach(function(toast) {
            const closeToast = function() {
                toast.style.transition = 'opacity .25s ease, transform .25s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(24px)';
                setTimeout(function() { toast.remove(); }, 250);
            };

            toast.querySelector('.toast-close')?.addEventListener('click', closeToast);
            setTimeout(closeToast, 4500);
        });

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

        document.querySelectorAll('.alert').forEach(function(alertEl) {
            alertEl.classList.add('auto-dismiss-alert');

            setTimeout(function() {
                alertEl.classList.add('is-hiding');

                setTimeout(function() {
                    if (window.bootstrap && bootstrap.Alert) {
                        bootstrap.Alert.getOrCreateInstance(alertEl).close();
                        return;
                    }

                    alertEl.remove();
                }, 350);
            }, 3500);
        });
    </script>
    @yield('js')
</body>

</html>
