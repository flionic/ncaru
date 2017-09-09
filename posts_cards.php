<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 07.08.2017
 * Time: 16:56
 */
?>
<div class="col-6 col-md-4">
    <div class="card card-inverse-">
        <?php the_post_thumb(); ?>
        <div class="card-img-overlay">
            <a class="card-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"></a>
            <h4 class="card-title"><?php the_title(); ?></h4>
            <?php if (get_post_meta(get_the_ID(), '_expiration-date', true) or get_post_meta(get_the_ID(), 'post_place', true)) {
                echo '<div class="card-text">';
                echo '<p>' . date('d.m.Y H:i', get_post_meta(get_the_ID(), '_expiration-date', true) + 10800) . '</p>';
                if (get_post_meta(get_the_ID(), 'post_place', true)) {
                    echo '<p class="location"><img class="ico-loc" src="' . get_template_directory_uri() . '/ico/geo.png"/>'.get_post_meta(get_the_ID(), 'post_place', true).'</p>';
                }
                echo '</div>';
            }; ?>
        </div>
    </div>
    <?php if (get_option('buyticket_btn') == '1' and get_post_meta(get_the_ID(), 'post_ticket', true)) : echo '<a href="' . get_post_meta(get_the_ID(), 'post_ticket', true) . '" class="btn btn-table btn-outline-primary" target="_blank"><p class="ico-muz" style="display: -webkit-inline-flex;"></p>Купить билеты</a>'; endif; ?>
</div>