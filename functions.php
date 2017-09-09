<?php
/* ---------- ADMIN ---------- */
// add a new logo to the login page
function custom_login_page()
{ ?>
    <style type="text/css">
        .login #login h1 a {
            background-image: url( <?php echo get_template_directory_uri() . '/img/logo.png' ?> );
        }
    </style>
<?php }
wp_enqueue_style('nca-admin', get_template_directory_uri() . '/css/admin.min.css');
add_action('login_enqueue_scripts', 'custom_login_page');

// change link on logo
add_filter('login_headerurl', create_function(false, "return home_url();"));
// change title on logo
add_filter('login_headertitle', create_function(false, "return 'На главную';"));


/* ------ SETTINGS PAGE ------ */
// show settings section
function theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Пользовательские настройки</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function add_theme_menu_item()
{
    add_menu_page("Настройки NCA", "Настройки NCA", "manage_options", "theme-panel", "theme_settings_page", null, 59);
}
add_action("admin_menu", "add_theme_menu_item");

// elements of settings section
function display_buyticket_element()
{
    ?>
    <fieldset>
        <legend class="screen-reader-text"><span>Кнопка билетов</span></legend>
        <label for="buyticket_btn">
            <input name="buyticket_btn" type="checkbox" id="buyticket_btn" value="1" <?php checked(1, get_option('buyticket_btn'), true); ?> />
            Отображать ли кнопку покупки
        </label>
    </fieldset>
    <?php
}
function display_footer_element()
{
    ?>
    <input name="footer_text" type="text" id="footer_text" value="<?php echo get_option('footer_text'); ?>" class="regular-text">
    <p class="description" id="copyright-description">Текст сообщения в подвале (самый низ сайта)</p>
    <?php
}
function display_carousel_element()
{
    ?>
    <input name="carousel_interval" type="text" id="carousel_interval" value="<?php echo get_option('carousel_interval'); ?>" class="regular-text">
    <p class="description" id="carousel-time-description">Скорость переключения картинок (секунды)</p>
    <?php
}
function display_devmode_element()
{
    ?>
    <fieldset>
        <legend class="screen-reader-text"><span>Тех. обслуживание</span></legend>
        <label for="devmode_cb">
            <input name="devmode_cb" type="checkbox" id="devmode_cb" value="1" <?php checked(1, get_option('devmode_cb'), true); ?> />
            Закрыть сайт для посетителей
        </label>
    </fieldset>
    <input name="devmode_text" type="text" id="devmode_text" value="<?php echo get_option('devmode_text'); ?>" class="regular-text">
    <p class="description" id="devmode-description">Выводимое сообщение в режиме обслуживания</p>
    <?php
}

// page of settings section
function display_theme_panel_fields()
{
    add_settings_section("section", "Главные настройки", null, "theme-options");

    add_settings_field("buyticket", "Купить билеты", "display_buyticket_element", "theme-options", "section");
    add_settings_field("copyright", "Copyright", "display_footer_element", "theme-options", "section");
    add_settings_field("carousel", "Настройки слайдера", "display_carousel_element", "theme-options", "section");
    add_settings_field("devmode", "Режим тех. обслуживания", "display_devmode_element", "theme-options", "section");

    register_setting("section", "buyticket_btn");
    register_setting("section", "footer_text");
    register_setting("section", "carousel_interval");
    register_setting("section", "devmode_cb");
    register_setting("section", "devmode_text");
}
add_action("admin_init", "display_theme_panel_fields");


/* ----------- ALL ----------- */
// Enqueue CSS and JS
function enqueue_css_js()
{
    wp_enqueue_style('bs-4', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('my', get_template_directory_uri() . '/css/style.min.css');
    wp_enqueue_style('nca', get_stylesheet_uri());

    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', '', '', true);
    wp_enqueue_script('tether', get_template_directory_uri() . '/js/tether.min.js', '', '', true);
    wp_enqueue_script('bs-4', get_template_directory_uri() . '/js/bootstrap.min.js', '', '', true);
    wp_enqueue_script('nca', get_template_directory_uri() . '/js/main.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_css_js');

// navbar
require_once('bs-navwalker.php');
add_action('after_setup_theme', 'theme_register_nav_menu');
function theme_register_nav_menu()
{
    register_nav_menu('primary', 'Навигационное меню');
}

// Declaring theme settings
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
//    set_post_thumbnail_size(307, 410, array('center', 'center'));
}
if (function_exists('add_image_size')) {
    add_image_size('card-thumb', 307, 410, array('center', 'center'));
}

// no-image on posts
function the_post_thumb()
{
    if (has_post_thumbnail()) { the_post_thumbnail('card-thumb', array('class' => 'card-img')); }
    else { echo '<img class="card-img" src="' . esc_url(get_template_directory_uri()) . '/img/no-image.png "/>'; }
}
function the_img_url()
{
    if (has_post_thumbnail()) { echo wp_get_attachment_url(get_post_thumbnail_id()); }
    else { echo esc_url(get_template_directory_uri()) . '/img/no-image.png'; }
}

// Disable original thumb sizes
//function wplift_remove_image_sizes($sizes) {
//    unset( $sizes['thumbnail']);
//    unset( $sizes['medium']);
//    unset( $sizes['large']);
//    return $sizes;
//}
//add_filter('intermediate_image_sizes_advanced', 'wplift_remove_image_sizes');

// Content without html tags
//function content_filter() { return wp_strip_all_tags(get_the_content()); }
//add_filter('the_content', 'content_filter');
//remove_filter('the_content', 'wpautop');
//add_filter('the_content', 'removeEmptyParagraphs',99999);

// Post links bootstrap class fix
function posts_link_attributes() { return 'class="btn-a"'; }
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

// jQuery posts loader
function true_load_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ):
        while($q->have_posts()): $q->the_post(); ?>
            <?php get_template_part('posts_cards'); ?>
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

