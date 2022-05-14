<?php

/**
 * The Template for displaying all single products
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>


<div class="container">
	<div class="product-item">
		<?php woocommerce_breadcrumb(); ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php wc_get_template_part('content', 'single-product'); ?>
		<?php endwhile; // end of the loop. 
		?>
	</div>
</div>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
