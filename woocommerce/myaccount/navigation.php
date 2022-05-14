<?php

/**
 * Навигационное меню аккаунта
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation account-navigation">
	<ul class="account-navigation__wrapper">
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<li class="account-navigation__item <?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>