<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 29.08.2017
 * Time: 17:26
 */
?>
<?php get_header(); ?>
    <div class="container">
        <?php echo do_shortcode('[image-carousel]'); ?>
        <?php
        //$category = get_the_category();
        //echo $category[0]->slug;
        //print_r($category);
        ?>
    </div>
    <div class="container">
        <?php echo have_posts() ? ('<h2>'.get_the_category()[0]->name.':</h2><br>') : '<p style="text-align: center">В данной категории контент отсутствует</p>';?>
        <div class="row cards">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <?php get_template_part('posts_cards'); ?>
            <?php endwhile; endif; ?>
            <?php get_template_part('pagination'); ?>
        </div>
    </div>
<?php get_footer(); ?>