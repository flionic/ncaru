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
            <?php if (get_post_meta(get_the_ID(), 'Дата', true) or get_post_meta(get_the_ID(), 'post_place', true)) {
                echo '<div class="card-text">';
                    echo '<p>' . get_post_meta(get_the_ID(), 'Дата', true) . '</p>';
                    echo '<p class="location">' . get_post_meta(get_the_ID(), 'post_place', true) . '</p>';
                echo '</div>';
            }; ?>
        </div>
    </div>
    <?php if (get_option('buyticket_btn') == '1' and get_post_meta(get_the_ID(), 'post_ticket', true)) : echo '<a href="' . get_post_meta(get_the_ID(), 'post_ticket', true) . '" class="btn btn-table btn-outline-primary" target="_blank">Купить билеты</a>'; endif; ?>
</div>