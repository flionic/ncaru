<?php
/*****************************************************
* CPT Bootstrap Carousel
* http://www.tallphil.co.uk/bootstrap-carousel/
* ----------------------------------------------------
* cptbc-settings.php
* Code to handle the Settings page
******************************************************/

///////////////////
// SETTINGS PAGE
///////////////////

// Set up settings defaults
register_activation_hook(__FILE__, 'cptbc_set_options');
function cptbc_set_options (){
	$defaults = array(
		'interval' => '5000',
		'showcaption' => 'true',
		'showcontrols' => 'true',
		'customprev' => '',
		'customnext' => '',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'category' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		'before_caption' => '<p>',
		'after_caption' => '</p>',
		'image_size' => 'full',
		'link_button' => '1',
		'link_button_text' => 'Читать далее',
		'link_button_class' => 'btn btn-default pull-right',
		'link_button_before' => '',
		'link_button_after' => '',
		'id' => '',
		'twbs' => '3',
		'use_background_images' => '0',
		'background_images_height' => '500',
        'background_images_style_size' => 'cover',
        'use_javascript_animation' => '1',
	);
	add_option('cptbc_settings', $defaults);
}
// Clean up on uninstall
register_activation_hook(__FILE__, 'cptbc_deactivate');
function cptbc_deactivate(){
	delete_option('cptbc_settings');
}


// Render the settings page
class cptbc_settings_page {
	// Holds the values to be used in the fields callbacks
	private $options;
			
