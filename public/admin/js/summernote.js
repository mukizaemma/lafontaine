$(document).ready(function() {
    const defaultConfig = {
        placeholder: 'Enter content here...',
        tabsize: 2,
        height: 220,
        dialogsInBody: true,
        followingToolbar: false,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear', 'fontsize', 'fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Times New Roman', 'Montserrat', 'Roboto', 'Open Sans'],
        fontNamesIgnoreCheck: ['Open Sans', 'Roboto'],
        lineHeights: ['0.5', '1.0', '1.5', '2.0', '3.0'],
        codemirror: false,
        enterHtml: '<br>',
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i], $(this));
                }
            }
        }
    };

    function configFor($textarea) {
        const cfg = $.extend(true, {}, defaultConfig);
        if ($textarea.attr('id') === 'description' || $textarea.hasClass('summernote-book')) {
            cfg.placeholder = 'Write a short book description...';
            cfg.height = 280;
        }
        if ($textarea.closest('.modal').length) {
            cfg.dialogsInBody = true;
            cfg.followingToolbar = false;
        }
        return cfg;
    }

    const excludeSelectors = [
        '#json',
        '[data-plain-text="true"]',
        '[data-no-editor="true"]',
        'textarea[name*="json"]',
        'textarea[name*="JSON"]',
        'textarea[name*="points"]',
        'textarea[name*="benefits"]',
        'textarea[name*="programs"]',
        'textarea[name*="publications"]',
        'textarea[name*="training"]',
        'textarea[name*="exchange"]',
        'textarea[name*="events"]',
        'textarea[name*="identity"]',
        'textarea[name*="streams"]',
        'textarea[name*="achievements"]',
        'textarea[name*="stats"]',
        'textarea[name*="impact_stats"]'
    ];

    function shouldExclude(textarea) {
        const $textarea = $(textarea);
        const name = ($textarea.attr('name') || '').toLowerCase();
        const id = ($textarea.attr('id') || '').toLowerCase();

        if ($textarea.data('plain-text') === true || $textarea.data('no-editor') === true) {
            return true;
        }

        for (let selector of excludeSelectors) {
            if ($textarea.is(selector)) {
                return true;
            }
        }

        const jsonFieldPatterns = [
            'points', 'benefits', 'programs', 'publications',
            'training', 'exchange', 'events', 'identity',
            'streams', 'achievements', 'stats', 'impact_stats',
            'why_french_points', 'why_french_benefits',
            'linguistic_programs', 'linguistic_publications',
            'linguistic_training', 'linguistic_exchange', 'linguistic_events',
            'methodology_points', 'sustainability_points',
            'partnership_benefits', 'education_streams',
            'company_identity'
        ];

        for (let pattern of jsonFieldPatterns) {
            if (name.includes(pattern) || id.includes(pattern)) {
                return true;
            }
        }

        return false;
    }

    function initSummernoteOnTextarea($textarea) {
        if ($textarea.next('.note-editor').length > 0 || $textarea.data('summernote')) {
            return;
        }
        if (shouldExclude($textarea)) {
            return;
        }
        if (!$textarea.is(':visible')) {
            return;
        }
        try {
            $textarea.summernote(configFor($textarea));
        } catch (e) {
            console.log('Summernote initialization skipped for:', $textarea.attr('name') || $textarea.attr('id'));
        }
    }

    function initSummernoteInContainer($container) {
        $container.find('textarea').each(function() {
            initSummernoteOnTextarea($(this));
        });
    }

    $('textarea').each(function() {
        initSummernoteOnTextarea($(this));
    });

    $(document).on('shown.bs.tab', function() {
        setTimeout(function() {
            $('textarea').each(function() {
                initSummernoteOnTextarea($(this));
            });
        }, 100);
    });

    $(document).on('shown.bs.modal', '.modal', function() {
        const $modal = $(this);
        setTimeout(function() {
            initSummernoteInContainer($modal);
        }, 150);
    });

    function uploadImage(file, $editor) {
        const data = new FormData();
        data.append('file', file);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: '/admin/media/upload',
            method: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.url) {
                    $editor.summernote('insertImage', response.url);
                }
            },
            error: function() {
                alert('Image upload failed');
            }
        });
    }

    $('form').on('submit', function() {
        $(this).find('textarea').each(function() {
            const $textarea = $(this);
            if ($textarea.next('.note-editor').length > 0 || $textarea.data('summernote')) {
                try {
                    const content = $textarea.summernote('code');
                    $textarea.val(content);
                } catch (e) {
                    console.log('Error getting Summernote content:', e);
                }
            }
        });
    });
});
