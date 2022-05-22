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
				<?php if (have_rows('phone_numbers', 'option')) : ?>
					<?php while (have_rows('phone_numbers', 'option')) : the_row(); ?>
						<div class="footer__phone">
							<a href="tel:<?php echo get_sub_field('number', 'option'); ?>"><?php echo get_sub_field('number', 'option'); ?></a>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php if (get_field('work_time', 'option')) : ?>
					<div class="footer__schedule"><?php echo get_field('work_time', 'option'); ?></div>
				<?php endif; ?>


				<?php if (have_rows('addresses', 'option')) : ?>
					<?php while (have_rows('addresses', 'option')) : the_row(); ?>
						<div class="footer__address"><?php echo get_sub_field('address', 'option'); ?></div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<!-- /.footer__row -->

			<div class="footer__row">
				<?php wp_nav_menu(array(
					'theme_location' => 'footer_menu',
					'container' => '',
					'menu_class' => 'footer__menu',
				)); ?>
			</div>
			<!-- /.footer__row -->
		</div>
		<!-- /.footer-top -->
		<div class="footer__bottom">
			<span class="footer__copyright"><?php echo get_bloginfo('name'); ?> © 2022 Все права защищены</span>
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