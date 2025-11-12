<?php
// Dequeue WordPress block library CSS
function globalizer_dequeue_block_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wp-block-site-logo');
    wp_dequeue_style('wp-block-navigation');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'globalizer_dequeue_block_styles', 100);

// Enqueue theme stylesheet.
function globalizer_enqueue_styles() {
    wp_enqueue_style( 'globalizer-style', get_stylesheet_uri() );
    wp_enqueue_style( 'globalizer-tailwind', get_template_directory_uri() . '/src/css/main.css', array(), '1.0', 'all' );
    wp_enqueue_script( 'globalizer-main-js', GLOBAL_URI . '/src/js/main.js', array(), '1.0', true);
    wp_enqueue_script( 'globalizer-mega-menu', GLOBAL_URI . '/src/js/mega-menu.js', array(), '1.0', true);
    wp_enqueue_script( 'globalizer-mobile-menu', GLOBAL_URI . '/src/js/mobile-menu.js', array(), '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'globalizer_enqueue_styles' );
