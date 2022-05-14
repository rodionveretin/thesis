<?php

/**
 * The template for displaying product content in the single-product.php template
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>



<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<div class="product-item__wrapper">
		<div class="product-item__images product-images">
			<div class="product-images__preview"><img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?> " /></div>
			<div class="swiper product-gallery">
				<div class="swiper-wrapper">
					<div class="swiper-slide product-gallery__slide">
						<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?> " />
					</div>
					<div class="swiper-slide product-gallery__slide">
						<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?> " />
					</div>
					<div class="swiper-slide product-gallery__slide">
						<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?> " />
					</div>
				</div>
				<div class="product-gallery__prev">&#x25C4;</div>
				<div class="product-gallery__next">&#x25BA;</div>
			</div>
		</div>
		<div class="product-item__info">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action('woocommerce_single_product_summary');
			?>
		</div>
	</div>

	<?php do_action('woocommerce_after_single_product_custom'); ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>