	// Start up
	public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
	}
			
	// Add settings page
	public function add_plugin_page() {
		add_submenu_page('edit.php?post_type=cptbc', __('Настройки карусели', 'cpt-bootstrap-carousel'), __('Настройки', 'cpt-bootstrap-carousel'), 'manage_options', 'cpt-bootstrap-carousel', array($this,'create_admin_page'));
	}
			
	// Options page callback
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'cptbc_settings' );
		if(!$this->options){
			cptbc_set_options ();
			$this->options = get_option( 'cptbc_settings' );
		}
		?>
		<div class="wrap">
		<h2>Кольцевая галерея слайдов - <?php _e('Настройки', 'cpt-bootstrap-carousel'); ?></h2>
            <form method="post" action="options.php"><?php
                settings_fields( 'cptbc_settings' );
                do_settings_sections( 'cpt-bootstrap-carousel' );
                submit_button();?>
            </form>
		</div>
		<?php
	}
			
	// Register and add settings
	public function page_init() {		
		register_setting(
				'cptbc_settings', // Option group
				'cptbc_settings', // Option name
				array( $this, 'sanitize' ) // Sanitize
		);
		
        // Sections
		add_settings_section(
				'cptbc_settings_behaviour', // ID
				__('Поведение галереи', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'cptbc_settings_behaviour_header' ), // Callback
				'cpt-bootstrap-carousel' // Page
		);
		add_settings_section(
				'cptbc_settings_setup', // ID
				__('Настрока карусели', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'cptbc_settings_setup' ), // Callback
				'cpt-bootstrap-carousel' // Page
		);
		add_settings_section(
				'cptbc_settings_link_buttons', // ID
				__('Кнопка с ссылкой', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'cptbc_settings_link_buttons_header' ), // Callback
				'cpt-bootstrap-carousel' // Page
		);
		add_settings_section(
				'cptbc_settings_markup', // ID
				__('Пользовательская разметка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'cptbc_settings_markup_header' ), // Callback
				'cpt-bootstrap-carousel' // Page
		);
        
		// Behaviour Fields
		add_settings_field(
				'interval', // ID
				__('Интервал прокручивания (милисекунды)', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'interval_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section
		);
		add_settings_field(
				'showcaption', // ID
				__('Заголовок и подзаголовок слайда', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'showcaption_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section		   
		);
		add_settings_field(
				'showcontrols', // ID
				__('Кнопки перелистывания', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'showcontrols_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section		   
		);
		add_settings_field(
				'orderby', // ID
				__('Сортировка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'orderby_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section		   
		);
		add_settings_field(
				'order', // ID
				__('Порядок сортировки', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'order_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section		   
		);
		add_settings_field(
				'category', // ID
				__('Ограничить категорию', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'category_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_behaviour' // Section		   
		);
        
        // Carousel Setup Section
		add_settings_field(
				'twbs', // ID
				__('Версия Twitter Bootstrap', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'twbs_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section		   
		);
		add_settings_field(
				'image_size', // ID
				__('Размер изображений', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'image_size_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section		   
		);
		
		add_settings_field(
				'use_background_images', // ID
				__('Изображение как фон блока', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'use_background_images_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section		   
		);
		add_settings_field(
				'background_images_height', // ID
				__('Высота при использовании фоновых изображений (px)', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'background_images_height_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section
		);
		add_settings_field(
				'background_images_style_size', // ID
				__('Режим показа фоновых изображений', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'background_images_style_size_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section
		);
		add_settings_field(
				'use_javascript_animation', // ID
				__('Использовать Javascript для анимирования карусели?', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'use_javascript_animation_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_setup' // Section		   
		);

		// Link buttons
		add_settings_field(
				'link_button', // ID
				__('Кнопки с ссылкой на слайде', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'link_button_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_text', // ID
				__('Стандартный текст для кнопок с ссылкой', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'link_button_text_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_class', // ID
				__('Class для кнопок с ссылками', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'link_button_class_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_before', // ID
				__('HTML тег ДО кнопок с ссылками', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'link_button_before_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_after', // ID
				__('HTML тег ПОСЛЕ кнопок с ссылками', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'link_button_after_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_link_buttons' // Section
		);
        
        // Markup Section
		add_settings_field(
				'customprev', // ID
				__('Свой class для кнопки НАЗАД', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'customprev_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
		add_settings_field(
				'customnext', // ID
				__('Свой class для кнопки ВПЕРЕД', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'customnext_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
		add_settings_field(
				'before_title', // ID
				__('HTML тег до заголовка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'before_title_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
		add_settings_field(
				'after_title', // ID
				__('HTML тег после заголовка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'after_title_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
		add_settings_field(
				'before_caption', // ID
				__('HTML тег до подзаголовка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'before_caption_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
		add_settings_field(
				'after_caption', // ID
				__('HTML тег после подзаголовка', 'cpt-bootstrap-carousel'), // Title
				array( $this, 'after_caption_callback' ), // Callback
				'cpt-bootstrap-carousel', // Page
				'cptbc_settings_markup' // Section
		);
			 
	}
			
	// Sanitize each setting field as needed -  @param array $input Contains all settings fields as array keys
	public function sanitize( $input ) {
		$new_input = array();
		foreach($input as $key => $var){
			if($key == 'twbs' || $key == 'interval' || $key == 'background_images_height'){
				$new_input[$key] = absint( $input[$key] );
			} else if ($key == 'link_button_before' || $key == 'link_button_after' || $key == 'before_title' || $key == 'after_title' || $key == 'before_caption' || $key == 'after_caption'){
				$new_input[$key] = $input[$key]; // Don't sanitise these, meant to be html!
			} else { 
				$new_input[$key] = sanitize_text_field( $input[$key] );
			}
		}
		return $new_input;
	}
			
	// Print the Section text
	public function cptbc_settings_behaviour_header() {
            echo '<p>'.__('Базовая настройка карусели, элементов управления и параметры изображений.', 'cpt-bootstrap-carousel').'</p>';
	}
	public function cptbc_settings_setup() {
            echo '<p>'.__('Функционал карусели.', 'cpt-bootstrap-carousel').'</p>';
	}
	public function cptbc_settings_link_buttons_header() {
            echo '<p>'.__('Параметры для использования кнопки с ссылкой, вместо ссылки на изображении.', 'cpt-bootstrap-carousel').'</p>';
	}
	public function cptbc_settings_markup_header() {
            echo '<p>'.__('Настройте, какие классы CSS и теги HTML использует карусель.', 'cpt-bootstrap-carousel').'</p>';
	}
			
	// Callback functions - print the form inputs
    // Carousel behaviour	
	public function interval_callback() {
			printf('<input type="text" id="interval" name="cptbc_settings[interval]" value="%s" size="15" />',
					isset( $this->options['interval'] ) ? esc_attr( $this->options['interval']) : '');
            echo '<p class="description">'.__('Интервал между пролистыванием слайдов. Установите значение 0, чтобы отключить анимацию.', 'cpt-bootstrap-carousel').'</p>';
	}
	public function showcaption_callback() {
		if(isset( $this->options['showcaption'] ) && $this->options['showcaption'] == 'false'){
			$cptbc_showcaption_t = '';
			$cptbc_showcaption_f = ' selected="selected"';
		} else {
			$cptbc_showcaption_t = ' selected="selected"';
			$cptbc_showcaption_f = '';
		}
		print '<select id="showcaption" name="cptbc_settings[showcaption]">
			<option value="true"'.$cptbc_showcaption_t.'>'.__('Показать', 'cpt-bootstrap-carousel').'</option>
			<option value="false"'.$cptbc_showcaption_f.'>'.__('Скрыть', 'cpt-bootstrap-carousel').'</option>
		</select>';
	}
	public function showcontrols_callback() {
		if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'false'){
			$cptbc_showcontrols_t = '';
			$cptbc_showcontrols_f = ' selected="selected"';
			$cptbc_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'true'){
			$cptbc_showcontrols_t = ' selected="selected"';
			$cptbc_showcontrols_f = '';
			$cptbc_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'custom'){
			$cptbc_showcontrols_t = '';
			$cptbc_showcontrols_f = '';
			$cptbc_showcontrols_c = ' selected="selected"';
		}
		print '<select id="showcontrols" name="cptbc_settings[showcontrols]">
			<option value="true"'.$cptbc_showcontrols_t.'>'.__('Показать', 'cpt-bootstrap-carousel').'</option>
			<option value="false"'.$cptbc_showcontrols_f.'>'.__('Скрыть', 'cpt-bootstrap-carousel').'</option>
			<option value="custom"'.$cptbc_showcontrols_c.'>'.__('Ручной режим', 'cpt-bootstrap-carousel').'</option>
		</select>';
	}
	public function orderby_callback() {
		$orderby_options = array (
			'menu_order' => __('Так, как на странице настроек', 'cpt-bootstrap-carousel'),
			'date' => __('По дате публикации слайда', 'cpt-bootstrap-carousel'),
			'rand' => __('В случайном порядке', 'cpt-bootstrap-carousel'),
			'title' => __('По заголовку слайда', 'cpt-bootstrap-carousel')
		);
		print '<select id="orderby" name="cptbc_settings[orderby]">';
		foreach($orderby_options as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['orderby'] ) && $this->options['orderby'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
	public function order_callback() {
		if(isset( $this->options['order'] ) && $this->options['order'] == 'DESC'){
			$cptbc_showcontrols_a = '';
			$cptbc_showcontrols_d = ' selected="selected"';
		} else {
			$cptbc_showcontrols_a = ' selected="selected"';
			$cptbc_showcontrols_d = '';
		}
		print '<select id="order" name="cptbc_settings[order]">
			<option value="ASC"'.$cptbc_showcontrols_a.'>'.__('По возрастанию', 'cpt-bootstrap-carousel').'</option>
			<option value="DESC"'.$cptbc_showcontrols_d.'>'.__('По убыванию', 'cpt-bootstrap-carousel').'</option>
		</select>';
	}
	public function category_callback() {
		$cats = get_terms('carousel_category');
		print '<select id="orderby" name="cptbc_settings[category]">
			<option value="">'.__('Все категории', 'cpt-bootstrap-carousel').'</option>';
		foreach($cats as $cat){
			print '<option value="'.$cat->name.'"';
			if(isset( $this->options['category'] ) && $this->options['category'] == $cat->name){
				print ' selected="selected"';
			}
			print ">".$cat->name."</option>";
		}
		print '</select>';
	}
	
    // Setup Section
	public function twbs_callback() {
		if(isset( $this->options['twbs'] ) && $this->options['twbs'] == '3'){
			$cptbc_twbs3 = ' selected="selected"';
			$cptbc_twbs2 = '';
		} else {
			$cptbc_twbs3 = '';
			$cptbc_twbs2 = ' selected="selected"';
		}
		print '<select id="twbs" name="cptbc_settings[twbs]">  
			<option value="3"'.$cptbc_twbs3.'>v4.0.0-alpha.6 (по умолчанию)</option>
		</select>';
        echo '<p class="description">'.__("Укажите версию используемого Bootstrap фреймворка.", 'cpt-bootstrap-carousel').'</p>';
	}
	public function image_size_callback() {
		$image_sizes = get_intermediate_image_sizes();
		print '<select id="image_size" name="cptbc_settings[image_size]">
			<option value="full"';
			if(isset( $this->options['image_size'] ) && $this->options['image_size'] == 'full'){
				print ' selected="selected"';
			}
			echo '>Оригинал (по умолчанию)</option>';
		foreach($image_sizes as $size){
			print '<option value="'.$size.'"';
			if(isset( $this->options['image_size'] ) && $this->options['image_size'] == $size){
				print ' selected="selected"';
			}
			print ">".ucfirst($size)."</option>";
		}
		print '</select>';
        echo '<p class="description">'.__("Уменьшение размера картинки ускорит загрузку страницы.", 'cpt-bootstrap-carousel').'</p>';
	}
	public function use_background_images_callback() {
		print '<select id="use_background_images" name="cptbc_settings[use_background_images]">';
		print '<option value="0"';
		if(isset( $this->options['use_background_images'] ) && $this->options['use_background_images'] == 0){
			print ' selected="selected"';
		}
		echo '>Нет (по умолчанию)</option>';
		print '<option value="1"';
		if(isset( $this->options['use_background_images'] ) && $this->options['use_background_images'] == 1){
			print ' selected="selected"';
		}
		echo '>Да</option>';
		print '</select>';
        echo '<p class="description">'.__("Позволяет заполнять изображению все пространство равномерно. По умолчанию картинки отображаются в теге 'img'", 'cpt-bootstrap-carousel').'</p>';
	}
	public function background_images_height_callback() {
		printf('<input type="text" id="background_images_height" name="cptbc_settings[background_images_height]" value="%s" size="15" />',
				isset( $this->options['background_images_height'] ) ? esc_attr( $this->options['background_images_height']) : '500px');
        echo '<p class="description">'.__("Высота карусели при использовании фонового режима", 'cpt-bootstrap-carousel').'</p>';
	}

	public function use_javascript_animation_callback() {
		print '<select id="use_javascript_animation" name="cptbc_settings[use_javascript_animation]">';
		print '<option value="1"';
		if(isset( $this->options['use_javascript_animation'] ) && $this->options['use_javascript_animation'] == 1){
			print ' selected="selected"';
		}
		echo '>Да (по умолчанию)</option>';
		print '<option value="0"';
		if(isset( $this->options['use_javascript_animation'] ) && $this->options['use_javascript_animation'] == 0){
			print ' selected="selected"';
		}
		echo '>Нет</option>';
		print '</select>';
        echo '<p class="description">'.__("Карусель Bootstrap создана для работы с атрибутами данных. Иногда анимация работает неправильно, поэтому по умолчанию будет включена небольшая часть Javascript для запуска карусели. Вы можете не включать это здесь.", 'cpt-bootstrap-carousel').'</p>';
	}
	public function background_images_style_size_callback() {
		print '<select id="select_background_images_style_size" name="cptbc_settings[select_background_images_style_size]">';
		print '<option value="cover"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'cover'){
			print ' selected="selected"';
		}
		echo '>Cover (по умолчанию)</option>';
		print '<option value="contain"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'contain'){
			print ' selected="selected"';
		}
		echo '>Contain</option>';
		print '<option value="auto"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'auto'){
			print ' selected="selected"';
		}
		echo '>Авто</option>';
		print '</select>';
        echo '<p class="description">'.__('Если вы обнаружите, что изображения масштабируются не правильно в режиме фона, попробуйте переключить стиль на \'contain\' или \'авто\'', 'cpt-bootstrap-carousel').'</p>';
	}

	// Link buttons section
	public function link_button_callback(){
		print '<select id="link_button" name="cptbc_settings[link_button]">';
		print '<option value="1"';
		if(isset( $this->options['link_button'] ) && $this->options['link_button'] == 1){
			print ' selected="selected"';
		}
		echo '>Да</option>';
		print '<option value="0"';
		if(!isset( $this->options['link_button'] ) || $this->options['link_button'] == 0){
			print ' selected="selected"';
		}
		echo '>Нет (по умолчанию)</option>';
		print '</select>';
		echo '<p class="description">'.__("Если для слайда задана сслыка, этот параметр создаст кнопку в заголовке, без привязки к изображению", 'cpt-bootstrap-carousel').'</p>';
	}
	public function link_button_text_callback() {
			printf('<input type="text" id="link_button_text" name="cptbc_settings[link_button_text]" value="%s" size="20" />',
					isset( $this->options['link_button_text'] ) ? esc_attr( $this->options['link_button_text']) : 'Read more');
	}
	public function link_button_class_callback() {
			printf('<input type="text" id="link_button_class" name="cptbc_settings[link_button_class]" value="%s" size="20" />',
					isset( $this->options['link_button_class'] ) ? esc_attr( $this->options['link_button_class']) : 'btn btn-default pull-right');
			echo '<p class="description">'.__("Кнопки из Bootstrap обязательно должны иметь class <code>btn</code> и еще один этих: <code>btn-default</code>, <code>btn-primary</code>, <code>btn-success</code>, <code>btn-warning</code>, <code>btn-danger</code> или <code>btn-info</code><br><code>pull-right</code> - закрепить кнопку справа.", 'cpt-bootstrap-carousel');
	}
	public function link_button_before_callback() {
			printf('<input type="text" id="link_button_before" name="cptbc_settings[link_button_before]" value="%s" size="20" />',
					isset( $this->options['link_button_before'] ) ? esc_attr( $this->options['link_button_before']) : '');
	}
	public function link_button_after_callback() {
			printf('<input type="text" id="link_button_after" name="cptbc_settings[link_button_after]" value="%s" size="20" />',
					isset( $this->options['link_button_after'] ) ? esc_attr( $this->options['link_button_after']) : '');
	}
    
    // Markup section
	public function before_title_callback() {
			printf('<input type="text" id="before_title" name="cptbc_settings[before_title]" value="%s" size="15" />',
					isset( $this->options['before_title'] ) ? esc_attr( $this->options['before_title']) : '<h4>');
	}
	public function customnext_callback() {
			printf('<input type="text" id="customnext" name="cptbc_settings[customnext]" value="%s" size="15" />',
					isset( $this->options['customnext'] ) ? esc_attr( $this->options['customnext']) : '');
	}
	public function customprev_callback() {
			printf('<input type="text" id="customprev" name="cptbc_settings[customprev]" value="%s" size="15" />',
					isset( $this->options['customprev'] ) ? esc_attr( $this->options['customprev']) : '');
	}
	public function after_title_callback() {
			printf('<input type="text" id="after_title" name="cptbc_settings[after_title]" value="%s" size="15" />',
					isset( $this->options['after_title'] ) ? esc_attr( $this->options['after_title']) : '</h4>');
	}
	public function before_caption_callback() {
			printf('<input type="text" id="before_caption" name="cptbc_settings[before_caption]" value="%s" size="15" />',
					isset( $this->options['before_caption'] ) ? esc_attr( $this->options['before_caption']) : '<p>');
	}
	public function after_caption_callback() {
			printf('<input type="text" id="after_caption" name="cptbc_settings[after_caption]" value="%s" size="15" />',
					isset( $this->options['after_caption'] ) ? esc_attr( $this->options['after_caption']) : '</p>');
	}	
	
}

if( is_admin() ){
		$cptbc_settings_page = new cptbc_settings_page();
}

// Add settings link on plugin page
function cptbc_settings_link ($links) { 
	$settings_link = '<a href="edit.php?post_type=cptbc&page=cpt-bootstrap-carousel">'.__('Settings', 'cpt-bootstrap-carousel').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$cptbc_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$cptbc_plugin", 'cptbc_settings_link' );
