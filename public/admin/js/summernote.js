$(document).ready(function() {
    // Default Summernote configuration
    const defaultConfig = {
        placeholder: 'Enter content here...',
        tabsize: 2,
        height: 200,
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
                // Handle image uploads if needed
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i], $(this));
                }
            }
        }
    };

    // List of textarea IDs/classes that should NOT use Summernote (plain text fields)
    const excludeSelectors = [
        '#json', 
        '[data-plain-text="true"]',
        '[data-no-editor="true"]',
        'textarea[name*="json"]',
        'textarea[name*="JSON"]',
        'textarea[name*="points"]', // JSON array fields
        'textarea[name*="benefits"]', // JSON array fields
        'textarea[name*="programs"]', // JSON array fields
        'textarea[name*="publications"]', // JSON array fields
        'textarea[name*="training"]', // JSON array fields
        'textarea[name*="exchange"]', // JSON array fields
        'textarea[name*="events"]', // JSON array fields
        'textarea[name*="identity"]', // JSON array fields
        'textarea[name*="streams"]', // JSON array fields
        'textarea[name*="achievements"]', // JSON array fields
        'textarea[name*="stats"]', // JSON array fields
        'textarea[name*="impact_stats"]' // JSON array fields
    ];

    // Function to check if a textarea should be excluded
    function shouldExclude(textarea) {
        const $textarea = $(textarea);
        const name = ($textarea.attr('name') || '').toLowerCase();
        const id = ($textarea.attr('id') || '').toLowerCase();
        
        // Check if it has exclude attributes
        if ($textarea.data('plain-text') === true || $textarea.data('no-editor') === true) {
            return true;
        }
        
        // Check against exclude selectors
        for (let selector of excludeSelectors) {
            if ($textarea.is(selector)) {
                return true;
            }
        }
        
        // Check if name contains specific JSON array field patterns
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

    // Initialize Summernote on all textareas except excluded ones
    $('textarea').each(function() {
        const $textarea = $(this);
        
        // Skip if already initialized
        if ($textarea.next('.note-editor').length > 0 || $textarea.data('summernote')) {
            return;
        }
        
        if (shouldExclude($textarea)) {
            return;
        }
        
        // Only initialize if textarea is visible
        if ($textarea.is(':visible')) {
            try {
                $textarea.summernote(defaultConfig);
            } catch(e) {
                console.log('Summernote initialization skipped for:', $textarea.attr('name') || $textarea.attr('id'));
            }
        }
    });

    // Handle dynamically added textareas (e.g., in modals or tabs)
    $(document).on('shown.bs.tab', function() {
        setTimeout(function() {
            $('textarea').each(function() {
                const $textarea = $(this);
                
                // Check if already initialized
                if ($textarea.next('.note-editor').length > 0 || $textarea.data('summernote')) {
                    return;
                }
                
                if (shouldExclude($textarea)) {
                    return;
                }
                
                // Only initialize if textarea is visible
                if ($textarea.is(':visible')) {
                    try {
                        $textarea.summernote(defaultConfig);
                    } catch(e) {
                        console.log('Summernote initialization skipped for:', $textarea.attr('name') || $textarea.attr('id'));
                    }
                }
            });
        }, 100);
    });

    // Function to handle image uploads (optional - can be customized)
    function uploadImage(file, $editor) {
        const data = new FormData();
        data.append('file', file);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        
        $.ajax({
            url: '/admin/media/upload', // Adjust this route as needed
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

    // Ensure Summernote content is saved before form submission
    $('form').on('submit', function() {
        $(this).find('textarea').each(function() {
            const $textarea = $(this);
            // Check if Summernote is initialized on this textarea
            if ($textarea.next('.note-editor').length > 0 || $textarea.data('summernote')) {
                try {
                    // Get the HTML content from Summernote and set it to the textarea
                    const content = $textarea.summernote('code');
                    $textarea.val(content);
                } catch(e) {
                    console.log('Error getting Summernote content:', e);
                }
            }
        });
    });
});
