{{-- Reusable status toggle partial --}}
{{-- Usage: @include('admin.content._partials.status-toggle', ['item' => $item, 'route' =>
'admin.services.toggle-status']) --}}
<form action="{{ route($route, $item->id) }}" method="POST" class="d-inline status-toggle-form">
    @csrf
    <button type="submit" class="btn btn-sm toggle-btn {{ $item->status ? 'btn-success' : 'btn-secondary' }}"
        title="Toggle status">
        <i class="bx icon-state {{ $item->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
        <span class="text-state">{{ $item->status ? 'Active' : 'Inactive' }}</span>
    </button>
</form>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.status-toggle-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const btn = this.querySelector('.toggle-btn');
                    const icon = this.querySelector('.icon-state');
                    const text = this.querySelector('.text-state');
                    const originalHtml = btn.innerHTML;

                    btn.disabled = true;

                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (data.status) {
                                    btn.classList.remove('btn-secondary');
                                    btn.classList.add('btn-success');
                                    icon.classList.remove('bx-x-circle');
                                    icon.classList.add('bx-check-circle');
                                    text.textContent = 'Active';
                                } else {
                                    btn.classList.remove('btn-success');
                                    btn.classList.add('btn-secondary');
                                    icon.classList.remove('bx-check-circle');
                                    icon.classList.add('bx-x-circle');
                                    text.textContent = 'Inactive';
                                }

                                // Optional: Show a subtle toast or message if desired
                            } else {
                                alert(data.message || 'An error occurred.');
                                btn.innerHTML = originalHtml;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('A network error occurred.');
                            btn.innerHTML = originalHtml;
                        })
                        .finally(() => {
                            btn.disabled = false;
                        });
                });
            });
        });
    </script>
@endonce