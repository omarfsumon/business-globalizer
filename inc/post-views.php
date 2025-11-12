<?php
/**
 * Post Views Counter
 */

// Function to set post views
function globalizer_set_post_views() {
    if (is_single()) {
        $post_id = get_the_ID();
        $count = get_post_meta($post_id, 'post_views_count', true);
        
        if ($count == '') {
            delete_post_meta($post_id, 'post_views_count');
            add_post_meta($post_id, 'post_views_count', 1);
        } else {
            update_post_meta($post_id, 'post_views_count', ++$count);
        }
    }
}
add_action('wp_head', 'globalizer_set_post_views');

// Function to get post views
function globalizer_get_post_views($post_id) {
    $count = get_post_meta($post_id, 'post_views_count', true);
    
    if ($count == '') {
        delete_post_meta($post_id, 'post_views_count');
        add_post_meta($post_id, 'post_views_count', 0);
        return 0;
    }
    
    return $count;
}
