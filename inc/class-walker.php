<?php

class Mega_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        // Add relative positioning to parent li
        $output = str_replace('class="menu-item', 'class="menu-item relative', $output);
        
        // Different classes for main menu and submenu
        if ($depth === 0) {
            // Mega menu style for first level submenu
            $output .= '<ul class="mega-menu fixed left-1/2 -translate-x-1/2 z-50 opacity-0 invisible top-[80px] w-full max-w-[1280px] mx-auto grid grid-cols-3 gap-6 p-8 shadow-xl bg-white rounded-xl border border-gray-100 transition-all duration-300 ease-in-out transform -translate-y-2 pointer-events-none my-0">';
        } else {
            // Regular submenu style for deeper levels
            $output .= '<ul class="sub-menu pl-4">';
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $svg_icon = get_post_meta($item->ID, '_menu_item_svg_icon', true);
        $description = !empty($item->description) ? $item->description : '';
        
        // Define classes based on depth
        if ($depth === 0) {
            // Main menu item
            $li_classes = 'group inline-flex items-center gap-2 px-4 py-2 text-base font-medium text-gray-700 hover:text-gray-900 transition-colors';
            if ($item->hasChildren) {
                $li_classes .= ' relative';
            }
        } else {
            // Submenu item
            $li_classes = 'group flex w-full cursor-pointer select-none items-start gap-4 rounded-xl p-2 hover:bg-gray-50 transition-colors';
        }
        
        // Add menu item classes from WordPress
        $li_classes .= ' ' . implode(' ', $item->classes);
        
        // Start the list item
        $output .= sprintf('<li class="%s">', esc_attr($li_classes));
        
        // Start the link
        $atts = array(
            'href'   => !empty($item->url) ? $item->url : '#',
            'class'  => $depth === 0 ? 'inline-flex items-center' : '!flex flex-row gap-2 w-full',
            'target' => !empty($item->target) ? $item->target : '',
            'rel'    => !empty($item->xfn) ? $item->xfn : ''
        );
        
        // Build the opening <a> tag
        $output .= '<a ' . $this->build_atts($atts) . '>';
        
        // Add SVG icon if exists
        if (!empty($svg_icon)) {
            if ($depth === 0) {
                // For main menu, inline SVG
                $output .= $svg_icon;
            } else {
                // For submenu, wrapped SVG
                $output .= '<div class="flex items-center justify-center rounded-lg p-2 bg-gray-100 aspect-square size-14">';
                $output .= $svg_icon;
                $output .= '</div>';
            }
        }
        
        // Title with different styles based on depth
        if ($depth === 0) {
            // For main menu items, just output the title directly
            $output .= esc_html($item->title);
            // Add dropdown arrow for items with children
            if ($item->hasChildren) {
                $output .= '<svg width="16px" height="16px" class="w-4 h-4 ml-1 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
            }
        } else {
            // For submenu items, use wrapper and description
            $output .= '<div class="flex-1">';
            $output .= '<h6 class="font-bold text-gray-900 text-sm">' . esc_html($item->title) . '</h6>';
            if (!empty($description)) {
                $output .= '<p class="text-xs text-gray-500">' . esc_html($description) . '</p>';
            }
            $output .= '</div>';
        }
        
        $output .= '</a>';
    }
    
    // Helper function to build HTML attributes
    protected function build_atts($atts = array()) {
        $html = '';
        foreach ($atts as $name => $value) {
            if (!empty($value)) {
                $html .= ' ' . esc_attr($name) . '="' . esc_attr($value) . '"';
            }
        }
        return $html;
    }
    
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }

    // Override display_element to add hasChildren property
    function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}