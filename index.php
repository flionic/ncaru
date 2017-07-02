<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 02.07.2017
 * Time: 20:22
 */
?>
<?php get_header(); ?>
<?php get_template_part('carousel'); ?>
    <div class="container">
        <div class="row cards">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <div class="col-6 col-md-4">
                    <div class="card card-inverse-">
                        <img class="card-img" src="<?php the_img_url(); ?>" alt="<?php the_title(); ?>">
                        <div class="card-img-overlay">
                            <a class="card-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"></a>
                            <h4 class="card-title"><?php the_title(); ?></h4>
                            <p class="card-text"><?php the_content(); ?></p>
                            <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                        </div>
                    </div>
                    <button type="button" class="btn btn-block btn-outline-primary">Купить билеты</button>
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