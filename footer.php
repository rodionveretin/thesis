<?php

/**
 * Шаблон подвала сайта
 */

if (!defined('ABSPATH')) {
	exit;
}

?>

</div>
<footer class="footer">
	<div class="container">
		<div class="footer__top">
			<div class="footer__row">
				<div class="footer__logo">
					<?php if (has_custom_logo()) echo get_custom_logo(); ?>
				</div>
				<div class="footer__phone">
					<a href="tel:+79581119503">+7 (958) 111-95-03</a>
				</div>
				<div class="footer__phone">
					<a href="tel:+78126605054">+7 (812) 660-50-54</a>
				</div>
				<div class="footer__schedule">Пн-вс: с 10:00 до 21:00</div>
				<div class="footer__address">Проспект Стачек 67 к.5</div>
				<div class="footer__address">Лиговский проспект 205</div>
				<div class="footer__address">Гражданский проспект, 116 к.5</div>
			</div>
			<!-- /.footer__row -->

			<div class="footer__row">
				<?php wp_nav_menu(array(
					'theme_location' => 'footer_menu',
					'container' => '',
					'menu_class' => 'footer__menu',
				)); ?>
				<!--<ul class="footer__menu">
					<li class="footer__item"><a href="">Отзывы</a></li>
					<li class="footer__item"><a href="">Наши преимущества</a></li>
					<li class="footer__item"><a href="">История компании</a></li>
					<li class="footer__item"><a href="">Сотрудничество</a></li>
					<li class="footer__item">
						<a href="">Партнёрская программа </a>
					</li>
					<li class="footer__item"><a href="">Вакансии</a></li>
				</ul> -->
			</div>
			<!-- /.footer__row -->
		</div>
		<!-- /.footer-top -->
		<div class="footer__bottom">
			<span class="footer__copyright"><?php echo get_bloginfo('name'); ?> © 2022 Все права защищены</span>
			<div class="footer__icons-wrapper">
				<div class="footer__icon">
					<a href="##">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/social-media/twitter.svg" alt="Icon: Twitter" />
					</a>
				</div>
				<div class="footer__icon">
					<a href="##">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/social-media/fb.svg" alt="Icon: Facebook" />
					</a>
				</div>
				<div class="footer__icon">
					<a href="##">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/social-media/vk.svg" alt="Icon: VK" />
					</a>
				</div>
				<div class="footer__icon">
					<a href="##">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/social-media/instagram.svg" alt="Icon: Instagram" />
					</a>
				</div>
			</div>
		</div>
		<!-- /.footer-bottom -->
	</div>
	<!-- /.container -->
</footer>
<!-- /.footer -->
</main>

<?php wp_footer(); ?>


</body>

</html>