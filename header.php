<?php
/**
 * Created by PhpStorm.
 * User: Bionic
 * Date: 02.07.2017
 * Time: 20:35
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/style.css">
    <link rel='stylesheet' id='main-style' href='<?php echo get_stylesheet_uri(); ?>' type='text/css' media='all' />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" class="img-fluid logo" alt="logo"></a>
    <nav class="navbar navbar-toggleable-md navbar-inverse">
        <div class="d-flex nav-menu justify-content-md-center">
            <div class="col-xs-4 w-100">
                <button class="navbar-toggler w-100 navbar-toggler-right1" type="button" data-toggle="collapse"
                        data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-text">Меню</span>
                </button>
            </div>
        </div>
        <!--<a class="navbar-brand" href="#">NCA Live!</a>-->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">О компании</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Separated link</a>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Новости</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">Концерты</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">NCA и благотворительность</a>
                        <a class="dropdown-item" href="#">Магазин фанатской атрибутики</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Separated link</a>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Контакты</a></li>
            </ul>
        </div>
    </nav>
</div>