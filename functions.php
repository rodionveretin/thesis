<?php

/**
 * Функции и определения
 */

// Номер версии
if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}
/**
 * Настройка темы по умолчанию и регистрирация поддержки различных функций WordPress.
 */
function thesis_setup()
{


	// Добавление возможности изменять заголовок страницы.
	add_theme_support('title-tag');

	// Добавление возможности устанавливать миниатюру посту.
	add_theme_support('post-thumbnails');

	// Регистрация областей меню темы
	register_nav_menus(
		array(
			'header_menu' => esc_html__('Меню в шапке', 'thesis'),
			'footer_menu' => esc_html__('Меню в подвале', 'thesis'),
		)
	);

	// Включает поддержку html5 разметки для списка комментариев.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Включает поддержку возможности изменения фонового цвета.
	add_theme_support(
		'custom-background',
		apply_filters(
			'thesis_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Включает поддержку выборочного обновления для виджетов.
	add_theme_support('customize-selective-refresh-widgets');

	//	Добавление возможности устанавливать свой логотип.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 65,
			'width'       => 185,
			'flex-width'  => false,
			'flex-height' => false,
			'header-text' => '',
			'unlink-homepage-logo' => false,
		)
	);
}
add_action('after_setup_theme', 'thesis_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thesis_content_width()
{
	$GLOBALS['content_width'] = apply_filters('thesis_content_width', 640);
}
add_action('after_setup_theme', 'thesis_content_width', 0);

/**
 * Регистрация области виджетов.
 */
function thesis_widgets_init()
{

	register_sidebar(
		array(
			'name'          => esc_html__('Фильтрация', 'thesis'),
			'id'            => 'filter-category',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'thesis_widgets_init');

/**
 * Подключение скриптов и стилей страницы.
 */
function thesis_scripts()
{
	wp_enqueue_style('main', get_stylesheet_uri());
	wp_enqueue_style('thesis', get_template_directory_uri() . '/assets/css/style.css', array('main'), null, 'all');



	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.6.0.min.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('ajax', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', null, true);

	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', null, true);
	wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), null, true);

	wp_enqueue_script('wp-api');
}
add_action('wp_enqueue_scripts', 'thesis_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Регистрация настроек темы
 */

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Настройки сайта',
		'menu_title' => 'Настройки сайта',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
		'position' => 59.5,
		'icon_url' => 'dashicons-layout'
	));
}

/**
 * Добавление тикетов
 */
add_action('init', 'tickets_register_post_type_init');

function tickets_register_post_type_init()
{

	$labels = array(
		'name' => 'Обратная связь',
		'singular_name' => 'Тикет',
		'add_new' => 'Добавить тикет',
		'add_new_item' => 'Добавить тикет',
		'edit_item' => 'Редактировать тикет',
		'new_item' => 'Новый тикет',
		'all_items' => 'Все тикеты',
		'search_items' => 'Искать тикеты',
		'not_found' =>  'Тикетов по заданным критериям не найдено.',
		'not_found_in_trash' => 'В корзине нет тикетов.',
		'menu_name' => 'Обратная связь'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-email-alt2',
		'menu_position' => 2,
		'supports' => array('title', 'editor', 'comments')
	);

	register_post_type('tickets', $args);
	flush_rewrite_rules(false);
}

add_filter('post_updated_messages', 'tickets_post_type_messages');

function tickets_post_type_messages($messages)
{

	global $post, $post_ID;

	$messages['tickets'] = array(
		0 => '',
		1 => 'Тикет обновлён.',
		2 => 'Поле изменено.',
		3 => 'Поле удалено.',
		4 => 'Тикет обновлён.',
		5 => isset($_GET['revision']) ? sprintf('Тикет восстановлен из редакции из редакции: %s', wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => 'Тикет добавлен.',
		7 => 'Тикет сохранён.',
		8 => 'Отправлено на проверку.',
		9 => sprintf('Тикет запланирован на публикацию на <strong>%1$s</strong>.', date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date))),
		10 => 'Черновик тикета сохранён',
	);

	return $messages;
}


