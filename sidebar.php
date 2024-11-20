<!-- Sidebar -->
<section id="sidebar">

    <!-- Intro -->
    <section id="intro">
        <header>
            <h2><?php bloginfo('name'); ?></h2>
            <p><?php bloginfo('description'); ?></p>
        </header>
    </section>

    <!-- Mini Posts -->
    <section>
        <div class="mini-posts">
            <?php
            $mini_posts = new WP_Query(array(
                'posts_per_page' => 4,
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,
            ));
            if ($mini_posts->have_posts()) :
                while ($mini_posts->have_posts()) : $mini_posts->the_post();
            ?>
                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author">
                            <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                        </a>
                    </header>
                    <a href="<?php the_permalink(); ?>" class="image">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/images/default-thumb.jpg" alt="" />';
                        }
                        ?>
                    </a>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>

    <!-- Posts List -->
    <section>
        <ul class="posts">
            <?php
            $recent_posts = new WP_Query(array(
                'posts_per_page' => 5,
                'offset' => 4, // Skip the ones already displayed
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,
            ));
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>
                <li>
                    <article>
                        <header>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <time class="published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        </header>
                        <a href="<?php the_permalink(); ?>" class="image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('thumbnail');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/images/default-thumb.jpg" alt="" />';
                            }
                            ?>
                        </a>
                    </article>
                </li>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </section>

    <!-- About -->
    <section class="blurb">
        <h2>About</h2>
        <p>
            <?php
            $about_page = get_page_by_title('About');
            if ($about_page) {
                echo wp_trim_words($about_page->post_content, 40, '...');
            } else {
                echo 'Welcome to GreenTech Solutions!';
            }
            ?>
        </p>
        <ul class="actions">
            <?php if ($about_page) : ?>
                <li><a href="<?php echo get_permalink($about_page->ID); ?>" class="button">Learn More</a></li>
            <?php endif; ?>
        </ul>
    </section>

    <!-- Footer -->
    <?php get_footer(); ?>


</section>
