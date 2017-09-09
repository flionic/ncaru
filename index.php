<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 02.07.2017
 * Time: 20:22
 */
?>
<?php get_header(); ?>
<div class="container">
    <?php echo do_shortcode('[image-carousel]'); ?>
</div>
    <div class="container">
        <div class="row cards">
            <?php query_posts(array(
                'order' => 'ASC',
                'meta_key' => '_expiration-date',
                'orderby' => 'meta_value'
            )); ?>
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <?php get_template_part('posts_cards'); ?>
            <?php endwhile; endif; ?>
            <?php get_template_part('pagination'); ?>
        </div>
    </div>
<?php get_footer(); ?>