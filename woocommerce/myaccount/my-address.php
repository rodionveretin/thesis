<?php

/**
 * Аккаунт: адрес.
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __('Billing address', 'woocommerce'),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __('Billing address', 'woocommerce'),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

<?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
	<?php endif; ?>

	<?php foreach ($get_addresses as $name => $address_title) : ?>
		<?php
		$address = wc_get_account_formatted_address($name);
		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
		?>

		<div class="u-column<?php echo $col < 0 ? 1 : 2; ?> col-<?php echo $oldcol < 0 ? 1 : 2; ?> woocommerce-Address">
			<header class="addresses__wrapper">
				<h3 class="addresses__title">Адрес доставки</h3>
				<a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>" class="addresses__edit">Изменить</a>
			</header>
			<address>
				<?php
				echo $address ? wp_kses_post($address) : esc_html_e('Вы ещё не указывали адрес доставки.');
				?>
			</address>
		</div>

	<?php endforeach; ?>

	<?php if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>
	</div>
<?php
	endif;
