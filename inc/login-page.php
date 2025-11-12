<?php
/**
 * Custom Login Page Customization
 * 
 * @package Globalizer
 */

// Change the login page logo URL to point to your site
function globalizer_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'globalizer_login_logo_url');

// Change the login page logo title
function globalizer_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'globalizer_login_logo_url_title');

// Customize the login page CSS
function globalizer_login_styles() {
    ?>
        <style type="text/css">
            /* Main background */
            body.login {
                background-image: url('<?php echo get_theme_file_uri('src/img/login_back.webp'); ?>');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
                margin: auto 0px;
                overflow: hidden;
            }
            
            /* Overlay */
            body.login::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: #00000040;
                z-index: 1;
            }

            /* Login form wrapper */
            #login {
                position: relative;
                z-index: 2;
                width: 350px !important;
                margin: auto 0px !important;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 40px !important;
                background-color: #ffffff;
                backdrop-filter: blur(5px) !important;
            }

            /* Logo */
            .login h1 {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .login h1 a {
                background-image: url('<?php echo (get_custom_logo_url()) ? get_custom_logo_url() : get_theme_file_uri('src/img/logo.png'); ?>') !important;
                background-size: contain !important;
                background-position: center !important;
                width: 85% !important;
                height: 80px !important;
                margin: 0px !important;
            }

            /* Form styling */
            #loginform {
                background: transparent !important;
                padding: 10px 0px !important;
                border-radius: 8px !important;
                border: none !important;
                margin: 0px !important;
                box-shadow: none !important;
                overflow: visible;
            }

            #loginform label {
                color: #262626 !important;
            }

            /* Input fields */
            #loginform input[type="text"],
            #loginform input[type="password"] {
                background: #fff !important;
                position: relative;
                border: 1px solid #ddd !important;
                border-radius: 4px !important;
                padding: 10px !important;
                height: auto !important;
                font-size: 15px !important;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.1) !important;
            }

            /* Submit button */
            #loginform .submit .button {
                width: 100% !important;
                background: #2563eb !important;
                border: none !important;
                padding: 5px 25px !important;
                height: auto !important;
                font-size: 15px !important;
                text-transform: uppercase !important;
                font-weight: 600 !important;
                transition: all 0.3s ease !important;
            }

            #loginform .submit .button:hover {
                background: #1d4ed8 !important;
                transform: translateY(-1px);
            }

            /* Remember me checkbox */
            #loginform .forgetmenot {
                margin-bottom: 15px !important;
            }

            /* Links */
            .login #nav,
            .login #backtoblog {
                text-align: center !important;
                padding: 0 !important;
                margin: 20px 0 0 !important;
            }

            .login #nav a,
            .login #backtoblog a {
                color: #3c434a !important;
                text-decoration: none !important;
                font-size: 14px !important;
            }

            .login #nav a:hover,
            .login #backtoblog a:hover {
                color: #2563eb !important;
            }

            /* Messages */
            .message,
            #login_error {
                border-radius: 4px !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            }
        </style>
    <?php
}
add_action('login_enqueue_scripts', 'globalizer_login_styles');

// Helper function to get custom logo URL
function get_custom_logo_url() {
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo_info = wp_get_attachment_image_src($custom_logo_id, 'full');
        return $logo_info[0];
    }
    return false;
}
