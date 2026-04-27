@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Inquiries')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Contact Inquiries <span class="badge bg-danger ms-2">{{ $unreadCount }} unread</span></h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <form method="GET" class="row g-3">
                        <div class="col-auto"><input type="text" name="search" class="form-control"
                                placeholder="Search name/email..." value="{{ request('search') }}"></div>
                        <div class="col-auto">
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                        </div>
                        <div class="col-auto">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Per Page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Per Page</option>
                        </select>
                    </div>
                    <div class="col-auto"><button type="submit" class="btn btn-outline-primary"><i
                                    class="bx bx-search"></i></button></div>
                    </form>
                    <div>
                        <button type="button" class="btn btn-danger me-2" id="bulkDeleteBtn" style="display: none;">
                            <i class="bx bx-trash me-1"></i> Delete Selected
                        </button>
                        <form action="{{ route('admin.inquiries.delete-all') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete ALL inquiries? This action cannot be undone.')">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bx bx-trash-alt me-1"></i> Delete All
                            </button>
                        </form>
                    </div>
                </div>

                <form id="bulkDeleteForm" action="{{ route('admin.inquiries.bulk-delete') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr class="{{ !$item->is_read ? 'table-warning' : '' }}">
                                    <td><input type="checkbox" value="{{ $item->id }}" class="form-check-input inquiry-checkbox"></td>
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Str::limit($item->subject, 30) }}</td>
                                    <td><span
                                            class="badge bg-label-{{ $item->is_read ? 'success' : 'warning' }}">{{ $item->is_read ? 'Read' : 'New' }}</span>
                                    </td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.inquiries.show', $item) }}"
                                            class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>
                                        <form action="{{ route('admin.inquiries.destroy', $item) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">No inquiries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $items->links() }}
            </div>
        </div>
@endsection

@push('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.inquiry-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');

        function toggleBulkDeleteBtn() {
            const checkedCount = document.querySelectorAll('.inquiry-checkbox:checked').length;
            bulkDeleteBtn.style.display = checkedCount > 0 ? 'inline-block' : 'none';
        }

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                toggleBulkDeleteBtn();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const allChecked = document.querySelectorAll('.inquiry-checkbox:checked').length === checkboxes.length;
                if(selectAll) selectAll.checked = allChecked;
                toggleBulkDeleteBtn();
            });
        });

        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete the selected inquiries? This action cannot be undone.')) {
                    // clear old hidden inputs if any just in case
                    bulkDeleteForm.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
                    
                    const checked = document.querySelectorAll('.inquiry-checkbox:checked');
                    checked.forEach(cb => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = cb.value;
                        bulkDeleteForm.appendChild(input);
                    });
                    bulkDeleteForm.submit();
                }
            });
        }
    });
</script>
@endpush