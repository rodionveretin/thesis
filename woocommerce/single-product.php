<?php

/**
 * Шаблон отображения товаров
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header('shop'); ?>

<div class="product-item" data-id="<?php the_ID(); ?>">
	<div class="container">
		<?php woocommerce_breadcrumb(); ?>
		<?php the_post(); ?>
		<?php wc_get_template_part('content', 'single-product'); ?>
	</div>
</div>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
