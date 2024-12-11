jQuery(document).ready(function($) {
    var typingTimer;
    var typingInterval = 500; 

    $('#live-search').on('input', function() {
        clearTimeout(typingTimer);
        var query = $(this).val();

        typingTimer = setTimeout(function() {
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
                    $('#main').html(response);
                },
                error: function(error) {
                    console.log('AJAX Error:', error);
                },
            });
        }, typingInterval);
    });
});
