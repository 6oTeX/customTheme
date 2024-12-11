<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/sass/main.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js" />

    <?php wp_head(); ?>
</head>

<body <?php body_class('is-preload'); ?>>

    <!-- Wrapper -->
    <div id="wrapper">

        <header id="header">
            <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            <nav class="links">
                <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
        ));
        ?>
            </nav>
            <nav class="main">
                <ul>
                    <li class="search">
                        <a class="fa-search" href="#search">Search</a>
                        <form id="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" id="live-search" name="s" placeholder="Search">
                        </form>
                    </li>
                    <li class="menu">
                        <a class="fa-bars" href="#menu">Menu</a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Menu -->
        <section id="menu">
            <!-- Search -->
            <section>
                <form id="menu-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="text" name="s" placeholder="Search" />
                </form>
            </section>

            <!-- Links -->
            <section>
                <ul class="links">
                    <?php
            $recent_posts = wp_get_recent_posts(array('numberposts' => 4));
            foreach ($recent_posts as $post) :
            ?>
                    <li>
                        <a href="<?php echo get_permalink($post['ID']); ?>">
                            <h3><?php echo $post['post_title']; ?></h3>
                            <p><?php echo wp_trim_words($post['post_content'], 10, '...'); ?></p>
                        </a>
                    </li>
                    <?php endforeach; wp_reset_query(); ?>
                </ul>
            </section>

            <!-- Actions -->
            <section>
                <ul class="actions stacked">
                    <li>
                        <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo wp_logout_url(); ?>" class="button large fit">Log Out</a>
                        <?php else : ?>
                        <a href="<?php echo wp_login_url(); ?>" class="button large fit">Log In</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </section>
        </section>