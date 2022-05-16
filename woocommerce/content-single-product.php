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
			<div class="product-images__preview">
				<?php if ($product->get_image_id()) : ?>
					<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?>" />
				<?php else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.png" alt="<?php echo $product->get_name(); ?>" />
				<?php endif; ?>

			</div>
			<?php if ($product->get_gallery_image_ids()) : ?>
				<div class="product-item__slider">
					<div class="product-gallery__prev">&#x25C4;</div>
					<div class="swiper product-gallery">
						<div class="swiper-wrapper">
							<div class="swiper-slide product-gallery__slide">
								<?php if ($product->get_image_id()) : ?>
									<img src="<?php echo wp_get_attachment_url($product->get_image_id()); ?>" alt="<?php echo $product->get_name(); ?>" class="product-gallery__slide--active" />
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/placeholder.png" alt="<?php echo $product->get_name(); ?>" class="product-gallery__slide--active" />
								<?php endif; ?>
							</div>
							<?php
							$attachment_ids = $product->get_gallery_image_ids();
							foreach ($attachment_ids as $attachment_id) {
							?>
								<div class="swiper-slide product-gallery__slide">
									<?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
								</div>

							<?php
							}
							?>
						</div>
					</div>
					<div class="product-gallery__next">&#x25BA;</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="product-item__info">
			<?php
			the_title('<h1 class="product_title entry-title">', '</h1>');
			?>
			<div class="product-item__block">
				<div class="rating product-item__rating">
					<div class="rating__stars stars">
						<?php $rating = floor($product->get_average_rating());
						for ($i = 0; $i < $rating; $i++) :
						?>
							<svg class="stars__icon stars__icon--active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#EAEAF0" />
							</svg>
						<?php endfor; ?>
						<?php for ($i = 0; $i < 5 - $rating; $i++) :
						?>
							<svg class="stars__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#EAEAF0" />
							</svg>
						<?php endfor; ?>
					</div>
					<div class="rating__reviews">
						<a href="#reviews">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#070C11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
							<span class="rating__counter">(<?php echo $product->get_review_count(); ?>)</span>
						</a>
					</div>
				</div>
				<div class="prices product-item__prices">
					<?php if ($product->get_type() == 'simple') : ?>
						<?php if ($product->get_sale_price()) : ?>
							<del class="prices__old"><?php echo $product->get_regular_price(); ?> ₽</del>
							<span class="prices__new"><?php echo $product->get_sale_price(); ?> ₽</span>
						<?php else : ?>
							<span class="prices__new"><?php echo $product->get_regular_price(); ?> ₽</span>
						<?php endif; ?>
					<?php elseif ($product->get_type() == 'variable') : ?>
						<span class="prices__new"><?php echo $product->get_price_html(); ?></span>
					<?php elseif ($product->get_type() == 'grouped') : ?>
						<span class="prices__new"><?php echo $product->get_price_html(); ?></span>
					<?php endif; ?>
				</div>
				<?php do_action('woocommerce_product_info_price'); ?>
				<div class="product_meta">

					<?php do_action('woocommerce_product_meta_start'); ?>

					<?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>

						<span class="sku_wrapper"><?php esc_html_e('SKU:', 'woocommerce'); ?> <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span></span>

					<?php endif; ?>

					<?php do_action('woocommerce_product_meta_end'); ?>

				</div>
			</div>


			<?php
			/**
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			//do_action('woocommerce_product_info_custom');

			?>
		</div>
	</div>

	<?php do_action('woocommerce_after_single_product_custom'); ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>