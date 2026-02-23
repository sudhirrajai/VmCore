@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Newsletter Report')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Newsletter / History /</span> Report</h4>
            <a href="{{ route('admin.newsletter.newsletters.history') }}" class="btn btn-secondary">
                <i class="bx bx-left-arrow-alt me-1"></i> Back to History
            </a>
        </div>

        <!-- Overview Cards -->
        <div class="row mb-4">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="bx bx-envelope bx-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $newsletter->total_recipients }}</h4>
                        </div>
                        <p class="mb-1">Total Recipients</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success"><i
                                        class="bx bx-check-double bx-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $newsletter->logs()->where('status', 'sent')->count() }}</h4>
                        </div>
                        <p class="mb-1">Successfully Sent</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="bx bx-error bx-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $newsletter->logs()->where('status', 'failed')->count() }}</h4>
                        </div>
                        <p class="mb-1">Failed to Send</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="bx bx-time bx-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $newsletter->logs()->where('status', 'pending')->count() }}</h4>
                        </div>
                        <p class="mb-1">Pending Delivery</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriber Logs Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Delivery Details: "{{ $newsletter->subject }}"</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Subscriber Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Sent At</th>
                            <th>Error Message</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->subscriber->name ?? 'Unknown' }}</td>
                                <td>{{ $log->subscriber->email ?? 'Deleted User' }}</td>
                                <td>
                                    @if($log->status === 'sent')
                                        <span class="badge bg-label-success">Sent</span>
                                    @elseif($log->status === 'failed')
                                        <span class="badge bg-label-danger">Failed</span>
                                    @else
                                        <span class="badge bg-label-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $log->sent_at ? $log->sent_at->format('M d, Y H:i:s') : '-' }}</td>
                                <td class="text-danger"><small>{{ Str::limit($log->error_message, 50) }}</small></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No delivery logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
@endsection