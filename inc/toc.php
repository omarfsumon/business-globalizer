<?php
function add_heading_ids($content) {
    if (is_single()) {
        preg_match_all('/<h([2-4])(.*?)>(.*?)<\/h[2-4]>/', $content, $matches, PREG_SET_ORDER);
        
        if (!empty($matches)) {
            foreach ($matches as $match) {
                $heading_text = strip_tags($match[3]);
                $heading_id = sanitize_title($heading_text);
                $heading_level = $match[1];
                
                $content = preg_replace(
                    '/'.preg_quote($match[0], '/').'/',
                    '<h'.$heading_level.' id="'.$heading_id.'"'.$match[2].'>'.$match[3].'</h'.$heading_level.'>',
                    $content,
                    1
                );
            }
        }
    }
    return $content;
}
add_filter('the_content', 'add_heading_ids', 5);

function get_dynamic_toc() {
    global $post;
    if (!is_single() || !$post) return '';

    $content = $post->post_content;
    preg_match_all('/<h([2-4])(.*?)>(.*?)<\/h[2-4]>/', $content, $matches, PREG_SET_ORDER);

    if (empty($matches)) return '';

    $toc = '<div class="border rounded-lg bg-white shadow-sm sticky top-24 overflow-hidden">';
    $toc .= '<h4 class="text-lg font-bold sticky top-0 p-3 bg-white shadow">Table of Content</h4>';
    $toc .= '<nav class="toc-nav px-5 overflow-y-scroll max-h-[calc(50vh)] custom-scrollbar" id="table-of-contents">';
    $toc .= '<ul class="space-y-2 text-sm list-none">';
    
    // Add JavaScript for tracking active section
    $toc .= '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const toc = document.getElementById("table-of-contents");
            const tocLinks = toc.getElementsByTagName("a");
            const sections = [];
            
            Array.from(tocLinks).forEach(link => {
                const section = document.getElementById(link.getAttribute("href").substring(1));
                if (section) sections.push(section);
            });
            
            function setActiveLink() {
                const scrollPos = window.scrollY + 150; // Offset for header
                
                let activeSection = sections[0];
                sections.forEach(section => {
                    if (section.offsetTop <= scrollPos) {
                        activeSection = section;
                    }
                });
                
                Array.from(tocLinks).forEach(link => {
                    link.classList.remove("toc-active");
                    if (link.getAttribute("href") === "#" + activeSection.id) {
                        link.classList.add("toc-active");
                    }
                });
            }
            
            window.addEventListener("scroll", setActiveLink);
            setActiveLink(); // Set initial active link
        });
    </script>';

    foreach ($matches as $match) {
        $heading_level = intval($match[1]);
        $heading_text = strip_tags($match[3]);
        $heading_id = sanitize_title($heading_text);

        $indent_class = 'pl-' . (($heading_level - 2) * 4);
        $toc .= sprintf(
            '<li class="%s"><a href="#%s" class="block text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200 toc-link">%s</a></li>',
            $indent_class,
            $heading_id,
            $heading_text
        );
    }

    $toc .= '</ul></nav></div>';

    return $toc;
}

