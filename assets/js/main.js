(function ($) {
  var $window = $(window),
    $body = $("body"),
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

function toggleMenu() {
  const menu = document.getElementById("hidden-menu");
  const overlay = document.getElementById("menu-overlay");

  menu.classList.toggle("active");
  overlay.classList.toggle("active");
}

// Close menu when clicking the overlay
document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.createElement("div");
  overlay.id = "menu-overlay";
  document.body.appendChild(overlay);

  overlay.addEventListener("click", function () {
    toggleMenu();
  });
});
