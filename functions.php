<?php
// Maintenance Mode
function wp_maintenance_mode(){
    if(!current_user_can('edit_themes') || !is_user_logged_in()){
        wp_die('<h1 style="color:#f2c115;">Техническое обслуживание.</h1><br />Пожалуйста, зайдите позже.');
    }
}
//add_action('get_header', 'wp_maintenance_mode');

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