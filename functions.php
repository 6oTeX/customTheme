<?php
function greentech_setup() {
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'greentech'),
    ));
}
add_action('after_setup_theme', 'greentech_setup');

function greentech_enqueue_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());

    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/sass/main.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('live-search-script', get_template_directory_uri() . '/assets/js/live-search.js', array('jquery'), null, true);

      wp_localize_script('live-search-script', 'liveSearchSettings', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('live-search-nonce'),
    ));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_scripts');

function greentech_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
    return $html;
}

add_filter( 'post_thumbnail_html', 'greentech_remove_thumbnail_dimensions', 10, 3 );


add_action('wp_ajax_greentech_live_search', 'greentech_live_search');
add_action('wp_ajax_nopriv_greentech_live_search', 'greentech_live_search');

function greentech_live_search() {
    check_ajax_referer('greentech_nonce', 'nonce');

    $query = sanitize_text_field($_POST['search']);

    $args = array(
        's' => $query,
        'posts_per_page' => 4,
        'post_type' => 'post',
    );

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            ?>
<article class="post">
    <header>
        <div class="title">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo get_the_excerpt(); ?></p>
        </div>
        <div class="meta">
            <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                <?php echo get_the_date(); ?>
            </time>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author">
                <span class="name"><?php the_author(); ?></span>
                <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
            </a>
        </div>
    </header>
    <a href="<?php the_permalink(); ?>" class="image featured">
        <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full');
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/images/default.jpg" alt="" />';
                    }
                    ?>
    </a>
    <p><?php the_excerpt(); ?></p>
    <footer>
        <ul class="actions">
            <li><a href="<?php the_permalink(); ?>" class="button large">Continue Reading</a></li>
        </ul>
        <ul class="stats">
            <li><?php the_category(', '); ?></li>
            <li><a href="#" class="icon solid fa-heart">28</a></li>
            <li><a href="<?php comments_link(); ?>" class="icon solid fa-comment">
                    <?php comments_number('0', '1', '%'); ?>
                </a></li>
        </ul>
    </footer>
</article>
<?php
        }
    } else {
        echo '<p>No results found.</p>';
    }
    wp_reset_postdata();
    wp_die();
}

function enqueue_live_search_script() {
    wp_enqueue_script('live-search', get_template_directory_uri() . '/js/live-search.js', array('jquery'), null, true);
    wp_localize_script('live-search', 'liveSearchSettings', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('greentech_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_live_search_script');