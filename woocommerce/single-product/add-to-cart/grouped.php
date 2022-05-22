<?php

/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.8.0
 */

defined('ABSPATH') || exit;

global $product, $post;

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="cart grouped_form" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
		<tbody>
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters(
				'woocommerce_grouped_product_columns',
				array(
					'quantity',
					'label',
					'price',
				),
				$product
			);
			$show_add_to_cart_button = false;

			do_action('woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product);

			foreach ($grouped_products as $grouped_product_child) {
				$post_object        = get_post($grouped_product_child->get_id());
				$quantites_required = $quantites_required || ($grouped_product_child->is_purchasable() && !$grouped_product_child->has_options());
				$post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata($post);

				if ($grouped_product_child->is_in_stock()) {
					$show_add_to_cart_button = true;
				}

				echo '<tr id="product-' . esc_attr($grouped_product_child->get_id()) . '" class="woocommerce-grouped-product-list-item ' . esc_attr(implode(' ', wc_get_product_class('', $grouped_product_child))) . '">';

				// Output columns for each product.
				foreach ($grouped_product_columns as $column_id) {
					do_action('woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child);

					switch ($column_id) {
						case 'quantity':
							ob_start();

							if (!$grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || !$grouped_product_child->is_in_stock()) {
								woocommerce_template_loop_add_to_cart();
							} elseif ($grouped_product_child->is_sold_individually()) {
								echo '<input type="checkbox" name="' . esc_attr('quantity[' . $grouped_product_child->get_id() . ']') . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
							} else {
								do_action('woocommerce_before_add_to_cart_quantity');

								woocommerce_quantity_input(
									array(
										'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
										'input_value' => isset($_POST['quantity'][$grouped_product_child->get_id()]) ? wc_stock_amount(wc_clean(wp_unslash($_POST['quantity'][$grouped_product_child->get_id()]))) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
										'min_value'   => apply_filters('woocommerce_quantity_input_min', 0, $grouped_product_child),
										'max_value'   => apply_filters('woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child),
										'placeholder' => '0',
									)
								);

								do_action('woocommerce_after_add_to_cart_quantity');
							}

							$value = ob_get_clean();
							break;
						case 'label':
							$value  = '<label for="product-' . esc_attr($grouped_product_child->get_id()) . '">';
							$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url(apply_filters('woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id())) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
							$value .= '</label>';
							break;
						case 'price':
							$value = $grouped_product_child->get_price_html() . wc_get_stock_html($grouped_product_child);
							break;
						default:
							$value = '';
							break;
					}

					echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr($column_id) . '">' . apply_filters('woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					do_action('woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child);
				}

				echo '</tr>';
			}
			$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata($post);

			do_action('woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product);
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />

	<?php if ($quantites_required && $show_add_to_cart_button) : ?>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<div class="product-item__wrapper-buttons">
			<button type="submit" class="theme-button"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
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

			<?php do_action('woocommerce_after_add_to_cart_button'); ?>

		<?php endif; ?>
		</div>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>