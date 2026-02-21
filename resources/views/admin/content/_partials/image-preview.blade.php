{{-- Reusable image preview partial --}}
{{-- Usage: @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $model->image ?? null])
--}}
@php $fieldName = $field ?? 'image'; @endphp

<div class="mb-3">
    <label class="form-label" for="{{ $fieldName }}">{{ ucfirst(str_replace('_', ' ', $fieldName)) }}</label>
    <input type="file" class="form-control" id="{{ $fieldName }}" name="{{ $fieldName }}" accept="image/*"
        onchange="previewImage(this, '{{ $fieldName }}_preview')">

    @if (!empty($existing))
        <div id="{{ $fieldName }}_preview" class="mt-2">
            <img src="{{ asset($existing) }}" alt="Current" class="img-thumbnail" style="max-height:150px;">
        </div>
    @else
        <div id="{{ $fieldName }}_preview" class="mt-2"></div>
    @endif
</div>

@once
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="img-thumbnail" style="max-height:150px;">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endonce