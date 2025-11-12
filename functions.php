<?php
/**
 * Theme functions and definitions.
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Add theme support for features.
function globalizer_theme_support() {
    // Add support for title tag.
    add_theme_support( 'title-tag' );

    // Add support for post thumbnails.
    add_theme_support( 'post-thumbnails' );

    // Add support for automatic feed links.
    add_theme_support( 'automatic-feed-links' );

    // Add support for custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register navigation menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'globalizer' ),
    ) );
}
add_action( 'after_setup_theme', 'globalizer_theme_support' );

// Define theme paths
define('GLOBAL_PATH', get_template_directory());
define('GLOBAL_URI', get_template_directory_uri());

/**
 * satup all pages puth location like "/page/page-about-us.php"
 */
function globalizer_page_template($template) {
    if (is_page()) {
        $page_slug = get_post_field('post_name', get_queried_object_id());
        $custom_template = locate_template('page/page-' . $page_slug . '.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter('template_include', 'globalizer_page_template');  

//Load include file
require_once GLOBAL_PATH . '/inc/enqueue.php';
require_once GLOBAL_PATH . '/inc/menu-fields.php';
require_once GLOBAL_PATH . '/inc/class-walker.php';
require_once GLOBAL_PATH . '/inc/toc.php';
require_once GLOBAL_PATH . '/inc/login-page.php';
require_once GLOBAL_PATH . '/inc/post-views.php';
require_once GLOBAL_PATH . '/template-parts/components/pagination.php';
require_once GLOBAL_PATH . '/template-parts/components/breadcrumb.php';

// Modify search query to only show posts
function globalizer_modify_search_query($query) {
    if ($query->is_search() && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_action('pre_get_posts', 'globalizer_modify_search_query');