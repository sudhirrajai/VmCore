@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Newsletters')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span>Newsletter /</span> Campaigns</h4>
            <a href="{{ route('admin.newsletter.newsletters.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Create Newsletter
            </a>
        </div>


        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Scheduled For</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($newsletters as $newsletter)
                            <tr>
                                <td><strong>{{ Str::limit($newsletter->subject, 40) }}</strong></td>
                                <td>{{ $newsletter->creator->name ?? 'System' }}</td>
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
                                <td>{{ $newsletter->scheduled_at ? $newsletter->scheduled_at->format('M d, Y h:i A') : '-' }}
                                </td>
                                <td>{{ $newsletter->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(in_array($newsletter->status, ['draft', 'scheduled']))
                                            <a class="btn btn-sm btn-outline-primary"
                                                href="{{ route('admin.newsletter.newsletters.edit', $newsletter) }}" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.newsletter.newsletters.sendNow', $newsletter) }}"
                                                method="POST" class="d-inline-block"
                                                onsubmit="return confirm('Send this newsletter immediately to all active subscribers?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="Send Now">
                                                    <i class="bx bx-send"></i>
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.newsletter.newsletters.destroy', $newsletter) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn"
                                                title="Delete" {{ $newsletter->status === 'sending' ? 'disabled' : '' }}>
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No newsletters found.</td>
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