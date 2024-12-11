(function ($) {
  var $body = $("body"),
    $menu = $("#menu");

  // Toggle menu visibility when the menu button is clicked
  $body.on("click", ".fa-bars", function (event) {
    event.preventDefault();
    $body.toggleClass("is-menu-visible");
  });

  // Hide menu when clicking outside of it
  $(document).on("click", function (event) {
    if (
      $body.hasClass("is-menu-visible") &&
      !$(event.target).closest("#menu, .fa-bars").length
    ) {
      $body.removeClass("is-menu-visible");
    }
  });

  // Hide menu on Escape key press
  $(document).on("keydown", function (event) {
    if (event.key === "Escape" && $body.hasClass("is-menu-visible")) {
      $body.removeClass("is-menu-visible");
    }
  });
})(jQuery);
