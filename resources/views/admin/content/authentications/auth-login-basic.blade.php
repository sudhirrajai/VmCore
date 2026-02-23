@extends('layouts/blankLayout')

@section('title', 'Admin Secure Login')

@section('content')
    <style>
        :root {
            --brand-primary: #6366f1;
            --brand-secondary: #4f46e5;
            --brand-accent: #8b5cf6;
            --surface-color: rgba(255, 255, 255, 0.95);
            --text-color: #1f2937;
            --text-muted: #6b7280;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: #f3f4f6;
            background-image:
                radial-gradient(at 0% 0%, hsla(253, 16%, 7%, 1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225, 39%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(339, 49%, 30%, 1) 0, transparent 50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Public Sans', -apple-system, sans-serif;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        .auth-card {
            background: var(--surface-color);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
        }

        .brand-logo-wrapper {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo-wrapper img {
            height: 50px;
            filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .auth-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control-premium {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            font-size: 1rem;
            background-color: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            color: var(--text-color);
            transition: all 0.2s ease;
        }

        .input-wrapper i.bx {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.25rem;
            transition: color 0.2s ease;
        }

        .input-wrapper .toggle-password {
            left: auto;
            right: 1rem;
            cursor: pointer;
        }

        .form-control-premium:focus {
            outline: none;
            background-color: #ffffff;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .form-control-premium:focus+i.bx {
            color: var(--brand-primary);
        }

        .auth-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        }

        .auth-btn:active {
            transform: translateY(0);
        }

        /* Elegant Custom Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .checkbox-wrapper input[type="checkbox"] {
            appearance: none;
            background-color: #fff;
            margin: 0 0.75rem 0 0;
            font: inherit;
            color: currentColor;
            width: 1.25em;
            height: 1.25em;
            border: 1.5px solid #d1d5db;
            border-radius: 0.35em;
            display: grid;
            place-content: center;
            cursor: pointer;
            transition: 0.2s all ease-in-out;
        }

        .checkbox-wrapper input[type="checkbox"]::before {
            content: "";
            width: 0.65em;
            height: 0.65em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em white;
            background-color: inherit;
            transform-origin: center;
            clip-path: polygon(14% 44%, 0 65%, 50% 100%, 100% 16%, 80% 0%, 43% 62%);
        }

        .checkbox-wrapper input[type="checkbox"]:checked {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        .checkbox-wrapper input[type="checkbox"]:checked::before {
            transform: scale(1);
        }

        .checkbox-wrapper label {
            color: var(--text-muted);
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        /* Alert Styling */
        .alert-premium {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .alert-premium ul {
            margin: 0;
            padding-left: 1.5rem;
            color: #991b1b;
            font-size: 0.875rem;
        }

        .circle-decoration {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            z-index: 1;
            animation: floatA 8s ease-in-out infinite alternate;
        }

        .circle-1 {
            width: 150px;
            height: 150px;
            top: -40px;
            left: -60px;
        }

        .circle-2 {
            width: 100px;
            height: 100px;
            bottom: -30px;
            right: -30px;
            animation-delay: -4s;
        }

        @keyframes floatA {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(-20px) rotate(10deg);
            }
        }
    </style>

    <div class="auth-container">
        <div class="circle-decoration circle-1"></div>
        <div class="circle-decoration circle-2"></div>

        <div class="auth-card">
            <div class="brand-logo-wrapper">
                <a href="{{ url('/') }}">
                    <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg') }}"
                        alt="{{ config('variables.templateName') }}">
                </a>
            </div>

            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to access your dashboard</p>

            @if($errors->any())
                <div class="alert-premium">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control-premium" id="email" name="email" value="{{ old('email') }}"
                            placeholder="admin@example.com" autofocus required />
                        <i class="bx bx-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label mb-0" for="password">Password</label>
                        <a href="{{ route('admin.password.request') }}"
                            style="font-size: 0.85rem; color: var(--brand-primary); text-decoration: none; font-weight: 500;">
                            Forgot Password?
                        </a>
                    </div>
                    <div class="input-wrapper">
                        <input type="password" id="password" class="form-control-premium" name="password"
                            placeholder="••••••••" required />
                        <i class="bx bx-lock-alt" style="left: 1rem;"></i>
                        <i class="bx bx-hide toggle-password" id="togglePasswordBtn"></i>
                    </div>
                </div>

                <div class="checkbox-wrapper">
                    <input type="checkbox" id="remember" name="remember" />
                    <label for="remember">Keep me securely logged in</label>
                </div>

                <button class="auth-btn" type="submit">
                    <span>Sign In</span>
                    <i class="bx bx-right-arrow-alt"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('password');

            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('bx-show');
                this.classList.toggle('bx-hide');
            });
        });
    </script>
@endsection