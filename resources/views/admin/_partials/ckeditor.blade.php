{{-- CKEditor 5 CDN - Super Build (Includes Source Editing & Code Block) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.ckeditor').forEach(function (element) {
            CKEDITOR.ClassicEditor
                .create(element, {
                    toolbar: {
                        items: [
                            'sourceEditing', '|',
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'code', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'insertImage', 'blockQuote', 'insertTable', 'codeBlock', '|',
                            'undo', 'redo'
                        ]
                    },
                    removePlugins: [
                        'AIAssistant', 'MultiLevelList', 'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments', 'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination', 'WProofreader', 'MathType', 'SlashCommand', 'Template', 'DocumentOutline', 'FormatPainter', 'TableOfContents', 'PasteFromOfficeEnhanced', 'CaseChange', 'ExportPdf', 'ExportWord', 'ImportWord'
                    ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                        ]
                    },
                    placeholder: 'Start writing...',
                    licenseKey: '',
                })
                .then(editor => {
                    // Sync CKEditor content to textarea before form submit
                    const form = element.closest('form');
                    if (form) {
                        form.addEventListener('submit', function () {
                            // Update textarea with the latest HTML content from the editor window
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