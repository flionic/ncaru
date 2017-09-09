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
                <div class="row">
                    <div class="col-12 col-md-7 post">
                        <blockquote class="blockquote">
                            <small class="text-muted"><?php the_category(' '); ?></small><br>
                            <h1 class="post-title" style="color: #000"><?php the_title(); ?></h1>
                            <?php edit_post_link(__('Редактировать'), '', '<br>', 0, 'post-edit-link btn btn-primary btn-sm'); ?>
                            <?php if (get_post_meta(get_the_ID(), '_expiration-date', true)) : echo '<small class="text-muted">Дата события: ' . date('d.m.Y H:i', get_post_meta(get_the_ID(), '_expiration-date', true) + 10800) . '</small><br>'; endif;?>
                            <?php if (get_post_meta(get_the_ID(), 'post_place', true)) : echo '<small class="text-muted">Место: ' . get_post_meta(get_the_ID(), 'post_place', true) . '</small><br>'; endif;?>
                        </blockquote>
                        <?php if (get_option('buyticket_btn') == '1' and get_post_meta(get_the_ID(), 'post_ticket', true)) : echo '<a href="' . get_post_meta(get_the_ID(), 'post_ticket', true) . '" class="btn btn-warning" target="_blank"><img class="ico-single" src="'.get_template_directory_uri().'/ico/muz_2.png">Купить билеты</a>'; endif; ?>
                        <?php if (get_option('buyticket_btn') == '1' and get_post_meta(get_the_ID(), 'post_vk', true)) : echo '<a href="' . get_post_meta(get_the_ID(), 'post_vk', true) . '" class="btn btn-primary" target="_blank"><img class="ico-single" src="'.get_template_directory_uri().'/ico/vk_3.png">Официальная встреча</a>'; endif; ?>
                    </div>
                    <div class="col-12 col-md-5 post">
                        <img class="img-fluid rounded" style="max-height: 300px;" src="<?php the_img_url(); ?>" alt="<?php the_title(); ?>">
                        <div class="p-3 clearfix"></div>
                    </div>
                    <div class="col-12">
                        <hr class="my-4">
                        <div class="post-text"><?php the_content(); ?></div>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
<?php get_footer(); ?>