@extends('layouts.app')

@section('title', setting('faq_meta_title', 'FAQ - ' . ($siteSettings['site_name'] ?? 'VMCore')))
@section('meta_description', setting('faq_meta_description', 'Frequently asked questions about our services.'))
@section('meta_keywords', setting('faq_meta_keywords', 'FAQ, frequently asked questions, help, support'))
@section('canonical', route('faq'))

@push('structured_data')
    <script type="application/ld+json">
                                {
                                    "@@context": "https://schema.org",
                                    "@@type": "FAQPage",
                                    "mainEntity": [
                                        @foreach($faqs as $i => $faq)
                                            {
                                                "@@type": "Question",
                                                "name": "{{ addslashes($faq->question) }}",
                                                "acceptedAnswer": {
                                                    "@@type": "Answer",
                                                    "text": "{{ addslashes(strip_tags($faq->answer)) }}"
                                                }
                                            }{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    ]
                                }
                                </script>
    {!! setting('faq_page_faq_schema') !!}
@endpush

@php
    $groupedFaqs = [
        'General' => collect(),
        'Services' => collect(),
        'Pricing' => collect(),
        'Support' => collect()
    ];
    foreach ($faqs as $faq) {
        $q = strtolower($faq->question);
        if (str_contains($q, 'price') || str_contains($q, 'cost') || str_contains($q, 'pay') || str_contains($q, 'fee') || str_contains($q, 'hidden')) {
            $groupedFaqs['Pricing']->push($faq);
        } elseif (str_contains($q, 'service') || str_contains($q, 'offer') || str_contains($q, 'design') || str_contains($q, 'develop') || str_contains($q, 'tech')) {
            $groupedFaqs['Services']->push($faq);
        } elseif (str_contains($q, 'support') || str_contains($q, 'maintain') || str_contains($q, 'help') || str_contains($q, 'train') || str_contains($q, 'reach')) {
            $groupedFaqs['Support']->push($faq);
        } else {
            $groupedFaqs['General']->push($faq);
        }
    }
    $groupedFaqs = array_filter($groupedFaqs, fn($group) => $group->count() > 0);
    if (empty($groupedFaqs) && $faqs->count() > 0) {
        $groupedFaqs['General'] = $faqs;
    }
@endphp

@push('styles')
    <style>
        details>summary {
            list-style: none;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        details[open] summary~* {
            animation: faq-slide-down 0.25s ease forwards;
        }

        @keyframes faq-slide-down {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .faq-layout {
            display: flex;
            flex-direction: row;
            gap: 64px;
            max-width: 1440px;
            margin: 0 auto;
            padding: 32px 24px 96px;
            align-items: flex-start;
        }

        .faq-sidebar {
            width: 200px;
            flex-shrink: 0;
            position: sticky;
            top: 100px;
        }

        .faq-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .faq-sidebar a {
            font-size: 15px;
            font-weight: 500;
            color: #94a3b8;
            text-decoration: none;
            padding-bottom: 2px;
            transition: color 0.2s;
        }

        .faq-sidebar a.active,
        .faq-sidebar a:hover {
            color: #0f172a;
            border-bottom: 2px solid #0f172a;
        }

        .faq-sidebar a.active {
            font-weight: 700;
        }

        .faq-content {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 56px;
        }

        .faq-group-title {
            margin-bottom: 20px;
        }

        .faq-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .faq-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .faq-item[open] {
            border-color: #cbd5e1;
        }

        .faq-item summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 22px;
            cursor: pointer;
            outline: none;
            gap: 16px;
        }

        .faq-item summary:hover {
            background: #f8fafc;
        }

        .faq-chevron {
            flex-shrink: 0;
            color: #94a3b8;
            transition: transform 0.3s ease;
        }

        .faq-item[open] .faq-chevron {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 22px 20px;
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
        }

        .faq-cta {
            background: #f1f5f9;
            border-top: 1px solid #e2e8f0;
            padding: 64px 24px;
        }

        .faq-cta-inner {
            max-width: 1440px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            flex-wrap: wrap;
        }

        .faq-cta h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .faq-cta p {
            font-size: 14px;
            color: #64748b;
        }

        .faq-cta-actions {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .btn-dark {
            display: inline-flex;
            align-items: center;
            padding: 10px 24px;
            background: #1a1a1a;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-dark:hover {
            background: #333;
            color: #fff;
        }

        .faq-email-link {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            text-decoration: none;
            border-bottom: 2px solid #1e293b;
            padding-bottom: 2px;
            transition: opacity 0.2s;
        }

        .faq-email-link:hover {
            opacity: 0.7;
            color: #1e293b;
        }

        /* Hero section */
        .faq-hero {
            padding: 0px 24px 30px;
            padding: 48px 24px 64px;
            text-align: center;
            max-width: 1440px;
            margin: 0 auto;
        }

        .faq-hero h1 {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin-bottom: 16px;
        }

        .faq-hero p {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .faq-search-wrap {
            position: relative;
            max-width: 540px;
            margin: 0 auto;
        }

        .faq-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            width: 18px;
            height: 18px;
        }

        .faq-search {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            font-size: 15px;
            color: #1e293b;
            outline: none;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }

        .faq-search:focus {
            border-color: #94a3b8;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.15);
        }

        @media (max-width: 768px) {
            .faq-layout {
                flex-direction: column;
                gap: 32px;
                padding: 24px 16px 64px;
            }

            .faq-sidebar {
                width: 100%;
                position: static;
            }

            .faq-sidebar ul {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 12px;
            }

            .faq-hero h1 {
                font-size: 28px;
            }

            .faq-cta-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Hero -->
    <div class="faq-hero">
        <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6 text-slate-900">{!! setting('faq_title', 'Frequently Asked Questions') !!}</h1>
        <p class="text-base leading-relaxed text-slate-500 max-w-2xl mx-auto mb-10">{!! setting('faq_intro_text', "Find answers to the most common questions about VM Core's services, pricing, and support.") !!}
        </p>
        <!-- <div class="faq-search-wrap">
                                <svg class="faq-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <input type="text" class="faq-search" placeholder="Search for answers..." id="faqSearch" />
                            </div> -->
    </div>

    <!-- Main FAQ Layout -->
    <div class="faq-layout">

        <!-- Sidebar -->
        <div class="faq-sidebar">
            <ul>
                @foreach($groupedFaqs as $category => $items)
                    <li>
                        <a href="#faq-{{ strtolower($category) }}" class="{{ $loop->first ? 'active' : '' }}">
                            {{ $category }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- FAQ Groups -->
        <div class="faq-content">
            @forelse($groupedFaqs as $category => $items)
                <div id="faq-{{ strtolower($category) }}">
                    <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mb-6 text-slate-900">{{ $category }}</h2>
                    @foreach($items as $faq)
                        <details class="faq-item">
                            <summary class="text-lg font-semibold text-slate-900">
                                <span>{{ $faq->question }}</span>
                                <svg class="faq-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </summary>
                            <div class="faq-answer ckeditor-content text-base leading-relaxed text-slate-500">
                                {!! $faq->answer !!}
                            </div>
                        </details>
                    @endforeach
                </div>
            @empty
                <div style="text-align:center; padding: 48px; background:#fff; border-radius:10px; border:1px solid #e2e8f0;">
                    <p style="color:#64748b;">No FAQs available at the moment.</p>
                </div>
            @endforelse
        </div>

    </div>



    <script>
        // Live search filter
        document.getElementById('faqSearch').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.faq-item').forEach(function (item) {
                const question = item.querySelector('summary span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer') ? item.querySelector('.faq-answer').textContent.toLowerCase() : '';
                item.style.display = (question.includes(q) || answer.includes(q)) ? '' : 'none';
            });
            // hide groups that have no visible items
            document.querySelectorAll('.faq-content > div').forEach(function (group) {
                const visible = Array.from(group.querySelectorAll('.faq-item')).some(i => i.style.display !== 'none');
                group.style.display = (visible || q === '') ? '' : 'none';
            });
        });
    </script>

@endsection