@extends('layouts.app')

@section('title', 'Page Not Found - ' . ($siteSettings['site_name'] ?? 'VMCore'))

@push('styles')
<style>
    .error-area {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 0;
        position: relative;
        overflow: hidden;
    }

    .error-bg-text {
        position: absolute;
        font-size: clamp(10rem, 40vw, 30rem);
        font-weight: 900;
        line-height: 1;
        color: var(--theme-color, #4A76B2);
        opacity: 0.05;
        z-index: 0;
        user-select: none;
        pointer-events: none;
        white-space: nowrap;
    }

    .error-content {
        position: relative;
        z-index: 1;
        max-width: 600px;
        width: 100%;
    }

    .error-code {
        font-size: 6rem;
        font-weight: 800;
        color: var(--theme-color, #4A76B2);
        line-height: 1;
        margin-bottom: 1.5rem;
        letter-spacing: -2px;
    }

    .error-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1rem;
    }

    .error-text {
        font-size: 1.1rem;
        color: #64748b;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .error-btns {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.25rem;
        flex-wrap: wrap;
    }

    .btn-modern {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 2rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    .btn-primary-modern {
        background: var(--theme-color, #4A76B2);
        color: #fff;
        box-shadow: 0 10px 20px -5px color-mix(in srgb, var(--theme-color, #4A76B2) 40%, transparent);
    }

    .btn-primary-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -5px color-mix(in srgb, var(--theme-color, #4A76B2) 50%, transparent);
        color: #fff;
    }

    .btn-outline-modern {
        border: 2px solid #e2e8f0;
        color: #0f172a;
    }

    .btn-outline-modern:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    .floating-elements div {
        position: absolute;
        width: 15px;
        height: 15px;
        background: var(--theme-color, #4A76B2);
        border-radius: 50%;
        opacity: 0.2;
        animation: float 6s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .float-1 { top: 20%; left: 10%; animation-delay: 0s; }
    .float-2 { top: 60%; right: 15%; animation-delay: 1s; }
    .float-3 { bottom: 20%; left: 20%; animation-delay: 2s; }
    .float-4 { top: 30%; right: 25%; animation-delay: 3s; }
</style>
@endpush

@section('content')
<section class="error-area">
    <div class="error-bg-text">404</div>
    
    <div class="floating-elements d-none d-lg-block">
        <div class="float-1"></div>
        <div class="float-2"></div>
        <div class="float-3"></div>
        <div class="float-4"></div>
    </div>

    <div class="container text-center">
        <div class="error-content mx-auto animate-on-scroll">
            <div class="error-code">404</div>
            <h1 class="error-title">Oops! Page Not Found</h1>
            <p class="error-text">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            
            <div class="error-btns">
                <a href="{{ url('/') }}" class="btn-modern btn-primary-modern">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Back to Home
                </a>
                <a href="{{ route('contact') }}" class="btn-modern btn-outline-modern">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
