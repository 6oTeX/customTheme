<?php get_header(); ?>
<div id="main">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
    ?>
            <article class="post">
                <header>
                    <div class="title">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                    <div class="meta">
                        <time class="published"><?php the_time('F j, Y'); ?></time>
                        <a href="#" class="author"><span class="name"><?php the_author(); ?></span></a>
                    </div>
                </header>
                <a href="<?php the_permalink(); ?>" class="image featured"><?php the_post_thumbnail(); ?></a>
                <footer>
                    <ul class="actions">
                        <li><a href="<?php the_permalink(); ?>" class="button large">Continue Reading</a></li>
                    </ul>
                </footer>
            </article>
    <?php
        endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>
</div>
<?php get_footer(); ?>
