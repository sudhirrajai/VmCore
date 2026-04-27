@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Edit Newsletter')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Newsletter / Campaigns /</span> Edit</h4>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Newsletter Setup</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter.newsletters.update', $newsletter) }}" method="POST"
                            id="newsletterForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label" for="subject">Subject <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="subject" name="subject" value="{{ old('subject', $newsletter->subject) }}"
                                        required>
                                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="template_id">Use Template (Optional)</label>
                                    <select id="template_id" name="template_id"
                                        class="form-select @error('template_id') is-invalid @enderror"
                                        onchange="loadTemplate()">
                                        <option value="">-- Choose a template --</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}"
                                                data-html="{{ htmlspecialchars($template->html_structure) }}" {{ old('template_id', $newsletter->template_id) == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('template_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="content">Email Content <span
                                        class="text-danger">*</span></label>
                                <textarea id="content" name="content"
                                    class="form-control @error('content') is-invalid @enderror">{{ old('content', $newsletter->content) }}</textarea>
                                @error('content')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="scheduled_at">Schedule For (Optional)</label>
                                    <input type="datetime-local"
                                        class="form-control @error('scheduled_at') is-invalid @enderror" id="scheduled_at"
                                        name="scheduled_at"
                                        value="{{ old('scheduled_at', $newsletter->scheduled_at ? $newsletter->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                                    <div class="form-text">Leave blank to keep as draft or send immediately.</div>
                                    @error('scheduled_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            @include('admin.content._partials.form-actions', [
                                'buttons' => '
                                    <button type="submit" name="action" value="draft" class="btn btn-secondary">Save Draft</button>
                                    <button type="submit" name="action" value="schedule" class="btn btn-info" onclick="return validateSchedule()">Schedule</button>
                                    <button type="submit" name="action" value="send_now" class="btn btn-success" onclick="return confirm(\'Send this immediately to all subscribers?\')">Send Now</button>
                                    <a href="' . route('admin.newsletter.newsletters.index') . '" class="btn btn-outline-secondary ms-auto">Cancel</a>
                                '
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        let editorInstance;

        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#content'), {
                    licenseKey: '',
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'insertTable', 'mediaEmbed', 'undo', 'redo', 'imageUpload'],
                })
                .then(editor => {
                    editorInstance = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        });

        function loadTemplate() {
            const select = document.getElementById('template_id');
            const selectedOption = select.options[select.selectedIndex];
            if (selectedOption.value !== "") {
                const html = selectedOption.getAttribute('data-html');
                if (editorInstance && html) {
                    if (confirm('Load template content? This will overwrite your current editor content.')) {
                        editorInstance.setData(html);
                    } else {
                        select.value = "";
                    }
                }
            }
        }

        function validateSchedule() {
            if (!document.getElementById('scheduled_at').value) {
                alert('Please select a Date & Time to schedule.');
                return false;
            }
            return true;
        }
    </script>
@endsection