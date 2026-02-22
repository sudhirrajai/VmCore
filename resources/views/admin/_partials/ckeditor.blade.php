{{-- CKEditor 5 CDN - Classic Build (Free Open-Source) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.ckeditor').forEach(function (element) {
            ClassicEditor
                .create(element, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'blockQuote', 'insertTable', '|',
                            'undo', 'redo'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        ]
                    },
                    placeholder: 'Start writing...',
                })
                .then(editor => {
                    // Sync CKEditor content to textarea before form submit
                    const form = element.closest('form');
                    if (form) {
                        form.addEventListener('submit', function () {
                            element.value = editor.getData();
                        });
                    }
                })
                .catch(error => {
                    console.error('CKEditor init error:', error);
                });
        });
    });
</script>

<style>
    .ck-editor__editable {
        min-height: 200px !important;
    }
</style>