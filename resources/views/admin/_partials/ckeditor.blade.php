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
                            'fontSize', 'fontColor', 'fontBackgroundColor', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                            'alignment', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'horizontalLine', 'codeBlock', 'code', '|',
                            'undo', 'redo'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    removePlugins: [
                        'AIAssistant', 'MultiLevelList', 'CKBox', 'CKFinder', 'EasyImage',
                        'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments',
                        'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination',
                        'WProofreader', 'MathType', 'SlashCommand', 'Template', 'DocumentOutline',
                        'FormatPainter', 'TableOfContents', 'PasteFromOfficeEnhanced', 'CaseChange',
                        'ExportPdf', 'ExportWord', 'ImportWord'
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
                    fontSize: {
                        options: [10, 12, 'default', 16, 18, 20, 24, 28, 32, 36]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn', 'tableRow', 'mergeTableCells',
                            'tableProperties', 'tableCellProperties'
                        ]
                    },
                    image: {
                        toolbar: [
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side',
                            '|',
                            'toggleImageCaption',
                            'imageTextAlternative'
                        ]
                    },
                    placeholder: 'Start writing your content here...',
                    licenseKey: '',
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
        min-height: 320px !important;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .ck-editor__editable h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 1.25rem 0 0.75rem;
    }

    .ck-editor__editable h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 1rem 0 0.6rem;
    }

    .ck-editor__editable h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0.9rem 0 0.5rem;
    }

    .ck-editor__editable p {
        margin-bottom: 0.9rem;
    }

    .ck-editor__editable ul,
    .ck-editor__editable ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .ck-editor__editable li {
        margin-bottom: 0.35rem;
    }

    .ck-editor__editable blockquote {
        border-left: 4px solid #696cff;
        padding: 0.75rem 1rem;
        margin: 1rem 0;
        background: rgba(105, 108, 255, 0.05);
        border-radius: 0 6px 6px 0;
        font-style: italic;
    }

    .ck-editor__editable table {
        border-collapse: collapse;
        width: 100%;
        margin: 1rem 0;
    }

    .ck-editor__editable table th,
    .ck-editor__editable table td {
        border: 1px solid #ddd;
        padding: 0.5rem 0.75rem;
    }

    .ck-editor__editable table th {
        background: #696cff;
        color: #fff;
        font-weight: 600;
    }

    .ck-editor__editable code {
        background: rgba(0, 0, 0, 0.06);
        padding: 0.12em 0.4em;
        border-radius: 4px;
        font-family: monospace;
        font-size: 0.88em;
    }

    .ck-editor__editable pre {
        background: #1c1c25;
        color: #e8e8e8;
        padding: 1rem;
        border-radius: 8px;
        overflow-x: auto;
        margin: 1rem 0;
    }
</style>