jQuery(document).ready(function ($) {
  var typingTimer;
  var typingInterval = 500; // 0.5 second debounce

  $("#live-search").on("input", function () {
    clearTimeout(typingTimer);
    var query = $(this).val().trim();

    typingTimer = setTimeout(function () {
      $.ajax({
        url: liveSearchSettings.ajaxurl,
        type: "POST",
        dataType: "html",
        data: {
          action: "greentech_live_search",
          search: query,
          nonce: liveSearchSettings.nonce,
        },
        success: function (response) {
          // Replace the main content area with the results
          $("#main").html(response);
        },
        error: function (error) {
          console.error("AJAX Error:", error);
        },
      });
    }, typingInterval);
  });
});
