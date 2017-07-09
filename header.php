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
    <title><?php wp_title( '-', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/style.min.css">
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
    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?> - Главная">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/logo.png" class="img-fluid logo" alt="logo"></a>
    <?php if (get_option('blog_public') =='0' && (!current_user_can('edit_themes') || !is_user_logged_in())) { ?>
        <h2 style="padding-top: 100px; text-align: center;">К сожалению, доступ временно ограничен</h2>
        <h1 class="display-3" style="padding-bottom: 30px; text-align: center;">технические работы</h1>
    <?php echo "</div>"; get_footer(); die(); } ?>
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
        <?php wp_nav_menu(array(
            'menu'              => 'primary',
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_id'      => 'navbarNav',
            'container_class'   => 'navbar-collapse collapse',
            'menu_id'           => 'primary-nav',
            'menu_class'        => 'navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
        ));?>
    </nav>
</div>
