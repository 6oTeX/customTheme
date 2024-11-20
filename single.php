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
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </header>
                <span class="image featured"><?php the_post_thumbnail(); ?></span>
                <p><?php the_content(); ?></p>
            </article>
    <?php
        endwhile;
    endif;
    ?>
</div>
<?php get_footer(); ?>