// Posts fields
function add_event_place_metabox() {
    add_meta_box('event_place_metabox', __( 'Подробная информация', 'event_data'),
        'event_place_metabox_callback', 'post', 'side', 'core');
}
add_action( 'add_meta_boxes', 'add_event_place_metabox' );
function event_place_metabox_callback( $post ) { ?>
    <td>
        Площадка
        <br/>
        <?php $event_place = get_post_meta( $post->ID, 'post_place', true ); ?>
        <label for "event_place"><?php __('Место события', 'eventplace' ); ?></label>
        <input type="text" class="EventPlace" name="event_place" value="<?php echo $event_place; ?>">
    </td>
<!--    <br>-->
<!--    <br>-->
<!--    <label for "event_date">Дата концерта</label>-->
<!--    <input type="text" class="MyDate" name="event_date" value="--><?php //echo esc_attr(get_post_meta( $post->ID, 'post_date', true )); ?><!--">-->
<!--    <script type="text/javascript">-->
<!--        jQuery(document).ready(function() {-->
<!--            jQuery('.MyDate').datepicker({-->
<!--                dateFormat : 'dd-mm-yy'-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--    <table><tbody>-->
<!--        <tr>-->
<!--            <th style="text-align: left;">Час.</th>-->
<!--            <th style="text-align: left;">Мин.</th>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <label>-->
<!--                    <select name="event_hours">-->
<!--                        --><?php //for($i = 1; $i <= 24; $i++) {
//                            if (get_post_meta( $post->ID, 'post_hours', true ) == date_i18n('H',mktime($i, 0, 0, date_i18n('n'), date_i18n('j'), date_i18n('Y'))))
//                                $selected = ' selected="selected"';
//                            else
//                                $selected = '';
//                            echo '<option value="'.date_i18n('H',mktime($i, 0, 0, date_i18n('n'), date_i18n('j'), date_i18n('Y'))).'"'.$selected.'>'.date_i18n('H',mktime($i, 0, 0, date_i18n('n'), date_i18n('j'), date_i18n('Y'))).'</option>';
//                        } ?>
<!--                    </select>-->
<!--                </label>-->
<!--            </td>-->
<!--            <td>-->
<!--                <label>-->
<!--                    <input type="text" name="event_mins" value="--><?php //echo esc_attr(get_post_meta( $post->ID, 'post_mins', true )); ?><!--" size="2">-->
<!--                </label>-->
<!--            </td>-->
<!--        </tr>-->
<!--    </tbody></table>-->
    <br>
    <label for "event_ticket">Купить билеты</label>
    <input type="text" name="event_ticket" value="<?php echo esc_attr(get_post_meta( $post->ID, 'post_ticket', true )); ?>">
    <br>
    <label for "event_vk">Официальная встреча</label>
    <input type="text" name="event_vk" value="<?php echo esc_attr(get_post_meta( $post->ID, 'post_vk', true )); ?>">
<?php }
function save_event_place_meta( $post_id ) {
    if ( !current_user_can( 'edit_post', $post->ID ) ) return;
    if ( isset( $_POST['event_place'] ) ) {
        update_post_meta( $post_id, 'post_place', ( $_POST['event_place'] ) );
    }
    if ( isset( $_POST['event_ticket'] ) ) {
        update_post_meta( $post_id, 'post_ticket', $_POST['event_ticket'] );
    }
    if ( isset( $_POST['event_vk'] ) ) {
        update_post_meta( $post_id, 'post_vk', $_POST['event_vk'] );
    }
}
add_action( 'save_post', 'save_event_place_meta' );

function tutsplus_load_jquery_datepicker() {
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
}
add_action( 'admin_enqueue_scripts', 'tutsplus_load_jquery_datepicker' );

function wpdocs_my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="col-md-5 searchform" action="' . home_url( '/' ) . '" >
    <div style=" float: right;"><label class="screen-reader-text" for="s"></label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Поиск..." required />
    <input type="submit" id="searchsubmit" class="btn btn-outline-primary ico ico-s" value="" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );

require_once('post-expirator/post-expirator.php');
require_once('bs-carousel/cpt-bootstrap-carousel.php');
