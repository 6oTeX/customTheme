<?php get_header(); ?>

<!-- Main -->
<div id="main">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <!-- Post -->
            <article class="post">
                <header>
                    <div class="title">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <div class="meta">
                        <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author">
                            <span class="name"><?php the_author(); ?></span>
                            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                        </a>
                    </div>
                </header>
                <span class="image featured">
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full');
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/images/default.jpg" alt="" />';
                    }
                    ?>
                </span>
                <?php the_content(); ?>
                <footer>
                    <ul class="stats">
                        <li><?php the_category(', '); ?></li>
                        <li><a href="#" class="icon solid fa-heart">28</a></li> <!-- Placeholder for likes -->
                        <li><a href="<?php comments_link(); ?>" class="icon solid fa-comment"><?php comments_number('0', '1', '%'); ?></a></li>
                    </ul>
                </footer>
            </article>

        <?php endwhile; ?>
    <?php else : ?>
        <p>No content found.</p>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
