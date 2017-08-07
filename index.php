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
                <div class="col-6 col-md-4">
                    <div class="card card-inverse-">
                        <?php the_post_thumb(); ?>
                        <div class="card-img-overlay">
                            <a class="card-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"></a>
                            <h4 class="card-title"><?php the_title(); ?></h4>
                            <div class="card-text">
                                <?php if (get_post_meta(get_the_ID(), 'Дата', true)) : echo '<p>' . get_post_meta(get_the_ID(), 'Дата', true) . '</p>'; endif;?>
                                <?php if (get_post_meta(get_the_ID(), 'Место', true)) : echo '<p class="location">' . get_post_meta(get_the_ID(), 'Место', true) . '</p>'; endif;?>
                            </div>
                        </div>
                    </div>
                    <?php if (get_option('buyticket_btn') == '1' and get_post_meta(get_the_ID(), 'Купить билеты', true)) : echo '<a href="' . get_post_meta(get_the_ID(), 'Купить билеты', true) . '" class="btn btn-table btn-outline-primary" target="_blank">Купить билеты</a>'; endif;?>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
            <div class="row justify-content-md-center">
                <?php previous_posts_link( __( '<button type="button" class="btn btn-next btn-block btn-outline-primary">Назад</button>', '') ); ?>
                <?php next_posts_link( __( '<button type="button" class="btn btn-next btn-block btn-outline-primary">Далее</button>', '') ); ?>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>