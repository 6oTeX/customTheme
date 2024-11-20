<?php
function greentech_enqueue_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_scripts');

function greentech_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'greentech'),
    ));
}
add_action('init', 'greentech_register_menus');
?>
