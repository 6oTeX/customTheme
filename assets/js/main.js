(function ($) {
  var $window = $(window),
    $body = $("body"),
    $menu = $("#menu"),
    $sidebar = $("#sidebar"),
    $main = $("#main");

  // -----------------------------------------
  // 1. Breakpoints
  // -----------------------------------------
  breakpoints({
    xlarge: ["1281px", "1680px"],
    large: ["981px", "1280px"],
    medium: ["737px", "980px"],
    small: ["481px", "736px"],
    xsmall: [null, "480px"],
  });

  // -----------------------------------------
  // 2. Initial page load: remove "is-preload"
  // -----------------------------------------
  $window.on("load", function () {
    window.setTimeout(function () {
      $body.removeClass("is-preload");
    }, 100);
  });

  // -----------------------------------------
  // 3. Menu (rewritten)
  // -----------------------------------------
  // Instead of using .panel(), we'll just listen for a click
  // on a link referencing "#menu" and toggle a class on #menu itself.

  // Example CSS approach:
  // #menu { transform: translateX(25em); visibility: hidden; transition: 0.5s; }
  // #menu.is-menu-visible { transform: translateX(0); visibility: visible; }

  // Whenever a user clicks an element with href="#menu"
  // we toggle the "is-menu-visible" class on the #menu element.
  $(document).on("click", '[href="#menu"]', function (event) {
    event.preventDefault();

    // Toggle the class on #menu
    if ($menu.hasClass("is-menu-visible")) {
      $menu.removeClass("is-menu-visible");
    } else {
      $menu.addClass("is-menu-visible");
    }
  });

  // -----------------------------------------
  // 4. Search (header)
  // -----------------------------------------
  var $search = $("#search"),
    $search_input = $search.find("input");

  $body.on("click", '[href="#search"]', function (event) {
    event.preventDefault();

    // Not visible?
    if (!$search.hasClass("visible")) {
      // Reset form
      $search[0].reset();

      // Show the search
      $search.addClass("visible");

      // Focus the input field
      $search_input.focus();
    }
  });

  $search_input
    .on("keydown", function (event) {
      // Press ESC to blur the input
      if (event.keyCode === 27) {
        $search_input.blur();
      }
    })
    .on("blur", function () {
      // Hide after a brief delay
      window.setTimeout(function () {
        $search.removeClass("visible");
      }, 100);
    });

  // -----------------------------------------
  // 5. Intro
  // -----------------------------------------
  var $intro = $("#intro");

  // Move #intro to #main on <= large, back to #sidebar on > large.
  breakpoints.on("<=large", function () {
    $intro.prependTo($main);
  });

  breakpoints.on(">large", function () {
    $intro.prependTo($sidebar);
  });
})(jQuery);
