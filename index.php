<?php get_header(); ?>

<!-- Main -->
<div id="main">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <!-- Post -->
            <article class="post">
                <header>
                    <div class="title">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="meta">
                        <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author">
                            <span class="name"><?php the_author(); ?></span>
                            <?php echo get_avatar(get_the_author_meta('ID'), 96); ?>
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
                        <li><a href="<?php comments_link(); ?>" class="icon solid fa-comment"><?php comments_number('0', '1', '%'); ?></a></li>
                    </ul>
                </footer>
            </article>

        <?php endwhile; ?>

        <!-- Pagination -->
        <ul class="actions pagination">
            <li><?php previous_posts_link('<span class="button large previous">Previous Page</span>'); ?></li>
            <li><?php next_posts_link('<span class="button large next">Next Page</span>'); ?></li>
        </ul>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>

</div>

<?php get_sidebar(); ?>
