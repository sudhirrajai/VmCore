@extends('layouts.app')

@section('title', 'Portfolio - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('portfolio_meta_description', 'Explore our portfolio of projects and case studies.'))
@section('meta_keywords', \App\Models\Setting::get('portfolio_meta_keywords', 'portfolio, case studies, projects, creative work, design'))
@section('canonical', route('portfolio'))

@section('content')

    <!-- Hero Section -->
    <section class="pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up">
        <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-slate-900 mb-6 uppercase">
            {!! \App\Models\Setting::get('portfolio_hero_title', 'Our Impactful Work') !!}
        </h1>
        <p class="text-lg text-slate-500 leading-relaxed">
            {!! \App\Models\Setting::get('portfolio_hero_subtitle', 'We partner with forward-thinking companies to craft digital experiences that drive growth and innovation.') !!}
        </p>
    </section>

    <!-- Filter Section -->
    <section class="px-8 pb-12 animate-fade-in-up delay-200">
        <div class="flex flex-wrap justify-center gap-3">
            {{-- Category filter --}}
            <a href="{{ route('portfolio') }}" 
               class="px-6 py-2 rounded-md text-sm transition-all duration-200 border {{ !request('category') ? 'bg-slate-900 text-white border-slate-900 shadow-md font-medium' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('portfolio', ['category' => $cat->slug]) }}"
                   class="px-6 py-2 rounded-md text-sm transition-all duration-200 border {{ request('category') == $cat->slug ? 'bg-slate-900 text-white border-slate-900 shadow-md font-medium' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- Portfolio Grid -->
    <div class="portfolio-area-1 pb-24 overflow-hidden">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                @forelse($projects as $project)
                    <div class="group cursor-pointer animate-on-scroll">
                        <a href="{{ route('portfolio.detail', $project->slug) }}" class="block">
                            <div class="relative aspect-[4/3] overflow-hidden rounded-lg bg-slate-100 shadow-sm">
                                <img 
                                    src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}" 
                                    alt="{{ $project->title }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                                {{-- Hover Overlay --}}
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all duration-300">
                                    <span class="bg-white text-slate-900 px-6 py-2 rounded-md text-sm font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                        View Project
                                    </span>
                                </div>
                            </div>
                        </a>
                        <div class="mt-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $project->title }}</h3>
                            <p class="text-sm text-slate-500">
                                {{ $project->categories->count() ? $project->categories->pluck('name')->implode(', ') : 'Uncategorized' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-slate-500 text-lg">No projects found for this category.</p>
                        <a href="{{ route('portfolio') }}" class="text-[#4E7CC1] font-bold underline mt-2 block">View all projects</a>
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
    </div>



@endsection