<?php get_header(); ?>

<!-- Main -->
<div id="main">

    <?php
    // Get the current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Custom query arguments
    $args = array(
        'posts_per_page'      => 4,
        'post_type'           => 'post',
        'ignore_sticky_posts' => 1,
        'paged'               => $paged,
    );

    // The Query
    $posts_query = new WP_Query($args);

    // Backup original query object
    global $wp_query;
    $temp_query = $wp_query;
    $wp_query   = $posts_query;
    
    // The Loop
    // if search query has post title matching the search query show only the post matching the search query
    if (is_search() && have_posts()) {
        while (have_posts()) : the_post();

            // Post
            get_template_part('content', 'search');

        endwhile;
    } else {
        // if search query has no post title matching the search query show all posts
        if (is_search()) {
            echo '<h2>Search results for: ' . get_search_query() . '</h2>';
        }
    }
    if ($posts_query->have_posts()) :
        while ($posts_query->have_posts()) : $posts_query->the_post();
    ?>

            <!-- Post -->
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
                        <li><a href="#" class="icon solid fa-heart">28</a></li> <!-- Placeholder for likes -->
                        <li><a href="<?php comments_link(); ?>" class="icon solid fa-comment">
                            <?php comments_number('0', '1', '%'); ?>
                        </a></li>
                    </ul>
                </footer>
            </article>

    <?php
        endwhile;
    ?>

        <!-- Pagination -->
        <ul class="actions pagination">
            <!-- Previous Page Link -->
            <li>
                <?php if (get_previous_posts_link()) : ?>
                    <?php previous_posts_link('<span class="button large previous">Previous Page</span>'); ?>
                <?php else : ?>
                    <span class="disabled button large previous">Previous Page</span>
                <?php endif; ?>
            </li>

            <!-- Next Page Link -->
            <li>
                <?php if (get_next_posts_link()) : ?>
                    <?php next_posts_link('<span class="button large next">Next Page</span>'); ?>
                <?php else : ?>
                    <span class="disabled button large next">Next Page</span>
                <?php endif; ?>
            </li>
        </ul>

    <?php
    else :
    ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <?php
    // Reset post data
    wp_reset_postdata();

    // Restore original query
    $wp_query = $temp_query;
    ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
