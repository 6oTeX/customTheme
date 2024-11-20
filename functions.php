<?php
function greentech_setup() {
    // Add theme support for featured images
    add_theme_support('post-thumbnails');

    // Register nav menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'greentech'),
    ));
}
add_action('after_setup_theme', 'greentech_setup');

function greentech_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // Enqueue custom stylesheet
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/sass/main.css');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_scripts');
