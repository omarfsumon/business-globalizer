<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header" class="shadow z-50 bg-white sticky top-0">
  <div class="container flex items-center justify-between p-5">
    <div class="site_logo">
        <?php
        if ( has_custom_logo() ) {
            the_custom_logo();
        } elseif ( is_front_page() && is_home() ) {
            ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </h1>
            <?php
        } else {
            ?>
            <p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            </p>
            <?php
        }
        ?>
    </div>


    <!-- Mobile Menu Toggle -->
    <button id="mobile-menu-toggle" class="lg:hidden p-2" aria-label="Toggle Menu">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <!-- Desktop Navigation -->
    <nav id="desktop-navigation" class="main-navigation hidden lg:block">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'fallback_cb'    => false,
            'depth'          => 2, 
            'walker'         => new Mega_Menu_Walker(),
            'menu_class'    => 'flex items-center gap-4 my-0',
            'add_li_class'   => 'menu-item',
        ) );
        ?>
    </nav>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="fixed top-0 right-0 w-[300px] h-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 lg:hidden">
        <div class="px-4 py-5 border-b flex justify-between items-center">
            <button id="mobile-menu-close" class="p-2" aria-label="Close Menu">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <a class="button_primary py-2" href="https://app.businessglobalizer.com/">Login</a>
        </div>

        <nav id="mobile-navigation" class="p-4">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-menu-items',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 2,
                    'menu_class'    => 'space-y-2',
                    'add_li_class'   => 'mobile-menu-item',
                ) );
            ?>
        </nav>
    </div>
    </nav>
  </div>
</header>