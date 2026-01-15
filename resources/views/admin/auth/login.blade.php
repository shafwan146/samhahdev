<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#2E7D32">
    <title>Login Admin - Samhah Farm</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <style>
        :root {
            --primary-green: #2E7D32;
            --soft-green: #81C784;
            --light-green: #E8F5E9;
            --primary-orange: #E65100;
            --soft-orange: #FFB74D;
            --light-orange: #FFF3E0;
            --white: #FFFFFF;
            --off-white: #FAFAFA;
            --light-gray: #F5F5F5;
            --border-gray: #E5E7EB;
            --gray: #9E9E9E;
            --text-dark: #1F2937;
            --text-muted: #6B7280;
            --danger: #DC2626;
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 18px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #E8F5E9 0%, #FFFFFF 40%, #FFF3E0 100%);
            padding: 1.5rem;
            -webkit-font-smoothing: antialiased;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            border: 1px solid var(--border-gray);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-green), #1B5E20);
            padding: 2.5rem 2rem;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -20%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .login-logo {
            position: relative;
            z-index: 1;
        }

        .login-logo img {
            height: 60px;
            filter: brightness(0) invert(1);
            margin-bottom: 1rem;
        }

        .login-logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .login-logo p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-dark);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-gray);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 1rem;
            color: var(--text-dark);
            transition: all 0.2s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.15);
        }

        .form-control::placeholder {
            color: var(--gray);
        }

        .form-control.error {
            border-color: var(--danger);
        }

        .form-control.error:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
        }

        .form-error {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .remember-group {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 1.5rem;
        }

        .remember-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-green);
            cursor: pointer;
        }

        .remember-group label {
            font-size: 0.875rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-green), #388E3C);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login svg {
            width: 18px;
            height: 18px;
        }

        .login-footer {
            text-align: center;
            padding: 1.25rem 2rem;
            background: var(--off-white);
            border-top: 1px solid var(--border-gray);
        }

        .login-footer a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--primary-orange);
        }

        /* Responsive */
        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }

            .login-header {
                padding: 2rem 1.5rem;
            }

            .login-body {
                padding: 1.5rem;
            }

            .login-footer {
                padding: 1rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('images/logo-transparent.png') }}" alt="Samhah Farm">
                    <h1>Admin Panel</h1>
                    <p>Samhah Farm Management</p>
                </div>
            </div>
            
            <div class="login-body">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control @error('username') error @enderror"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            required 
                            autofocus
                        >
                        @error('username')
                            <p class="form-error">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control @error('password') error @enderror"
                            placeholder="Masukkan password"
                            required
                        >
                        @error('password')
                            <p class="form-error">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="remember-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                        </svg>
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <a href="/">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
