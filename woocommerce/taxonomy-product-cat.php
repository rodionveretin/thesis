<?php

/**
 * Шаблон для отображения товаров в категории
 */

if (!defined('ABSPATH')) {
	exit;
}

?>

<?php get_header(); ?>


<div class="category">
	<div class="container">
		<?php
		woocommerce_breadcrumb();
		wc_get_template_part('archive-product');
		?>
	</div>

	<!-- /.container -->
</div>
<!-- /.category -->


<?php get_footer(); ?>