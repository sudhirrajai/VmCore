@extends('layouts/contentNavbarLayout')

@section('title', 'Inquiries')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Contact Inquiries</h4>
        <p class="text-muted mb-0">View and manage messages from the contact form</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-danger fs-6 align-self-center">3 Unread</span>
        <button class="btn btn-outline-secondary btn-sm">Mark All Read</button>
    </div>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    @foreach ([
        ['label'=>'Total Inquiries', 'value'=>'47', 'icon'=>'bx-envelope',      'color'=>'primary'],
        ['label'=>'Unread',          'value'=>'3',  'icon'=>'bx-envelope-open',  'color'=>'danger'],
        ['label'=>'Replied',         'value'=>'38', 'icon'=>'bx-reply',          'color'=>'success'],
        ['label'=>'This Week',       'value'=>'8',  'icon'=>'bx-calendar-week',  'color'=>'info'],
    ] as $stat)
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm portfolio-stat-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="avatar"><span class="avatar-initial rounded-circle bg-label-{{ $stat['color'] }}"><i class="icon-base bx {{ $stat['icon'] }} text-{{ $stat['color'] }}"></i></span></div>
                <div><p class="text-muted small mb-0">{{ $stat['label'] }}</p><h4 class="fw-bold mb-0">{{ $stat['value'] }}</h4></div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id'=>1,'name'=>'John Smith',   'email'=>'john@retailco.com',   'subject'=>'Web Development Project',  'msg'=>'We need a complete e-commerce rebuild for our retail chain...',    'status'=>'Unread',  'date'=>'Feb 18, 2025'],
                        ['id'=>2,'name'=>'Sarah Lee',    'email'=>'sarah@healthfirst.com','subject'=>'Mobile App Inquiry',       'msg'=>'Looking for a team to build a patient management mobile app...',  'status'=>'Unread',  'date'=>'Feb 17, 2025'],
                        ['id'=>3,'name'=>'Mike Johnson', 'email'=>'mike@logitrack.com',  'subject'=>'Partnership Opportunity',  'msg'=>'We are interested in a long-term technology partnership...',       'status'=>'Unread',  'date'=>'Feb 16, 2025'],
                        ['id'=>4,'name'=>'Emma Davis',   'email'=>'emma@datastream.io',  'subject'=>'UI/UX Design Quote',       'msg'=>'Need a complete redesign of our SaaS dashboard interface...',      'status'=>'Replied', 'date'=>'Feb 14, 2025'],
                        ['id'=>5,'name'=>'Chris Wilson', 'email'=>'chris@payswift.com',  'subject'=>'General Inquiry',          'msg'=>'Interested in your services for a fintech startup project...',     'status'=>'Replied', 'date'=>'Feb 12, 2025'],
                        ['id'=>6,'name'=>'Lisa Brown',   'email'=>'lisa@eduhub.com',     'subject'=>'EdTech Platform Build',    'msg'=>'We want to build an online learning platform for 10,000 students...','status'=>'Replied','date'=>'Feb 10, 2025'],
                    ] as $inq)
                    <tr class="{{ $inq['status'] === 'Unread' ? 'table-active' : '' }}">
                        <td class="text-muted small">{{ $inq['id'] }}</td>
                        <td class="fw-semibold">
                            {{ $inq['name'] }}
                            @if($inq['status'] === 'Unread')
                                <span class="badge bg-danger ms-1" style="font-size:0.6rem;">New</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $inq['email'] }}</td>
                        <td class="fw-semibold small">{{ $inq['subject'] }}</td>
                        <td class="text-muted small" style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inq['msg'] }}</td>
                        <td>
                            <span class="badge {{ $inq['status'] === 'Unread' ? 'bg-danger' : 'badge-published' }}">{{ $inq['status'] }}</span>
                        </td>
                        <td class="text-muted small">{{ $inq['date'] }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-icon btn-outline-primary" title="View"><i class="icon-base bx bx-show"></i></button>
                                <button class="btn btn-sm btn-icon btn-outline-success" title="Reply"><i class="icon-base bx bx-reply"></i></button>
                                <button class="btn btn-sm btn-icon btn-outline-danger" title="Delete"><i class="icon-base bx bx-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
        <small class="text-muted">Showing 6 of 47 inquiries</small>
        <nav><ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul></nav>
    </div>
</div>

@endsection
