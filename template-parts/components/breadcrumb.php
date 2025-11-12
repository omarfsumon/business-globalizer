<?php
/**
 * Breadcrumb Component
 */

// Dynamic Breadcrumb Function
function globalizer_get_breadcrumb() {
    if (!is_single()) return;

    $output = '<nav class="flex py-4" aria-label="Breadcrumb">';
    $output .= '<ol class="inline-flex items-center space-x-1">';
    
    // Home with icon
    $output .= '<li class="inline-flex items-center">';
    $output .= '<a href="' . home_url() . '" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">';
    $output .= '<svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
    </svg>
    Home</a>';
    $output .= '</li>';
    
    // Projects (if in Projects category or child category)
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = $categories[0];
        $projects_cat = get_category_by_slug('projects');
        
        // Only proceed if projects category exists
        if ($projects_cat && !is_wp_error($projects_cat)) {
            $parent_categories = get_ancestors($category->term_id, 'category');
            if (in_array($projects_cat->term_id, $parent_categories) || $category->slug === 'projects') {
                $output .= '<li class="flex items-center">';
                $output .= '<span class="mx-1 text-gray-400 select-none">/</span>';
                $output .= '<a href="' . get_category_link($projects_cat->term_id) . '" class="text-sm font-medium text-gray-500 hover:text-blue-600">Projects</a>';
                $output .= '</li>';
            }
        }
    }
    
    // Category (only if not Projects)
    if (!empty($categories)) {
        $category = $categories[0];
        if ($category->slug !== 'projects') {
            $output .= '<li class="flex items-center">';
            $output .= '<span class="mx-1 text-gray-400 select-none">/</span>';
            $output .= '<a href="' . get_category_link($category->term_id) . '" class="text-sm font-medium text-gray-500 hover:text-blue-600">' . $category->name . '</a>';
            $output .= '</li>';
        }
    }
    
    // Current Post
    $output .= '<li class="flex items-center">';
    $output .= '<span class="mx-1 text-gray-400 select-none">/</span>';
    $output .= '<span class="text-sm font-medium text-gray-900">' . wp_trim_words(get_the_title(), 4, '...') . '</span>';
    $output .= '</li>';
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    return $output;
}