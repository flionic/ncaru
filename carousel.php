<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 02.07.2017
 * Time: 22:42
 */
?>
<div class="container">
    <div id="carouselControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/pic-1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/pic-1.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/pic-1.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="carousel-control-bg"></span>
            <span class="sr-only">Назад</span>
        </a>
        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="carousel-control-bg"></span>
            <span class="sr-only">Далее</span>
        </a>
    </div>
</div>
