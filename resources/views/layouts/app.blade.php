<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Buku Agenda Surat Digital')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0e17;
            color: #e0e6ed;
            min-height: 100vh;
        }
        
        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #111827;
            padding: 25px 20px;
            border-right: 1px solid #1e293b;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar .logo {
            font-size: 22px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar .logo span {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 14px;
        }
        
        .sidebar .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .sidebar .nav-menu a {
            color: #94a3b8;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }
        
        .sidebar .nav-menu a:hover {
            background: #1e293b;
            color: #ffffff;
        }
        
        .sidebar .nav-menu a.active {
            background: #1e293b;
            color: #60a5fa;
        }
        
        .sidebar .nav-menu a i {
            width: 20px;
            font-size: 16px;
        }
        
        .sidebar .user-info-sidebar {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 15px;
            background: #1e293b;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .sidebar .user-info-sidebar .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 16px;
        }
        
        .sidebar .user-info-sidebar .user-detail {
            flex: 1;
        }
        
        .sidebar .user-info-sidebar .user-detail .name {
            font-weight: 600;
            color: #ffffff;
            font-size: 14px;
        }
        
        .sidebar .user-info-sidebar .user-detail .role {
            font-size: 12px;
            color: #94a3b8;
        }
        
        .sidebar .user-info-sidebar .logout-btn {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
        }
        
        .sidebar .user-info-sidebar .logout-btn:hover {
            color: #ef4444;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 250px;
            padding: 30px 40px;
            min-height: 100vh;
        }
        
        /* ===== TOP BAR ===== */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .topbar .greeting h1 {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
        }
        
        .topbar .greeting p {
            color: #94a3b8;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .topbar .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .topbar .topbar-actions .search-box {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .topbar .topbar-actions .search-box input {
            background: none;
            border: none;
            color: #e0e6ed;
            outline: none;
            font-size: 14px;
            width: 200px;
        }
        
        .topbar .topbar-actions .search-box input::placeholder {
            color: #475569;
        }
        
        .topbar .topbar-actions .search-box i {
            color: #475569;
        }
        
        /* ===== STATS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 20px 24px;
            transition: 0.3s;
        }
        
        .stat-card:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
        }
        
        .stat-card .stat-label {
            color: #94a3b8;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-top: 8px;
        }
        
        .stat-card .stat-change {
            font-size: 13px;
            margin-top: 5px;
        }
        
        .stat-card .stat-change.positive {
            color: #34d399;
        }
        
        .stat-card .stat-change.negative {
            color: #f87171;
        }
        
        /* ===== CARDS ===== */
        .card {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 25px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .card-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
        }
        
        .card-header .card-actions {
            display: flex;
            gap: 10px;
        }
        
        .card-header .card-actions a {
            color: #60a5fa;
            text-decoration: none;
            font-size: 14px;
        }
        
        /* ===== TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .table th {
            text-align: left;
            padding: 12px 16px;
            color: #94a3b8;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #1e293b;
        }
        
        .table td {
            padding: 12px 16px;
            border-bottom: 1px solid #1a2332;
            color: #e0e6ed;
        }
        
        .table tr:hover td {
            background: #1a2332;
        }
        
        .table .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .table .badge.masuk {
            background: #1e3a5f;
            color: #60a5fa;
        }
        
        .table .badge.keluar {
            background: #3b2a1e;
            color: #fbbf24;
        }
        
        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-success:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        
        .btn-warning {
            background: #f59e0b;
            color: #0a0e17;
        }
        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-1px);
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: #1e293b;
            color: #94a3b8;
        }
        .btn-secondary:hover {
            background: #334155;
            color: white;
        }
        
        .btn-sm {
            padding: 5px 12px;
            font-size: 12px;
        }
        
        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #e0e6ed;
            font-size: 14px;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            background: #0a0e17;
            border: 1px solid #1e293b;
            border-radius: 10px;
            color: #e0e6ed;
            font-size: 14px;
            transition: 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-group .error-text {
            color: #f87171;
            font-size: 12px;
            margin-top: 4px;
        }
        
        /* ===== ALERT ===== */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-success {
            background: #064e3b;
            color: #34d399;
            border: 1px solid #065f46;
        }
        
        .alert-danger {
            background: #4c1d1d;
            color: #f87171;
            border: 1px solid #7f1d1d;
        }
        
        /* ===== LANDING PAGE ===== */
        .landing-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            background: #0a0e17;
        }
        
        .landing-hero {
            text-align: center;
            padding: 80px 40px;
            background: linear-gradient(135deg, #0a0e17 0%, #111827 50%, #1a2332 100%);
            border-bottom: 1px solid #1e293b;
        }
        
        .landing-hero h1 {
            font-size: 52px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
        }
        
        .landing-hero h1 span {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .landing-hero p {
            font-size: 18px;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        .landing-hero .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .landing-hero .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .landing-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            padding: 60px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .landing-feature {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            transition: 0.3s;
        }
        
        .landing-feature:hover {
            border-color: #3b82f6;
            transform: translateY(-4px);
        }
        
        .landing-feature .icon {
            font-size: 40px;
            margin-bottom: 16px;
        }
        
        .landing-feature h3 {
            color: #ffffff;
            font-size: 18px;
            margin-bottom: 8px;
        }
        
        .landing-feature p {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .landing-footer {
            text-align: center;
            padding: 30px;
            color: #475569;
            font-size: 14px;
            border-top: 1px solid #1e293b;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 15px 10px;
            }
            .sidebar .logo span {
                display: none;
            }
            .sidebar .logo {
                font-size: 18px;
                justify-content: center;
            }
            .sidebar .nav-menu a span {
                display: none;
            }
            .sidebar .nav-menu a {
                justify-content: center;
                padding: 12px;
            }
            .sidebar .user-info-sidebar .user-detail {
                display: none;
            }
            .main-content {
                margin-left: 70px;
                padding: 20px;
            }
            .landing-wrapper {
                margin-left: 70px;
            }
            .topbar .greeting h1 {
                font-size: 22px;
            }
            .topbar .topbar-actions .search-box input {
                width: 120px;
            }
            .landing-hero h1 {
                font-size: 32px;
            }
        }
        
        @media (max-width: 480px) {
            .sidebar {
                width: 60px;
                padding: 10px 6px;
            }
            .main-content {
                margin-left: 60px;
                padding: 15px;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            .stat-card .stat-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar">
        <div class="logo">
            📋 <span>Agenda Surat</span>
        </div>
        
        <nav class="nav-menu">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('surat.index') }}" class="{{ request()->routeIs('surat.index') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('surat.masuk') }}" class="{{ request()->routeIs('surat.masuk') ? 'active' : '' }}">
                        <i class="fas fa-inbox"></i> <span>Surat Masuk</span>
                    </a>
                    <a href="{{ route('surat.keluar') }}" class="{{ request()->routeIs('surat.keluar') ? 'active' : '' }}">
                        <i class="fas fa-paper-plane"></i> <span>Surat Keluar</span>
                    </a>
                    <a href="{{ route('surat.log') }}" class="{{ request()->routeIs('surat.log') ? 'active' : '' }}">
                        <i class="fas fa-history"></i> <span>Log Aktivitas</span>
                    </a>
                @else
                    <a href="{{ route('surat.masuk') }}" class="{{ request()->routeIs('surat.masuk') ? 'active' : '' }}">
                        <i class="fas fa-inbox"></i> <span>Surat Masuk</span>
                    </a>
                    <a href="{{ route('surat.keluar') }}" class="{{ request()->routeIs('surat.keluar') ? 'active' : '' }}">
                        <i class="fas fa-paper-plane"></i> <span>Surat Keluar</span>
                    </a>
                @endif
            @endauth
        </nav>
        
        @auth
        <div class="user-info-sidebar">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="user-detail">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ Auth::user()->role }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
        @endauth
    </aside>
    
    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>