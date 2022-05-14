<?php get_header(); ?>


<div class="block-wrapper">
	<div class="container">
		<?php
		echo woocommerce_breadcrumb();
		the_title('<h1 class="title">', '</h1>');
		the_content();
		?>
	</div>
</div>

<?php
get_footer();
