@extends('layouts/contentNavbarLayout')

@section('title', 'Case Studies')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Case Studies</h4>
        <p class="text-muted mb-0">Manage in-depth project case studies</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCaseStudyModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Case Study
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Client</th>
                        <th>Industry</th>
                        <th>Duration</th>
                        <th>Key Result</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id'=>1,'title'=>'Scaling E-Commerce to 10x Revenue',  'client'=>'RetailCo Inc.',     'industry'=>'Retail',      'duration'=>'6 months', 'result'=>'+312% revenue',   'status'=>'Published'],
                        ['id'=>2,'title'=>'Healthcare App with 50k Users',       'client'=>'HealthFirst',       'industry'=>'Healthcare',  'duration'=>'8 months', 'result'=>'50k+ downloads',  'status'=>'Published'],
                        ['id'=>3,'title'=>'Logistics Automation System',         'client'=>'LogiTrack Ltd.',    'industry'=>'Logistics',   'duration'=>'5 months', 'result'=>'40% cost savings','status'=>'Published'],
                        ['id'=>4,'title'=>'SaaS Dashboard Redesign',            'client'=>'DataStream SaaS',   'industry'=>'SaaS',        'duration'=>'3 months', 'result'=>'+65% retention',  'status'=>'Draft'],
                        ['id'=>5,'title'=>'FinTech Wallet Launch',               'client'=>'PaySwift Inc.',     'industry'=>'FinTech',     'duration'=>'10 months','result'=>'$2M processed',   'status'=>'Published'],
                    ] as $cs)
                    <tr>
                        <td class="text-muted small">{{ $cs['id'] }}</td>
                        <td class="fw-semibold">{{ $cs['title'] }}</td>
                        <td class="text-muted small">{{ $cs['client'] }}</td>
                        <td><span class="badge bg-label-info">{{ $cs['industry'] }}</span></td>
                        <td class="text-muted small">{{ $cs['duration'] }}</td>
                        <td><span class="badge bg-label-success fw-semibold">{{ $cs['result'] }}</span></td>
                        <td><span class="badge badge-{{ strtolower($cs['status']) }}">{{ $cs['status'] }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="icon-base bx bx-edit"></i></button>
                                <button class="btn btn-sm btn-icon btn-outline-danger" title="Delete"><i class="icon-base bx bx-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Case Study Modal --}}
<div class="modal fade" id="addCaseStudyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Case Study</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label fw-semibold">Title</label><input type="text" class="form-control" placeholder="Case study title"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Client</label><input type="text" class="form-control" placeholder="Client name"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Industry</label><input type="text" class="form-control" placeholder="e.g. Healthcare"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Duration</label><input type="text" class="form-control" placeholder="e.g. 6 months"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Key Result</label><input type="text" class="form-control" placeholder="e.g. +200% revenue"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Status</label><select class="form-select"><option>Draft</option><option>Published</option></select></div>
                        <div class="col-12"><label class="form-label fw-semibold">Summary</label><textarea class="form-control" rows="3" placeholder="Brief case study summary..."></textarea></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Case Study</button>
            </div>
        </div>
    </div>
</div>

@endsection
