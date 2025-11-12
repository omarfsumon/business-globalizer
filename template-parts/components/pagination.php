<?php
/**
 * Pagination Component
 * 
 * @package Globalizer
 */

function globalizer_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    
    $links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => __('« Previous', 'globalizer'),
        'next_text' => __('Next »', 'globalizer'),
        'type' => 'array',
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 2,
        'prev_next' => true,
        'add_args' => false,
    ));

    if ($links) {
        echo '<div class="col-span-1 md:col-span-2 lg:col-span-3">';
        echo '<nav class="pagination-nav" role="navigation" aria-label="Posts navigation">';
        echo '<div class="pagination-wrapper">';
        
        // Add disabled previous link if on first page
        if (get_query_var('paged') <= 1) {
            echo '<span class="page-numbers disabled">« Previous</span>';
        }
        
        foreach ($links as $link) {
            echo $link;
        }
        
        // Add disabled next link if on last page
        if (get_query_var('paged') >= $wp_query->max_num_pages) {
            echo '<span class="page-numbers disabled">Next »</span>';
        }
        
        echo '</div>';
        echo '</nav>';
        echo '</div>';
    }
}
