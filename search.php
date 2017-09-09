<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php get_header(); ?>
    <div class="container">
        <?php echo have_posts() ? ('<h2>Результаты поиска "'.get_search_query().'": </h2><br>') : '<h1>К сожалению, по запросу "'. get_search_query() .'"ничего не найдено</h1>';?>
        <div class="row cards">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <?php get_template_part('posts_cards'); ?>
            <?php endwhile; endif; ?>
            <?php get_template_part('pagination'); ?>
        </div>
    </div>
<?php get_footer(); ?>