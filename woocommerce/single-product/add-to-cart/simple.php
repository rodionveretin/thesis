<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
		do_action('woocommerce_before_add_to_cart_quantity');

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
				'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
				'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action('woocommerce_after_add_to_cart_quantity');
		?>
		<div class="product-item__wrapper-buttons">
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="theme-button"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
			<?php
			if (is_user_logged_in()) :
				$favorite = false;
				if (metadata_exists('user', get_current_user_id(), 'favorite')) {
					$arr = get_user_meta(get_current_user_id(), 'favorite')[0];
					$product_id = $product->get_id();
					$favorite = in_array($product_id, $arr);
				}
			?>
				<div class="interactions__favourites favorites-button product-item__favorites" title="Добавить в избранное">
					<button aria-label="Добавить в избранное">
						<svg class="favorites-button__icon__not <?php if ($favorite) echo "hidden"; ?>" width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.16 2.00004C18.1 0.937251 16.6948 0.288583 15.1984 0.171213C13.7019 0.0538432 12.2128 0.475509 11 1.36004C9.72769 0.413681 8.14402 -0.0154454 6.56795 0.159081C4.99188 0.333607 3.54047 1.09882 2.506 2.30063C1.47154 3.50244 0.930854 5.05156 0.992833 6.63606C1.05481 8.22055 1.71485 9.72271 2.84003 10.84L9.05003 17.06C9.57005 17.5718 10.2704 17.8587 11 17.8587C11.7296 17.8587 12.43 17.5718 12.95 17.06L19.16 10.84C20.3276 9.66531 20.983 8.07632 20.983 6.42004C20.983 4.76377 20.3276 3.17478 19.16 2.00004ZM17.75 9.46004L11.54 15.67C11.4694 15.7414 11.3853 15.798 11.2926 15.8367C11.1999 15.8753 11.1005 15.8953 11 15.8953C10.8996 15.8953 10.8002 15.8753 10.7075 15.8367C10.6148 15.798 10.5307 15.7414 10.46 15.67L4.25003 9.43004C3.46579 8.62839 3.02664 7.55151 3.02664 6.43004C3.02664 5.30858 3.46579 4.2317 4.25003 3.43004C5.04919 2.64103 6.127 2.19861 7.25003 2.19861C8.37306 2.19861 9.45088 2.64103 10.25 3.43004C10.343 3.52377 10.4536 3.59817 10.5755 3.64893C10.6973 3.6997 10.828 3.72584 10.96 3.72584C11.092 3.72584 11.2227 3.6997 11.3446 3.64893C11.4665 3.59817 11.5771 3.52377 11.67 3.43004C12.4692 2.64103 13.547 2.19861 14.67 2.19861C15.7931 2.19861 16.8709 2.64103 17.67 3.43004C18.4651 4.22119 18.9186 5.29223 18.9336 6.41373C18.9485 7.53522 18.5237 8.61798 17.75 9.43004V9.46004Z" fill="#C8CACB" />
						</svg>
						<svg class="favorites-button__icon-added <?php if (!$favorite) echo "hidden"; ?>" width="21" height="18" viewBox="0 0 21 18" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.16 2.00004C18.1 0.937251 16.6948 0.288583 15.1984 0.171213C13.7019 0.0538432 12.2128 0.475509 11 1.36004C9.72769 0.413681 8.14402 -0.0154454 6.56795 0.159081C4.99188 0.333607 3.54047 1.09882 2.506 2.30063C1.47154 3.50244 0.930854 5.05156 0.992833 6.63606C1.05481 8.22055 1.71485 9.72271 2.84003 10.84L9.05003 17.06C9.57005 17.5718 10.2704 17.8587 11 17.8587C11.7296 17.8587 12.43 17.5718 12.95 17.06L19.16 10.84C20.3276 9.66531 20.983 8.07632 20.983 6.42004C20.983 4.76377 20.3276 3.17478 19.16 2.00004Z" fill="#F15152" />
						</svg>
					</button>
				</div>
			<?php endif; ?>
		</div>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>


	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>