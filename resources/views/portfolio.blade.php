@extends('layouts.app')

@section('title', setting('portfolio_meta_title', 'Portfolio - ' . ($siteSettings['site_name'] ?? 'VMCore')))
@section('meta_description', setting('portfolio_meta_description', 'Explore our portfolio of projects and case studies.'))
@section('meta_keywords', setting('portfolio_meta_keywords', 'portfolio, case studies, projects, creative work, design'))
@section('canonical', route('portfolio'))

@push('structured_data')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            },
            {
                "@@type": "ListItem",
                "position": 2,
                "name": "Portfolio",
                "item": "{{ route('portfolio') }}"
            }
        ]
    }
    </script>
    {!! setting('portfolio_page_faq_schema') !!}
@endpush
@push('styles')
<style>
    /* Portfolio Grid Layout */
    .portfolio-grid-container {
        max-width: 1440px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 2rem;
        padding-right: 2rem;
        padding-bottom: 6rem;
    }
    .portfolio-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem 2rem;
    }
    @media (min-width: 768px) {
        .portfolio-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1024px) {
        .portfolio-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Portfolio Card Hover Effects */
    .portfolio-card .card-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .portfolio-card:hover .card-overlay {
        opacity: 1;
    }
    .portfolio-card .card-overlay .view-btn {
        background: #fff;
        color: #111827;
        padding: 0.5rem 1.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 700;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        transform: translateY(8px);
        transition: transform 0.3s ease;
    }
    .portfolio-card:hover .card-overlay .view-btn {
        transform: translateY(-4px);
    }
    .portfolio-card .card-image {
        transition: transform 0.5s ease;
    }
    .portfolio-card:hover .card-image {
        transform: scale(1.05);
    }
    /* Empty state link color */
    .portfolio-empty-link {
        color: var(--color-primary, #4A76B2);
    }
</style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up">
        <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-slate-900 mb-6">
            {!! \App\Models\Setting::get('portfolio_hero_title', 'Our Impactful Work') !!}
        </h1>
        <p class="text-base leading-relaxed text-slate-500">
            {!! \App\Models\Setting::get('portfolio_hero_subtitle', 'We partner with forward-thinking companies to craft digital experiences that drive growth and innovation.') !!}
        </p>
    </section>

    <!-- Filter Section -->
    <section class="px-8 pb-12 animate-fade-in-up delay-200">
        <div class="flex flex-wrap justify-center gap-3">
            {{-- "All" filter button --}}
            <a href="{{ route('portfolio') }}" 
               class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ !request('category') ? 'text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200' }}"
               style="{{ !request('category') ? 'background-color: #111827;' : '' }}">
                {!! setting('portfolio_filter_all_text', 'All') !!}
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('portfolio', ['category' => $cat->slug]) }}"
                   class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request('category') == $cat->slug ? 'text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200' }}"
                   style="{{ request('category') == $cat->slug ? 'background-color: #111827;' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- Portfolio Grid -->
    <div class="portfolio-grid-container">
        <div class="portfolio-grid">
            @forelse($projects as $project)
                <div class="portfolio-card cursor-pointer animate-on-scroll">
                    <a href="{{ route('portfolio.detail', $project->slug) }}" class="block">
                        <div class="relative overflow-hidden rounded-lg bg-gray-200" style="aspect-ratio: 4/3;">
                            <img 
                                src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}" 
                                alt="{{ $project->title }}"
                                class="card-image"
                                style="height: 100%; width: 100%; object-fit: cover;"
                            />
                            {{-- Hover Overlay --}}
                            <div class="card-overlay">
                                <span class="view-btn">{!! setting('portfolio_view_button_text', 'View Project') !!}</span>
                            </div>
                        </div>
                    </a>
                    <div class="mt-4">
                        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">{{ $project->title }}</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            {{ $project->categories->count() ? $project->categories->pluck('name')->implode(', ') : 'Uncategorized' }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-base leading-relaxed text-slate-500 mb-4">No projects found for this category.</p>
                    <a href="{{ route('portfolio') }}" class="text-sm font-medium portfolio-empty-link underline block">View all projects</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
            <div class="pagination-wrap mt-20 flex justify-center">
                {{ $projects->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

@endsection