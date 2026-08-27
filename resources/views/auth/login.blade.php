<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Agenda Surat Digital</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: #111827;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #1e293b;
            margin: 20px;
        }
        
        .login-left {
            flex: 1;
            padding: 50px 40px;
            background: #111827;
        }
        
        .login-left .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .login-left .logo span {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .login-left h2 {
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 8px;
        }
        
        .login-left .subtitle {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 30px;
        }
        
        .login-left .form-group {
            margin-bottom: 20px;
        }
        
        .login-left .form-group label {
            display: block;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .login-left .form-group .input-wrapper {
            display: flex;
            align-items: center;
            background: #0a0e17;
            border: 1px solid #1e293b;
            border-radius: 10px;
            padding: 0 14px;
            transition: 0.3s;
        }
        
        .login-left .form-group .input-wrapper:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .login-left .form-group .input-wrapper i {
            color: #475569;
            font-size: 16px;
        }
        
        .login-left .form-group .input-wrapper input {
            width: 100%;
            padding: 14px 12px;
            background: transparent;
            border: none;
            color: #e0e6ed;
            font-size: 14px;
            outline: none;
        }
        
        .login-left .form-group .input-wrapper input::placeholder {
            color: #475569;
        }
        
        .login-left .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .login-left .form-options label {
            color: #94a3b8;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .login-left .form-options label input[type="checkbox"] {
            accent-color: #3b82f6;
            width: 16px;
            height: 16px;
        }
        
        .login-left .form-options a {
            color: #60a5fa;
            text-decoration: none;
            font-size: 13px;
        }
        
        .login-left .form-options a:hover {
            text-decoration: underline;
        }
        
        .login-left .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .login-left .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }
        
        .login-left .register-link {
            text-align: center;
            margin-top: 20px;
            color: #94a3b8;
            font-size: 14px;
        }
        
        .login-left .register-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-left .register-link a:hover {
            text-decoration: underline;
        }
        
        .login-right {
            flex: 1;
            background: linear-gradient(135deg, #1a2332, #111827);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-left: 1px solid #1e293b;
        }
        
        .login-right .icon-big {
            font-size: 80px;
            margin-bottom: 20px;
        }
        
        .login-right h3 {
            color: #ffffff;
            font-size: 22px;
            margin-bottom: 10px;
        }
        
        .login-right p {
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.7;
            max-width: 280px;
        }
        
        .login-right .feature-list {
            margin-top: 25px;
            text-align: left;
            width: 100%;
            max-width: 280px;
        }
        
        .login-right .feature-list .item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px solid #1e293b;
        }
        
        .login-right .feature-list .item:last-child {
            border-bottom: none;
        }
        
        .login-right .feature-list .item i {
            color: #34d399;
            font-size: 14px;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        
        .alert-danger {
            background: #4c1d1d;
            color: #f87171;
            border: 1px solid #7f1d1d;
        }
        
        .alert-success {
            background: #064e3b;
            color: #34d399;
            border: 1px solid #065f46;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 100%;
                margin: 10px;
                border-radius: 12px;
            }
            .login-right {
                border-left: none;
                border-top: 1px solid #1e293b;
                padding: 30px 20px;
            }
            .login-left {
                padding: 30px 20px;
            }
            .login-right .icon-big {
                font-size: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- LEFT SIDE - FORM -->
        <div class="login-left">
            <div class="logo">
                📋 <span>Agenda Surat</span>
            </div>
            
            <h2>Selamat Datang Kembali 👋</h2>
            <p class="subtitle">Masukkan kredensial Anda untuk melanjutkan</p>
            
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="admin@gmail.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> Ingat Saya
                    </label>
                    <a href="{{ route('password.request') }}">Lupa Password?</a>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> MASUK
                </button>
            </form>
            
            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
            </div>
        </div>
        
        <!-- RIGHT SIDE - INFO -->
        <div class="login-right">
            <div class="icon-big">📋</div>
            <h3>Buku Agenda Surat Digital</h3>
            <p>Sistem manajemen surat masuk dan keluar untuk SMK 8</p>
            
            <div class="feature-list">
                <div class="item">
                    <i class="fas fa-check-circle"></i>
                    <span>Kelola Surat Masuk & Keluar</span>
                </div>
                <div class="item">
                    <i class="fas fa-check-circle"></i>
                    <span>Role Admin & Guest</span>
                </div>
                <div class="item">
                    <i class="fas fa-check-circle"></i>
                    <span>Log Aktivitas Lengkap</span>
                </div>
                <div class="item">
                    <i class="fas fa-check-circle"></i>
                    <span>Antarmuka Modern & Responsif</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>