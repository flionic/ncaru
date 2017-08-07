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
                <div class="media-">
                    <div class="col-12 col-md-7" style="float: left">
                        <blockquote class="blockquote">
                            <small class="text-muted"><?php the_category(' '); ?></small><br>
                            <h1 class="post-title" style="color: #000"><?php the_title(); ?></h1>
                            <?php edit_post_link(__('Редактировать'), '', '<br>', 0, 'post-edit-link btn btn-primary btn-sm'); ?>
                            <small class="text-muted">Дата события: <?php echo get_post_meta(get_the_ID(), 'Дата', true); ?></small><br>
                            <small class="text-muted">Место: <?php echo get_post_meta(get_the_ID(), 'Место', true); ?></small>
                        </blockquote>
                        <?php if (get_option('buyticket_btn') == '1') : echo '<a href="#" class="btn btn-warning">Купить билеты</a>'; endif; ?>
                        <hr class="my-4">
                    </div>
                    <div class="col-12 col-md-5" style="float: right">
                        <img class="img-fluid rounded" src="<?php the_img_url(); ?>" alt="<?php the_title(); ?>">
                        <div class="p-3 clearfix"></div>
                    </div>
                    <div class="col-12">
                        <p class="post-text"><?php the_content(); ?></p>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php get_footer(); ?>