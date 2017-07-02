<?php
add_theme_support( 'post-thumbnails' );
remove_filter( 'the_content', 'wpautop' );

function the_img_url(){
    if ( has_post_thumbnail() ) {
        echo wp_get_attachment_url(get_post_thumbnail_id());
    }else {
        echo esc_url(get_template_directory_uri()) . '/img/no-image.png';
    }
}

function content_filter() {
    return wp_strip_all_tags(get_the_content());
}
add_filter( 'the_content', 'content_filter' );

function posts_link_attributes() {
    return 'class="btn-a"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');