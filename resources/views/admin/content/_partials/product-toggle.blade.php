{{-- Reusable product toggle partial --}}
{{-- Usage: @include('admin.content._partials.product-toggle', ['item' => $item, 'route' =>
'admin.projects.toggle-product']) --}}
<form action="{{ route($route, $item->id) }}" method="POST" class="d-inline product-toggle-form">
    @csrf
    <button type="submit" class="btn btn-sm toggle-btn {{ $item->is_product ? 'btn-info' : 'btn-secondary' }}"
        title="Toggle product status">
        <i class="bx icon-state {{ $item->is_product ? 'bx-shopping-bag' : 'bx-x-circle' }}"></i>
        <span class="text-state">{{ $item->is_product ? 'Product' : 'Service/Product' }}</span>
    </button>
</form>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Using event delegation or specific class to avoid conflicts with status-toggle if needed
            // But since we use .product-toggle-form, it should be fine.
            document.addEventListener('submit', function (e) {
                if (e.target.classList.contains('product-toggle-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const btn = form.querySelector('.toggle-btn');
                    const icon = form.querySelector('.icon-state');
                    const text = form.querySelector('.text-state');
                    const originalHtml = btn.innerHTML;

                    btn.disabled = true;

                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (data.is_product) {
                                    btn.classList.remove('btn-secondary');
                                    btn.classList.add('btn-info');
                                    icon.classList.remove('bx-x-circle');
                                    icon.classList.add('bx-shopping-bag');
                                    text.textContent = 'Product';
                                } else {
                                    btn.classList.remove('btn-info');
                                    btn.classList.add('btn-secondary');
                                    icon.classList.remove('bx-shopping-bag');
                                    icon.classList.add('bx-x-circle');
                                    text.textContent = 'Service/Product';
                                }
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
                }
            });
        });
    </script>
@endonce