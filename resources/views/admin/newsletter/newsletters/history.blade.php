@extends('admin.layouts.contentNavbarLayout')

@section('title', 'History')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span>Newsletter /</span> History</h4>
        </div>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Recipients</th>
                            <th class="text-success"><i class="bx bx-check"></i> Sent</th>
                            <th class="text-danger"><i class="bx bx-error-circle"></i> Failed</th>
                            <th>Scheduled</th>
                            <th>Sent Time</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($newsletters as $newsletter)
                            <tr>
                                <td><strong>{{ Str::limit($newsletter->subject, 30) }}</strong></td>
                                <td>
                                    @if($newsletter->status === 'draft')
                                        <span class="badge bg-label-secondary">Draft</span>
                                    @elseif($newsletter->status === 'scheduled')
                                        <span class="badge bg-label-info">Scheduled</span>
                                    @elseif($newsletter->status === 'sending')
                                        <span class="badge bg-label-warning">Sending</span>
                                    @elseif($newsletter->status === 'sent')
                                        <span class="badge bg-label-success">Sent</span>
                                    @else
                                        <span class="badge bg-label-danger">Failed</span>
                                    @endif
                                </td>
                                <td>{{ $newsletter->total_recipients }}</td>
                                <td><span class="text-success fw-bold">{{ $newsletter->sent_count }}</span></td>
                                <td><span class="text-danger fw-bold">{{ $newsletter->failed_count }}</span></td>
                                <td>{{ $newsletter->scheduled_at ? $newsletter->scheduled_at->format('M d, Y H:i') : '-' }}</td>
                                <td>{{ $newsletter->sent_at ? $newsletter->sent_at->format('M d, Y H:i') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.newsletter.newsletters.report', $newsletter) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        View Report
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">No history records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $newsletters->links() }}
        </div>
    </div>
@endsection