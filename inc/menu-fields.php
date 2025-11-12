<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add Menu Item Fields using Codestar Framework
add_filter('wp_nav_menu_item_custom_fields', 'add_svg_field_to_menu_item', 20, 4); // Changed priority to 20 to move after Description
function add_svg_field_to_menu_item($item_id, $item, $depth, $args)
{
    $svg_icon = get_post_meta($item_id, '_menu_item_svg_icon', true);
    
    // Create a unique field ID for this menu item
    $field_id = 'menu-item-svg-icon-' . $item_id;
    
    // Define the field settings
    $settings = array(
        'id'    => $field_id,
        'type'  => 'code_editor',
        'title' => 'SVG Icon Code',
        'settings' => array(
            'theme'  => 'dracula',
            'mode'   => 'xml',
            'height' => '150px',
        ),
    );
    
    // Create the field HTML
    ?>
    <div class="field-svg-icon description description-wide" style="margin: 5px 0 10px; width: 100%;">
        <label for="<?php echo esc_attr($field_id); ?>">
            <span style="font-weight: bold; margin-bottom: 5px; display: block;"><?php echo esc_html($settings['title']); ?></span>
            <textarea 
                id="<?php echo esc_attr($field_id); ?>"
                class="widefat code csf-code-editor"
                name="menu-item-svg-icon[<?php echo esc_attr($item_id); ?>]"
                data-editor="xml"
                data-theme="dracula"
                style="width: 100%; min-height: 100px;"
            ><?php echo esc_textarea($svg_icon); ?></textarea>
        </label>
    </div>
    <?php
    
    // Add necessary scripts and styles for code editor
    wp_enqueue_style('csf');
    wp_enqueue_script('csf');
    wp_enqueue_script('csf-codemirror');
}

// Save Menu Item Fields
add_action('wp_update_nav_menu_item', 'save_svg_field_to_menu_item', 10, 3);
function save_svg_field_to_menu_item($menu_id, $menu_item_db_id, $args)
{
    if (isset($_POST['menu-item-svg-icon'][$menu_item_db_id])) {
        $svg_icon = wp_kses($_POST['menu-item-svg-icon'][$menu_item_db_id], array(
            'svg' => array(
                'xmlns' => array(),
                'height' => array(),
                'width' => array(),
                'viewbox' => array(),
                'fill' => array(),
                'class' => array(),
            ),
            'path' => array(
                'd' => array(),
                'fill' => array(),
                'stroke' => array(),
                'stroke-width' => array(),
            ),
        ));
        
        if (!empty($svg_icon)) {
            update_post_meta($menu_item_db_id, '_menu_item_svg_icon', $svg_icon);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_svg_icon');
        }
    }
}

// Add function to get the SVG icon for a menu item
function get_menu_item_svg_icon($item_id) {
    $svg_icon = get_post_meta($item_id, '_menu_item_svg_icon', true);
    return !empty($svg_icon) ? $svg_icon : '';
}
