<?php

/**
 * Шаблон отображения подкатегорий
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<li <?php wc_product_cat_class('', $category); ?>>
	<?php
	/**
	 * The woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action('woocommerce_before_subcategory', $category);

	$small_thumbnail_size = apply_filters('subcategory_archive_thumbnail_size', 'woocommerce_thumbnail');
	$dimensions           = wc_get_image_size($small_thumbnail_size);
	$thumbnail_id         = get_term_meta($category->term_id, 'thumbnail_id', true);

	if ($thumbnail_id) {
		$image        = wp_get_attachment_image_src($thumbnail_id, $small_thumbnail_size);
		$image        = $image[0];
		$image_srcset = function_exists('wp_get_attachment_image_srcset') ? wp_get_attachment_image_srcset($thumbnail_id, $small_thumbnail_size) : false;
		$image_sizes  = function_exists('wp_get_attachment_image_sizes') ? wp_get_attachment_image_sizes($thumbnail_id, $small_thumbnail_size) : false;
	} else {
		$image        = wc_placeholder_img_src();
		$image_srcset = false;
		$image_sizes  = false;
	}

	if ($image) {
		$image = str_replace(' ', '%20', $image);
	?>
		<img class="category__img" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" />
	<?php
	}

	/**
	 * The woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	?>

	<h2 class=" woocommerce-loop-category__title">
		<?php
		echo esc_html($category->name);
		?>
	</h2>

	<?php
	/**
	 * The woocommerce_after_subcategory_title hook.
	 */
	do_action('woocommerce_after_subcategory_title', $category);

	/**
	 * The woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action('woocommerce_after_subcategory', $category);
	?>
</li>