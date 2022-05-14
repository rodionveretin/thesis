<?php

/**
 * Панель управления аккаунтом
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="dashboard">
	<div class="dashboard__name"><?php echo ($current_user->display_name); ?></div>
	<p class="dashboard__block">
		Добро пожаловать в панель управления. Здесь вы можете изменить <a href="<?php echo wc_get_endpoint_url('edit-account'); ?>">свои регистрационные данные</a> или <a href="<?php echo wc_get_endpoint_url('edit-address'); ?>">свои регистрационные данные</a>.
	</p>

	<p class="dashboard__block">
		Зарегистрированные пользователи также имеют доступ к <a href="<?php echo wc_get_endpoint_url('orders'); ?>">истории заказов</a> и возможность <a href="<?php echo wc_get_endpoint_url('favorites'); ?>">добавлять в избранное товары для будущих покупок</a>.
	</p>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
