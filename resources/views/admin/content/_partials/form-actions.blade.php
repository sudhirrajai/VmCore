<div class="sticky-bottom-bar mt-4" style="z-index: 10;">
    <div class="card shadow-lg border-top border-primary rounded-0 rounded-bottom">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-none d-md-block">
                    <p class="mb-0 text-muted small"><i class="bx bx-info-circle me-1"></i> Review your changes before saving.</p>
                </div>
                <div class="ms-auto d-flex gap-2 align-items-center">
                    @if(isset($buttons))
                        {!! $buttons !!}
                    @else
                        @if(isset($back_route))
                            <a href="{{ $back_route }}" class="btn btn-outline-secondary">Cancel</a>
                        @endif
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bx bx-save me-1"></i> {{ $label ?? 'Save Changes' }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
