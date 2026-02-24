@extends('layouts/blankLayout')

@section('title', 'Forgot Password')

@section('content')
<<<<<<< HEAD
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

    .alert-premium {
        background: #fee2e2;
        border-left: 4px solid #ef4444;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 2rem;
    }

    .alert-premium.success {
        background: #dcfce7;
        border-left: 4px solid #22c55e;
        color: #166534;
    }

    .alert-premium ul {
        margin: 0;
        padding-left: 1.5rem;
        color: #991b1b;
        font-size: 0.875rem;
    }

    .back-to-login {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        color: var(--brand-primary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .back-to-login i {
        vertical-align: middle;
        margin-right: 0.25rem;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="brand-logo-wrapper">
            <a href="{{ url('/') }}">
                <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg') }}"
                    alt="{{ config('variables.templateName') }}">
            </a>
        </div>

        <h2 class="auth-title">Forgot Password? 🔒</h2>
        <p class="auth-subtitle">Enter your email and we'll send you instructions to reset your password</p>

        @if(session('success'))
        <div class="alert-premium success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert-premium">
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
        @endif
        @if($errors->any())
        <div class="alert-premium">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <input type="email" class="form-control-premium" id="email" name="email" value="{{ old('email') }}"
                        placeholder="admin@example.com" autofocus required />
                    <i class="bx bx-envelope"></i>
                </div>
            </div>

            <button class="auth-btn" type="submit">
                <span>Send Reset Link</span>
            </button>

            <a href="{{ route('admin.login') }}" class="back-to-login">
                <i class="bx bx-chevron-left"></i> Back to login
            </a>
        </form>
    </div>
</div>
=======
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

        .alert-premium {
            background: #fee2e2;
            border-left: 4px solid #ef4444;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .alert-premium.success {
            background: #dcfce7;
            border-left: 4px solid #22c55e;
            color: #166534;
        }

        .alert-premium ul {
            margin: 0;
            padding-left: 1.5rem;
            color: #991b1b;
            font-size: 0.875rem;
        }

        .back-to-login {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--brand-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .back-to-login i {
            vertical-align: middle;
            margin-right: 0.25rem;
        }
    </style>

    <div class="auth-container">
        <div class="auth-card">
            <div class="brand-logo-wrapper">
                <a href="{{ url('/') }}">
                    <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg') }}"
                        alt="{{ config('variables.templateName') }}">
                </a>
            </div>

            <h2 class="auth-title">Forgot Password? 🔒</h2>
            <p class="auth-subtitle">Enter your email and we'll send you instructions to reset your password</p>

            @if(session('success'))
                <div class="alert-premium success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-premium">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif
            @if($errors->any())
                <div class="alert-premium">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control-premium" id="email" name="email" value="{{ old('email') }}"
                            placeholder="admin@example.com" autofocus required />
                        <i class="bx bx-envelope"></i>
                    </div>
                </div>

                <button class="auth-btn" type="submit">
                    <span>Send Reset Link</span>
                </button>

                <a href="{{ route('admin.login') }}" class="back-to-login">
                    <i class="bx bx-chevron-left"></i> Back to login
                </a>
            </form>
        </div>
    </div>
>>>>>>> 22cfb744b7b90b938fa96fd2db5c03e28cf7ff5a
@endsection