if (function_exists('acf_add_local_field_group')) {

	acf_add_local_field_group(array(
		'key' => 'group_62402c68a2190',
		'title' => 'Слайдер на главной странице',
		'fields' => array(
			array(
				'key' => 'field_62402c72f419b',
				'label' => 'Слайдер',
				'name' => 'slider',
				'type' => 'flexible_content',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layouts' => array(
					'layout_62402c8258860' => array(
						'key' => 'layout_62402c8258860',
						'name' => 'slide',
						'label' => 'Слайд',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_62403bb1f419c',
								'label' => 'Ссылка',
								'name' => 'slide_link',
								'type' => 'link',
								'instructions' => 'Добавьте ссылку на новость(акцию), или страницу',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'url',
							),
							array(
								'key' => 'field_62403c1af419d',
								'label' => 'Заголовок слайда',
								'name' => 'slide_title',
								'type' => 'text',
								'instructions' => 'Добавьте короткий заголовок для слайда',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_62403c4af419e',
								'label' => 'Подзаголовок слайда',
								'name' => 'slide_subtitle',
								'type' => 'text',
								'instructions' => 'Добавьте короткий подзаголовок для слайда',
								'required' => 0,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_62403c1af419d',
											'operator' => '!=empty',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
							array(
								'key' => 'field_62403c77f419f',
								'label' => 'Картинка в слайде',
								'name' => 'slide_img',
								'type' => 'image',
								'instructions' => 'Добавьте картинку',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'array',
								'preview_size' => 'medium',
								'library' => 'all',
								'min_width' => '',
								'min_height' => '',
								'min_size' => '',
								'max_width' => '',
								'max_height' => '',
								'max_size' => '',
								'mime_types' => '',
							),
						),
						'min' => '',
						'max' => '',
					),
				),
				'button_label' => 'Добавить',
				'min' => '',
				'max' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '166',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_62851c2987ddc',
		'title' => 'Номера телефонов в подвале',
		'fields' => array(
			array(
				'key' => 'field_62851c32422f4',
				'label' => 'Номера телефонов',
				'name' => 'phone_numbers',
				'type' => 'repeater',
				'instructions' => 'Введите до 2 номеров телефонов',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 2,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_62851c7b422f5',
						'label' => 'Номер телефона в формате +78001234567',
						'name' => 'number',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-general-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_62851e37567bc',
		'title' => 'Адреса',
		'fields' => array(
			array(
				'key' => 'field_62851e43022ae',
				'label' => '',
				'name' => 'addresses',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 3,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_62851e53022af',
						'label' => 'Адрес',
						'name' => 'address',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-general-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_62851db3a8af1',
		'title' => 'Режим работы',
		'fields' => array(
			array(
				'key' => 'field_62851dd70fb19',
				'label' => 'Режим работы',
				'name' => 'work_time',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-general-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
}


/**
 * Добавление поддержки WooCommerce.
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	add_action('after_setup_theme', 'woocommerce_support');
	function woocommerce_support()
	{
		add_theme_support('woocommerce');
	}
}


/**
 * Инициализация корзины для REST API.
 */
add_action('woocommerce_init', 'my_function');
function my_function()
{
	if (!WC()->is_rest_api_request()) {
		return;
	}

	WC()->frontend_includes();

	if (null === WC()->cart && function_exists('wc_load_cart')) {
		wc_load_cart();
	}
}

/**
 * Добавление списка избранного в аккаунт и отключение ненужных пунктов меню.
 */

add_filter('woocommerce_account_menu_items', 'thesis_my_account_links', 25);

function thesis_my_account_links($menu_links)
{
	unset($menu_links['downloads']);
	unset($menu_links['customer-logout']);
	$menu_links['dashboard'] = 'Общие сведения';
	$menu_links['edit-account'] = 'Личные данные';
	$menu_links['orders'] = 'История покупок';
	$menu_links['favorites'] = 'Избранное';
	$menu_links['tickets'] = 'Обратная связь';
	$menu_links['customer-logout'] = 'Выход';
	return $menu_links;
}

add_action('init', 'thesis_add_endpoint', 25);
function thesis_add_endpoint()
{
	add_rewrite_endpoint('favorites', EP_PAGES);
	add_rewrite_endpoint('tickets', EP_PAGES);
}

add_action('woocommerce_account_favorites_endpoint', 'favorites_content', 25);
function favorites_content()
{
	$user_id = get_current_user_id();
	$favorites_content = '';
	if (metadata_exists('user', $user_id, 'favorite') && get_user_meta($user_id, 'favorite')[0]) {
		$arr = get_user_meta($user_id, 'favorite')[0];
		$favorites_content .=
			'
		<div class="favorites">
			<div class="favorites__content">
		';
		foreach ($arr as $key => $value) {

			$product = wc_get_product($value);
			$favorites_content .=
				'
			<div class="favorites__item" data-id="' . $product->get_id() . '">
				<div class="favorites__img"><img src="' . wp_get_attachment_url($product->get_image_id()) . '" alt="' . $product->get_name() . '"></div>
				<div class="favorites__title"><a href="' . $product->get_permalink() . '" target="_blank">' . $product->get_name() . '</a></div>
			</div>
			';
		}

		$favorites_content .= '
			</div>
		</div>
		';
	} else {
		$favorites_content =
			'
		<div class="favorites">
			<div class="favorites__content">
				<div class="favorites__message">Ваш список избранного пуст</div>
			</div>
		</div>		
		';
	}
	echo $favorites_content;
}

add_action('woocommerce_account_tickets_endpoint', 'tickets_content', 25);
function tickets_content()
{
	$user_id = get_current_user_id();
	$args = array(
		'post_type'      => 'tickets',
		'posts_per_page' => 10,
		'author'         => $user_id,
		'post_status' => array('publish', 'trash'),

	);
	$query = new WP_Query($args);
	$tickets_content = '
	<div class="tickets-modal">
		<div class="tickets-modal__close">✖</div>
		<form action="" method="post">
			<input id="title" class="tickets-modal__title" placeholder="Тема" required>
			<textarea name="message" id="message" class="tickets-modal__message" placeholder="Сообщение" required></textarea>
			<input type="submit" class="tickets-modal__submit theme-button"></input>
		</form>

	</div>

	<button class="ticket-add theme-button">Открыть новый тикет</button>
	
	<div class="tickets">';

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$status = get_post_status();
			if ($status == 'publish') {
				$status = 'Открыт';
				$link = '<a href="' . get_permalink() . '">' . get_the_title() .  '</a>';
				$button = '<div class="tickets__close"><button class="tickets__close-button">✖</button></div>';
			} else {
				$status = 'Закрыт';
				$link = get_the_title();
				$button = '';
			}

			$tickets_content .= '
			<div class="tickets__item" data-ticket="' . get_the_ID()  . '">
				' . $button . '
				<div class="tickets__title">' . $link . '</div>
				<div class="tickets__status">' . $status .  '</div>
				<div class="tickets__date">' . get_the_date() .  '</div>
			</div>
			';

			wp_reset_postdata();
		}
	} else {
		$tickets_content .= '
		</div>';
	}


	echo $tickets_content;
}


/**
 * Отключение логотипа в админ-панели.
 */
function admin_bar_remove_logo()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_logo', 0);

function custom_change_admin_label()
{
	global $menu;
	$menu['55.5'][0] = 'Магазин';
}
add_action('admin_menu', 'custom_change_admin_label');

/**
 * Отключение лишних ролей.
 */
function roles_deactivate()
{
	remove_role('author');
	remove_role('subscriber');
	remove_role('editor');
	remove_role('contributor');
}
add_action('init', 'roles_deactivate');



/**
 * Редактирование хлебных крошек.
 */
add_filter('woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs');
function jk_woocommerce_breadcrumbs()
{
	return array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="breadcrumbs" itemprop="breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x('Home', 'breadcrumb', 'woocommerce'),
	);
}


/*
 * Регистрирация новых REST маршрутов.
 */
add_action('rest_api_init', function () {

	// Регистрирует маршрут REST API для добавления товара в избранное.
	register_rest_route('favourites/v1', 'get_favourites/', array(
		'methods'  => 'POST',
		'callback' => 'favourites',
	));

	// Регистрирует маршрут REST API для добавления товара в корзину.
	register_rest_route('cart/v1', 'add_to_cart/', array(
		'methods'  => 'POST',
		'callback' => 'add_to_cart',
	));

	// Регистрирует маршрут REST API для подгрузки новостей.
	register_rest_route('news/v1', 'get_news/', array(
		'methods'  => 'POST',
		'callback' => 'get_news',
	));

	// Регистрирует маршрут REST API для отправки тикета.
	register_rest_route('tickets/v1', 'add_ticket/', array(
		'methods'  => 'POST',
		'callback' => 'add_ticket',
	));

	// Регистрирует маршрут REST API для отправки ответа на тикет.
	register_rest_route('tickets/v1', 'add_ticket_answer/', array(
		'methods'  => 'POST',
		'callback' => 'add_ticket_answer',
	));

	// Регистрирует маршрут REST API для закрытия тикета.
	register_rest_route('tickets/v1', 'ticket_close/', array(
		'methods'  => 'POST',
		'callback' => 'ticket_close',
	));

});


/*
 * Функция обработчик конечной точки для добавления товара в избранное.
 */
function favourites(WP_REST_Request $request)
{
	$product_id = trim($request->get_param('productId'));
	$user_id =	trim($request->get_param('userId'));

	if (metadata_exists('user', $user_id, 'favorite')) {
		$arr = get_user_meta($user_id, 'favorite')[0];
		if (in_array($product_id, $arr)) {
			foreach ($arr as $key => $item) {
				if ($item == $product_id) {
					unset($arr[$key]);
				}
			}
			update_user_meta($user_id, 'favorite', $arr);
			$operation = 'remove';
		} else {
			$arr[] = $product_id;
			update_user_meta($user_id, 'favorite', $arr);
			$operation = 'add';
		}
	} else {
		$arr[] = $product_id;
		update_user_meta($user_id, 'favorite', $arr);
		$operation = 'add';
	}

	$result = [
		'id' => $arr,
		'operation' => $operation,
	];

	return $result;
}

/*
 * Функция обработчик конечной точки для добавления товара в корзину.
 */
function add_to_cart(WP_REST_Request $request)
{
	$product_id = trim($request->get_param('productId'));

	return WC()->cart->add_to_cart($product_id);
}


/*
 * Функция обработчик конечной точки для отправки тикета.
 */
function add_ticket(WP_REST_Request $request)
{
	$user_id =	trim($request->get_param('userId'));
	$title = trim($request->get_param('title'));
	$message = trim($request->get_param('message'));

	$post_data = array(
		'post_title'    => $title,
		'post_content'  => $message,
		'post_status'   => 'publish',
		'post_type'     => 'tickets',
		'post_author'   => $user_id,
		'ping_status'   => 'open',
		'comment_status' => 'open',
		'post_parent'   => 0,
		'menu_order'    => 0,
		'to_ping'       => '',
		'pinged'        => '',
		'post_password' => '',
		'post_excerpt'  => '',
		'meta_input'    => ['meta_key' => 'meta_value'],
	);

	$post_id = wp_insert_post(wp_slash($post_data));

	return true;
}

function add_ticket_answer(WP_REST_Request $request)
{
	$user_id =	trim($request->get_param('userId'));
	$message = trim($request->get_param('message'));
	$ticket_id = trim($request->get_param('ticketId'));
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$data = [
		'comment_post_ID'      => $ticket_id,
		'comment_author'       => get_userdata($user_id)->user_login,
		'comment_content'      => $message,
		'comment_type'         => 'comment',
		'comment_parent'       => 0,
		'comment_agent'        => $agent,
		'user_id'              => $user_id,
		'comment_date'         => current_time('mysql'),
		'comment_approved'     => 1,
	];

	wp_insert_comment(wp_slash($data));

	return true;
}



function ticket_close(WP_REST_Request $request)
{
	$ticket_id = trim($request->get_param('ticketId'));
	wp_trash_post($ticket_id);
	return $ticket_id;
}


function get_news(WP_REST_Request $request)
{
	$page = trim($request->get_param('page'));
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 4,
		'paged' => $page
	);


	$query = new WP_Query($args);
	$html = '';

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$html .= '<div class="blog__item">';
			if (has_post_thumbnail()) {
				$html .= '<div class="blog__img">' . get_the_post_thumbnail() . '</div>';
			}
			$html .=
				'
				<div class="blog__content">
                  <h3 class="blog__title">' . esc_html(get_the_title()) . '</h3>
                  <div class="blog__text">' . get_the_content() . '</div>
                  <div class="blog__bottom">
                     <span class="blog__link"><a href="' . esc_html(get_the_permalink()) . '">Подробнее</a></span>
                     <span class="blog__date">' . esc_html(get_the_date()) . '</span>
                  </div>
               </div>
            </div>
				';
		}
		wp_reset_postdata();
	}


	$result = [
		'html' => $html,
		'count' => $query->max_num_pages,
	];

	wp_reset_postdata();
	return $result;
}





add_action('woocommerce_after_single_product_custom', 'woocommerce_output_product_data_tabs', 10);

add_action('woocommerce_product_info_custom', 'woocommerce_template_single_title', 5);
add_action('woocommerce_product_info_custom', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_product_info_custom', 'woocommerce_template_single_price', 10);
add_action('woocommerce_product_info_custom', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_product_info_custom', 'woocommerce_template_single_meta', 30);
add_action('woocommerce_product_info_custom', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_product_info_price', 'woocommerce_template_single_add_to_cart', 10);

function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	}

	return array();
}

function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{

	if ('dns-prefetch' == $relation_type) {
		$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
		foreach ($urls as $key => $url) {
			if (strpos($url, $emoji_svg_url_bit) !== false) {
				unset($urls[$key]);
			}
		}
	}

	return $urls;
}
