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
    <?php //echo cptbc_shortcode(''); ?>
</div>
<?php // get_template_part('carousel'); ?>
    <div class="container">
        <div class="row cards">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <?php get_template_part('posts_cards'); ?>
            <?php endwhile; endif; ?>
            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                <script>
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                </script>
                <button type="button" class="btn btn-next btn-table btn-outline-primary">Далее</button>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>