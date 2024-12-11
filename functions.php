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
    wp_enqueue_script('live-search-script', get_template_directory_uri() . '/assets/js/live-search.js', array('jquery'), null, true);

      // Localize script to pass AJAX URL and nonce
      wp_localize_script('live-search-script', 'liveSearchSettings', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('live-search-nonce'),
    ));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_scripts');

// Remove width and height attributes from post thumbnails
function greentech_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    // Remove width and height attributes
    $html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'greentech_remove_thumbnail_dimensions', 10, 3 );


// AJAX handler for live search
function greentech_live_search() {
    check_ajax_referer('live-search-nonce', 'nonce');

    $search_query = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    // Get the current page number if pagination is needed
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Custom query arguments
    $args = array(
        'posts_per_page'      => 4,
        'post_type'           => 'post',
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
        's'                   => $search_query,
    );

    // The Query
    $posts_query = new WP_Query($args);

    // Start output buffering to capture the template output
    ob_start();

    if ($posts_query->have_posts()) :
        while ($posts_query->have_posts()) : $posts_query->the_post();
            // Include the template part for displaying posts
            get_template_part('content', 'post'); // We'll create this template part next
        endwhile;

        // Include pagination if needed
        // (Optional) Include pagination code here if you want to handle pagination in the AJAX response

    else :
        echo '<p>No posts found.</p>';
    endif;

    wp_reset_postdata();

    $response = ob_get_clean();

    echo $response;

    wp_die();
}
add_action('wp_ajax_greentech_live_search', 'greentech_live_search');
add_action('wp_ajax_nopriv_greentech_live_search', 'greentech_live_search');
