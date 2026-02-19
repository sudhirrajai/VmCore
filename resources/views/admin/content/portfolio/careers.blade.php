@extends('layouts/contentNavbarLayout')

@section('title', 'Careers')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Careers</h4>
        <p class="text-muted mb-0">Manage open job listings</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Job
    </button>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    @foreach ([
        ['label'=>'Open Positions', 'value'=>'6',  'icon'=>'bx-id-card',   'color'=>'primary'],
        ['label'=>'Total Applicants','value'=>'47', 'icon'=>'bx-user-plus', 'color'=>'success'],
        ['label'=>'Interviews',     'value'=>'12', 'icon'=>'bx-calendar',  'color'=>'info'],
        ['label'=>'Hired',          'value'=>'3',  'icon'=>'bx-check-circle','color'=>'warning'],
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
                        <th>Job Title</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Applicants</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id'=>1,'title'=>'Senior Laravel Developer',   'dept'=>'Engineering', 'type'=>'Full-time', 'location'=>'Remote',    'applicants'=>14, 'status'=>'Active'],
                        ['id'=>2,'title'=>'React Native Developer',     'dept'=>'Mobile',      'type'=>'Full-time', 'location'=>'Hybrid',    'applicants'=>9,  'status'=>'Active'],
                        ['id'=>3,'title'=>'UI/UX Designer',             'dept'=>'Design',      'type'=>'Full-time', 'location'=>'On-site',   'applicants'=>11, 'status'=>'Active'],
                        ['id'=>4,'title'=>'DevOps Engineer',            'dept'=>'Engineering', 'type'=>'Contract',  'location'=>'Remote',    'applicants'=>6,  'status'=>'Active'],
                        ['id'=>5,'title'=>'Project Manager',            'dept'=>'Management',  'type'=>'Full-time', 'location'=>'On-site',   'applicants'=>5,  'status'=>'Active'],
                        ['id'=>6,'title'=>'Digital Marketing Specialist','dept'=>'Marketing',  'type'=>'Part-time', 'location'=>'Remote',    'applicants'=>2,  'status'=>'Inactive'],
                    ] as $job)
                    <tr>
                        <td class="text-muted small">{{ $job['id'] }}</td>
                        <td class="fw-semibold">{{ $job['title'] }}</td>
                        <td><span class="badge bg-label-primary">{{ $job['dept'] }}</span></td>
                        <td class="text-muted small">{{ $job['type'] }}</td>
                        <td class="text-muted small">{{ $job['location'] }}</td>
                        <td><span class="badge bg-label-info">{{ $job['applicants'] }}</span></td>
                        <td><span class="badge badge-{{ strtolower($job['status']) }}">{{ $job['status'] }}</span></td>
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

{{-- Add Job Modal --}}
<div class="modal fade" id="addJobModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Job Listing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label fw-semibold">Job Title</label><input type="text" class="form-control" placeholder="e.g. Senior Laravel Developer"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Department</label><select class="form-select"><option>Engineering</option><option>Design</option><option>Mobile</option><option>Management</option><option>Marketing</option></select></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Type</label><select class="form-select"><option>Full-time</option><option>Part-time</option><option>Contract</option></select></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Location</label><select class="form-select"><option>Remote</option><option>Hybrid</option><option>On-site</option></select></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Status</label><select class="form-select"><option>Active</option><option>Inactive</option></select></div>
                        <div class="col-12"><label class="form-label fw-semibold">Job Description</label><textarea class="form-control" rows="4" placeholder="Describe the role, responsibilities, and requirements..."></textarea></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Job</button>
            </div>
        </div>
    </div>
</div>

@endsection
