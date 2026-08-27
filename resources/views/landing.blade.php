<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agenda Surat Digital - SMK 8</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        
        /* ===== LANDING HERO ===== */
        .landing-hero {
            text-align: center;
            padding: 80px 40px 60px;
            background: linear-gradient(135deg, #0a0e17 0%, #111827 50%, #1a2332 100%);
            border-bottom: 1px solid #1e293b;
        }
        
        .landing-hero .badge {
            display: inline-block;
            background: #1e293b;
            color: #60a5fa;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid #1e3a5f;
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
            line-height: 1.7;
        }
        
        .landing-hero .btn-group {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        
        .landing-hero .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .landing-hero .btn-hero.primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        .landing-hero .btn-hero.primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .landing-hero .btn-hero.secondary {
            background: #1e293b;
            color: #94a3b8;
            border: 1px solid #334155;
        }
        
        .landing-hero .btn-hero.secondary:hover {
            background: #334155;
            color: white;
            transform: translateY(-3px);
        }
        
        /* ===== STATS ===== */
        .landing-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: -30px auto 0;
            padding: 0 40px;
            position: relative;
            z-index: 10;
        }
        
        .landing-stats .stat-item {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
        }
        
        .landing-stats .stat-item .number {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
        }
        
        .landing-stats .stat-item .label {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 4px;
        }
        
        /* ===== FEATURES ===== */
        .landing-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 0 40px 60px;
        }
        
        .landing-feature {
            background: #111827;
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 32px 28px;
            text-align: center;
            transition: 0.3s;
        }
        
        .landing-feature:hover {
            border-color: #3b82f6;
            transform: translateY(-4px);
        }
        
        .landing-feature .icon {
            font-size: 44px;
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
            line-height: 1.7;
        }
        
        /* ===== FOOTER ===== */
        .landing-footer {
            text-align: center;
            padding: 30px 40px;
            color: #475569;
            font-size: 14px;
            border-top: 1px solid #1e293b;
            margin-left: 250px;
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
            }
            .landing-footer {
                margin-left: 70px;
            }
            .landing-hero h1 {
                font-size: 32px;
            }
            .landing-hero {
                padding: 60px 20px 40px;
            }
            .landing-stats {
                padding: 0 20px;
                grid-template-columns: 1fr 1fr;
            }
            .landing-features {
                padding: 0 20px 40px;
            }
        }
        
        @media (max-width: 480px) {
            .sidebar {
                width: 60px;
                padding: 10px 6px;
            }
            .main-content {
                margin-left: 60px;
            }
            .landing-footer {
                margin-left: 60px;
            }
            .landing-stats {
                grid-template-columns: 1fr;
            }
            .landing-hero h1 {
                font-size: 24px;
            }
            .landing-hero .btn-hero {
                padding: 12px 24px;
                font-size: 14px;
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
                    <a href="{{ route('surat.index') }}">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('surat.masuk') }}">
                        <i class="fas fa-inbox"></i> <span>Surat Masuk</span>
                    </a>
                    <a href="{{ route('surat.keluar') }}">
                        <i class="fas fa-paper-plane"></i> <span>Surat Keluar</span>
                    </a>
                    <a href="{{ route('surat.log') }}">
                        <i class="fas fa-history"></i> <span>Log Aktivitas</span>
                    </a>
                @else
                    <a href="{{ route('surat.masuk') }}">
                        <i class="fas fa-inbox"></i> <span>Surat Masuk</span>
                    </a>
                    <a href="{{ route('surat.keluar') }}">
                        <i class="fas fa-paper-plane"></i> <span>Surat Keluar</span>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> <span>Login</span>
                </a>
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i> <span>Register</span>
                </a>
            @endauth
        </nav>
        
        @auth
        <div class="user-info-sidebar">
            <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div class="user-detail">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ Auth::user()->role }}</div>
            </div>
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
        
        <!-- ===== LANDING HERO ===== -->
        <div class="landing-hero">
            <div class="badge">
                <i class="fas fa-rocket"></i> Sistem Manajemen Surat Digital
            </div>
            <h1>📋 Buku <span>Agenda Surat</span> Digital</h1>
            <p>
                Kelola surat masuk dan keluar dengan mudah, aman, dan terorganisir.
                Sistem pencatatan surat untuk SMK 8.
            </p>
            <div class="btn-group">
                @guest
                    <a href="{{ route('login') }}" class="btn-hero primary">
                        <i class="fas fa-sign-in-alt"></i> Masuk ke Sistem
                    </a>
                    <a href="{{ route('register') }}" class="btn-hero secondary">
                        <i class="fas fa-user-plus"></i> Daftar Akun
                    </a>
                @else
                    <a href="{{ route('surat.index') }}" class="btn-hero primary">
                        <i class="fas fa-home"></i> Buka Dashboard
                    </a>
                @endguest
            </div>
        </div>
        
        <!-- ===== STATS ===== -->
        <div class="landing-stats">
            <div class="stat-item">
                <div class="number">📥 50+</div>
                <div class="label">Surat Masuk</div>
            </div>
            <div class="stat-item">
                <div class="number">📤 30+</div>
                <div class="label">Surat Keluar</div>
            </div>
            <div class="stat-item">
                <div class="number">👨‍💼 2</div>
                <div class="label">Role Pengguna</div>
            </div>
            <div class="stat-item">
                <div class="number">📜 100+</div>
                <div class="label">Log Aktivitas</div>
            </div>
        </div>
        
        <!-- ===== FEATURES ===== -->
        <div class="landing-features">
            <div class="landing-feature">
                <div class="icon">📥</div>
                <h3>Surat Masuk</h3>
                <p>Kelola dan pantau semua surat yang masuk dengan sistem yang terorganisir dan mudah digunakan.</p>
            </div>
            <div class="landing-feature">
                <div class="icon">📤</div>
                <h3>Surat Keluar</h3>
                <p>Catat dan arsipkan semua surat yang keluar dengan format yang rapi dan profesional.</p>
            </div>
            <div class="landing-feature">
                <div class="icon">📜</div>
                <h3>Log Aktivitas</h3>
                <p>Pantau setiap perubahan yang dilakukan oleh admin untuk keamanan dan transparansi data.</p>
            </div>
        </div>
    </div>
    
    <!-- ===== FOOTER ===== -->
    <div class="landing-footer">
        &copy; {{ date('Y') }} Buku Agenda Surat Digital - SMK 8 | Dibangun dengan Laravel
    </div>
</body>
</html>