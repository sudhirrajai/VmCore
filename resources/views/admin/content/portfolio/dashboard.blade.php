@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div class="portfolio-page-header mb-4">
    <h4 class="fw-bold mb-1">Portfolio Dashboard</h4>
    <p class="text-muted mb-0">Welcome back! Here's what's happening with your portfolio.</p>
</div>

{{-- Stats Row --}}
<div class="row g-4 mb-4">
    @foreach ([
        ['label' => 'Total Projects',    'value' => '24',  'icon' => 'bx-briefcase',   'color' => 'primary', 'change' => '+3 this month'],
        ['label' => 'Active Services',   'value' => '8',   'icon' => 'bx-cog',         'color' => 'success', 'change' => 'All active'],
        ['label' => 'Blog Posts',        'value' => '47',  'icon' => 'bx-news',         'color' => 'info',    'change' => '+5 this month'],
        ['label' => 'New Inquiries',     'value' => '12',  'icon' => 'bx-envelope',     'color' => 'warning', 'change' => '3 unread'],
        ['label' => 'Team Members',      'value' => '18',  'icon' => 'bx-group',        'color' => 'primary', 'change' => '2 new'],
        ['label' => 'Testimonials',      'value' => '36',  'icon' => 'bx-star',         'color' => 'success', 'change' => '+4 this month'],
        ['label' => 'Case Studies',      'value' => '11',  'icon' => 'bx-file',         'color' => 'info',    'change' => '2 in draft'],
        ['label' => 'Open Positions',    'value' => '6',   'icon' => 'bx-id-card',      'color' => 'warning', 'change' => '14 applicants'],
    ] as $stat)
    <div class="col-6 col-md-3">
        <div class="card portfolio-stat-card {{ in_array($stat['color'], ['success','info','warning']) ? 'accent' : '' }} border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <p class="text-muted small mb-1">{{ $stat['label'] }}</p>
                        <h3 class="fw-bold mb-0">{{ $stat['value'] }}</h3>
                    </div>
                    <div class="avatar avatar-md">
                        <span class="avatar-initial rounded-circle bg-label-{{ $stat['color'] }}">
                            <i class="icon-base bx {{ $stat['icon'] }} text-{{ $stat['color'] }}"></i>
                        </span>
                    </div>
                </div>
                <small class="text-muted">{{ $stat['change'] }}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Recent Projects + Recent Inquiries --}}
<div class="row g-4">

    {{-- Recent Projects --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between bg-transparent border-bottom">
                <h5 class="card-title mb-0 fw-bold">Recent Projects</h5>
                <a href="{{ route('admin.portfolio.projects') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([
                                ['name' => 'E-Commerce Platform',    'cat' => 'Web Dev',    'status' => 'Published', 'date' => 'Feb 10, 2025'],
                                ['name' => 'Healthcare Mobile App',  'cat' => 'Mobile',     'status' => 'Published', 'date' => 'Jan 28, 2025'],
                                ['name' => 'SaaS Dashboard',         'cat' => 'UI/UX',      'status' => 'Draft',     'date' => 'Jan 15, 2025'],
                                ['name' => 'Logistics System',       'cat' => 'Web Dev',    'status' => 'Published', 'date' => 'Jan 5, 2025'],
                                ['name' => 'FinTech Wallet App',     'cat' => 'Mobile',     'status' => 'Archived',  'date' => 'Dec 20, 2024'],
                            ] as $project)
                            <tr>
                                <td class="fw-semibold">{{ $project['name'] }}</td>
                                <td><span class="badge bg-label-primary">{{ $project['cat'] }}</span></td>
                                <td>
                                    <span class="badge badge-{{ strtolower($project['status']) }}">{{ $project['status'] }}</span>
                                </td>
                                <td class="text-muted small">{{ $project['date'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Inquiries --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between bg-transparent border-bottom">
                <h5 class="card-title mb-0 fw-bold">Recent Inquiries</h5>
                <a href="{{ route('admin.content.inquiries') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach ([
                        ['name' => 'John Smith',    'subject' => 'Web Development Project', 'time' => '2h ago',  'unread' => true],
                        ['name' => 'Sarah Lee',     'subject' => 'Mobile App Inquiry',      'time' => '5h ago',  'unread' => true],
                        ['name' => 'Mike Johnson',  'subject' => 'Partnership Opportunity', 'time' => '1d ago',  'unread' => false],
                        ['name' => 'Emma Davis',    'subject' => 'UI/UX Design Quote',      'time' => '2d ago',  'unread' => false],
                        ['name' => 'Chris Wilson',  'subject' => 'General Inquiry',         'time' => '3d ago',  'unread' => false],
                    ] as $inquiry)
                    <li class="list-group-item px-4 py-3 {{ $inquiry['unread'] ? 'bg-label-primary bg-opacity-25' : '' }}">
                        <div class="d-flex align-items-start gap-3">
                            <div class="avatar avatar-sm flex-shrink-0">
                                <span class="avatar-initial rounded-circle bg-label-primary text-primary fw-bold">
                                    {{ substr($inquiry['name'], 0, 1) }}
                                </span>
                            </div>
                            <div class="flex-grow-1 min-width-0">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-semibold mb-0 small {{ $inquiry['unread'] ? 'text-primary' : '' }}">{{ $inquiry['name'] }}</p>
                                    <small class="text-muted">{{ $inquiry['time'] }}</small>
                                </div>
                                <p class="text-muted small mb-0 text-truncate">{{ $inquiry['subject'] }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
