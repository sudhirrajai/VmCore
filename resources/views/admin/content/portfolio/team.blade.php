@extends('layouts/contentNavbarLayout')

@section('title', 'Team Members')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Team Members</h4>
        <p class="text-muted mb-0">Manage your company team profiles</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Member
    </button>
</div>

<div class="row g-4">
    @foreach ([
        ['id'=>1,'name'=>'Alex Martinez',  'role'=>'CEO & Co-Founder',        'dept'=>'Leadership',  'email'=>'alex@company.com',   'status'=>'Active',   'initials'=>'AM'],
        ['id'=>2,'name'=>'Sara Kim',       'role'=>'Head of Design',           'dept'=>'Design',      'email'=>'sara@company.com',   'status'=>'Active',   'initials'=>'SK'],
        ['id'=>3,'name'=>'James Roberts',  'role'=>'Lead Developer',           'dept'=>'Engineering', 'email'=>'james@company.com',  'status'=>'Active',   'initials'=>'JR'],
        ['id'=>4,'name'=>'Emma Davis',     'role'=>'Project Manager',          'dept'=>'Management',  'email'=>'emma@company.com',   'status'=>'Active',   'initials'=>'ED'],
        ['id'=>5,'name'=>'Chris Wilson',   'role'=>'Mobile Developer',         'dept'=>'Engineering', 'email'=>'chris@company.com',  'status'=>'Active',   'initials'=>'CW'],
        ['id'=>6,'name'=>'Lisa Brown',     'role'=>'DevOps Engineer',          'dept'=>'Engineering', 'email'=>'lisa@company.com',   'status'=>'Active',   'initials'=>'LB'],
        ['id'=>7,'name'=>'Tom Harris',     'role'=>'UI/UX Designer',           'dept'=>'Design',      'email'=>'tom@company.com',    'status'=>'Active',   'initials'=>'TH'],
        ['id'=>8,'name'=>'Nina Patel',     'role'=>'Marketing Specialist',     'dept'=>'Marketing',   'email'=>'nina@company.com',   'status'=>'Inactive', 'initials'=>'NP'],
    ] as $member)
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body pt-4">
                <div class="avatar avatar-xl mx-auto mb-3">
                    <span class="avatar-initial rounded-circle bg-label-primary fw-bold text-primary" style="font-size:1.2rem;">
                        {{ $member['initials'] }}
                    </span>
                </div>
                <h6 class="fw-bold mb-0">{{ $member['name'] }}</h6>
                <p class="text-primary small mb-1">{{ $member['role'] }}</p>
                <span class="badge bg-label-info mb-2">{{ $member['dept'] }}</span>
                <p class="text-muted small mb-3">{{ $member['email'] }}</p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                    <span class="badge badge-{{ strtolower($member['status']) }}">{{ $member['status'] }}</span>
                </div>
                <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="icon-base bx bx-edit"></i></button>
                    <button class="btn btn-sm btn-icon btn-outline-danger" title="Remove"><i class="icon-base bx bx-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Add Member Modal --}}
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label fw-semibold">Full Name</label><input type="text" class="form-control" placeholder="Full name"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Role / Title</label><input type="text" class="form-control" placeholder="e.g. Lead Developer"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Department</label><select class="form-select"><option>Engineering</option><option>Design</option><option>Management</option><option>Marketing</option><option>Leadership</option></select></div>
                        <div class="col-md-8"><label class="form-label fw-semibold">Email</label><input type="email" class="form-control" placeholder="email@company.com"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Status</label><select class="form-select"><option>Active</option><option>Inactive</option></select></div>
                        <div class="col-12"><label class="form-label fw-semibold">Bio (optional)</label><textarea class="form-control" rows="3" placeholder="Short bio..."></textarea></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Member</button>
            </div>
        </div>
    </div>
</div>

@endsection
