jQuery(document).ready(function($) {
    var typingTimer;
    var typingInterval = 500; // Time in ms (0.5 seconds)

    $('#live-search').on('input', function() {
        clearTimeout(typingTimer);
        var query = $(this).val();

        typingTimer = setTimeout(function() {
            // Send AJAX request to update posts
            $.ajax({
                url: liveSearchSettings.ajaxurl,
                type: 'POST',
                dataType: 'html',
                data: {
                    action: 'greentech_live_search',
                    search: query,
                    nonce: liveSearchSettings.nonce,
                },
                success: function(response) {
                    // Update the main posts area with the response HTML
                    $('#main').html(response);
                },
                error: function(error) {
                    console.log('AJAX Error:', error);
                },
            });
        }, typingInterval);
    });
});
