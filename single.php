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
        <div class="jumbotron">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <div class="media">
                    <div class="col-8">
                        <blockquote class="blockquote">
                            <h1 class="post-title" style="color: #000"><?php the_title(); ?></h1>
                            <?php edit_post_link( __( 'Редактировать'), '', '<br>', 0, 'post-edit-link btn btn-primary btn-sm' ); ?>
                            <small class="text-muted"><?php the_time('d.m.y H:i'); ?>, <?php the_category( ', ' ); ?></small>
                        </blockquote>
                        <?php if (get_option('buyticket_btn') == '1') : echo '<a href="#" class="btn btn-warning">Купить билеты</a>'; endif;?>
                        <hr class="my-4">
                        <p class="post-text"><?php the_content(); ?></p>
                    </div>
                    <div class="col-4">
                        <img class="img-fluid rounded" src="<?php the_img_url(); ?>" alt="<?php the_title(); ?>">
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php get_footer(); ?>