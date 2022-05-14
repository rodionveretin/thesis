<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package thesis
 */

get_header();
?>

<section class="page-404">
	<div class="container">
		<div class="page-404__wrapper">
			<div class="page-404__error">404</div>
			<h1 class="page-404__title">Страница не найдена</h1>
			<p class="page-404__content">Возможно, эта страница не существует или была удалена.</p>
			<div class="page-404__button button">
				<a href="<?php echo get_home_url(); ?>">Вернуться на главную</a>
			</div>
		</div>
	</div>
</section>
<!-- /.page-404 -->


<?php
get_footer();
