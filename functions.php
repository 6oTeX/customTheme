<?php
function greentech_setup() {
    // Featured images
    add_theme_support('post-thumbnails');

    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'greentech'),
    ));
}
add_action('after_setup_theme', 'greentech_setup');

/**
 * Enqueue scripts and styles.
 */
function greentech_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // Enqueue custom Sass/CSS
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/sass/main.css');

    // Enqueue jQuery from WordPress
    wp_enqueue_script('jquery');

    // Enqueue main.js for menu toggling
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_scripts');

/**
 * Remove width/height attributes from post thumbnails.
 */
function greentech_remove_thumbnail_dimensions($html, $post_id, $post_image_id) {
    // Removes inline width/height attributes
    return preg_replace('/(width|height)="\d*"\s/', '', $html);
}
add_filter('post_thumbnail_html', 'greentech_remove_thumbnail_dimensions', 10, 3);