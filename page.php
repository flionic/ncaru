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
                            <h1 class="post-title" style="color: #000"><?php the_title(); ?></h1>
                            <?php edit_post_link(__('Редактировать'), '', '<br>', 0, 'post-edit-link btn btn-primary btn-sm'); ?>
                        </blockquote>
                    </div>
                    <div class="col-12 col-md-5 post">
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