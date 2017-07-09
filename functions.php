<?php
/* ---------- ADMIN ---------- */
// add a new logo to the login page
function custom_login_page() { ?>
    <style type="text/css">
        .login #login h1 a {
            background-image: url( <?php echo get_template_directory_uri() . '/img/logo.png' ?> );
        }
    </style>
<?php }
wp_enqueue_style( 'nca-admin', get_template_directory_uri() . '/css/admin.min.css');
add_action( 'login_enqueue_scripts', 'custom_login_page');

// change link on logo
add_filter('login_headerurl', create_function(false,"return home_url();"));
// change title on logo
add_filter('login_headertitle', create_function(false,"return 'На главную';"));

/* ---------- ALL ---------- */
// Maintenance Mode
function wp_maintenance_mode(){
    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        wp_die('<h1 style="color:#f2c115;">Техническое обслуживание.</h1><br />Пожалуйста, зайдите позже.');
    }
}
//add_action('get_header', 'wp_maintenance_mode');

// Enqueue CSS and JS
function enqueue_css_js() {
    // css
    wp_enqueue_style( 'bs-4', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'my', get_template_directory_uri() . '/css/style.min.css');
    wp_enqueue_style( 'nca', get_stylesheet_uri());
    // js
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', '', '', true);
    wp_enqueue_script( 'tether', get_template_directory_uri() . '/js/tether.min.js', '', '', true);
    wp_enqueue_script( 'bs-4', get_template_directory_uri() . '/js/bootstrap.min.js', '', '', true);
    wp_enqueue_script( 'nca', get_template_directory_uri() . '/js/main.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_css_js');

// navbar
require_once('bs-navwalker.php');
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
    register_nav_menu( 'primary', 'Навигационное меню' );
}
if (function_exists('add_theme_support')) {
    add_theme_support( 'post-thumbnails' );
    add_theme_support('menus');
}

// no-image on posts
function the_img_url(){
    if ( has_post_thumbnail() ) {
        echo wp_get_attachment_url(get_post_thumbnail_id());
    }else {
        echo esc_url(get_template_directory_uri()) . '/img/no-image.png';
    }
}

// Content without html tags
function content_filter() {
    return wp_strip_all_tags(get_the_content());
}
add_filter( 'the_content', 'content_filter' );
remove_filter( 'the_content', 'wpautop' );

// Post links bootstrap class fix
function posts_link_attributes() {
    return 'class="btn-a"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');