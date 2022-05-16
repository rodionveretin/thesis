<?php

/**
 * Шаблон страницы 404
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
				<a href="<?php echo get_home_url(); ?>" class="theme-button">Вернуться на главную</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
