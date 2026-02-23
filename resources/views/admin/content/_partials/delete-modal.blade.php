<!-- Delete Confirmation Modal -->
<div class="modal fade" id="globalDeleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="globalDeleteConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="globalConfirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let globalDeleteFormToSubmit = null;
            const globalDeleteModalElement = document.getElementById('globalDeleteConfirmModal');
            let globalDeleteModal = null;

            if (globalDeleteModalElement) {
                globalDeleteModal = new bootstrap.Modal(globalDeleteModalElement);
            }

            document.body.addEventListener('click', function (e) {
                const button = e.target.closest('.global-delete-btn');
                if (button) {
                    e.preventDefault();
                    globalDeleteFormToSubmit = button.closest('form');
                    if (globalDeleteModal) {
                        globalDeleteModal.show();
                    } else {
                        if (confirm('Are you sure you want to delete this item?')) {
                            globalDeleteFormToSubmit.submit();
                        }
                    }
                }
            });

            const globalConfirmBtn = document.getElementById('globalConfirmDeleteBtn');
            if (globalConfirmBtn) {
                globalConfirmBtn.addEventListener('click', function () {
                    if (globalDeleteFormToSubmit) {
                        globalDeleteFormToSubmit.submit();
                    }
                });
            }
        });
    </script>
@endpush