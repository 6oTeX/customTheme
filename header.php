<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body id="test" <?php body_class('is-preload'); ?>>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <!-- Logo/Title -->
            <h1>
                <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            </h1>

            <!-- Navigation links (desktop) -->
            <!-- Feel free to hide these at smaller screens or keep them as-is -->
            <nav class="links">
                <?php
          wp_nav_menu(array(
            'theme_location' => 'primary', // Must be registered in functions.php
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
          ));
        ?>
            </nav>

            <!-- Right side: search + menu toggle -->
            <nav class="main">
                <ul>
                    <!-- Search form (standard WordPress) -->
                    <li class="search">
                        <!-- We can also use get_search_form() if you have a searchform.php -->
                        <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"
                                placeholder="Search" />
                        </form>
                    </li>

                    <!-- Hamburger menu link -->
                    <li class="menu">
                        <!-- .fa-bars triggers the JS toggle -->
                        <a onClick="toggleMenu()" class="fa-bars">
                            <i class="fa fa-bars
                                "></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Hidden Menu -->
        <div id="hidden-menu" class="hidden-menu">

            <!-- Search -->
            <section class="search-form">
                <form class="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </section>

            <!-- Links -->
            <section>
                <?php
            wp_nav_menu(array(
            'theme_location' => 'primary', // Reuse the same menu
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
        ));
                ?>
            </section>

            <!-- Actions -->
            <section>
                <ul class="actions stacked">
                    <li><a href="#" class="button large fit">Log In</a></li>
                </ul>
            </section>

        </div>