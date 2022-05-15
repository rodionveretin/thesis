<?php

/**
 * Шаблон шапки сайта
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="focus"></div>
	<section class="autorization">
		<div class="popup popup__registration popup--hidden">
			<div class="popup__header">
				<div class="popup__title">Регистрация</div>
				<div class="popup__button-close">
					<a href="##">&#10006;</a>
				</div>
			</div>
			<!-- /.popup__header -->
			<?php get_template_part('woocommerce/parts/wc-form-register'); ?>
		</div>
		<!-- /.popup__registration -->

		<div class="popup popup__login popup--hidden">
			<div class="popup__header">
				<div class="popup__title">Вход</div>
				<div class="popup__button-close">
					<a href="##">&#10006;</a>
				</div>
			</div>
			<!-- /.popup__header -->
			<?php get_template_part('woocommerce/parts/wc-form-login'); ?>
		</div>
		<!-- /.popup__signin -->
	</section>

	<main id="primary" class="site-main">
		<header class="header">
			<div class="header-top">
				<div class="container">
					<div class="header-top__wrapper">
						<div class="header-top__logo">
							<?php if (has_custom_logo()) echo get_custom_logo(); ?>
						</div>
						<?php get_product_search_form(); ?>
						<div class="header-top__cart">
							<a href="<?php echo esc_url(wc_get_cart_url()); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/cart.svg" alt="Icon: Cart" /></a>
							<div class="header-top__counter <?php if (WC()->cart->get_cart_contents_count() <= 0) echo "hidden"; ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
						</div>
						<div class="header-top__profile" data-user="<?php echo get_current_user_id(); ?>">
							<?php if (!is_user_logged_in()) : ?>
								<div class="header-top__login button header-top__login--active">
									<a href="#">Войти</a>
								</div>
							<?php else : ?>
								<div class="header-top__img">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/profile.svg" alt="Icon: Профиль" /></a>
								</div>
								<div class="header-top__profile-menu profile-menu">
									<ul class="profile-menu__list">
										<li class="profile-menu__item">
											<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Общие сведения</a>
										</li>
										<li class="profile-menu__item">
											<a href="<?php echo wc_customer_edit_account_url(); ?>">Личные данные</a>
										</li>
										<li class="profile-menu__item">
											<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) . "orders"; ?>">История покупок</a>
										</li>
										<li class="profile-menu__item"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')) . "favorites"; ?>">Избранное</a></li>
										<li class="profile-menu__item"><a href="<?php echo wp_logout_url(home_url()); ?>">Выйти</a></li>
									</ul>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<!-- /.header-top__wrapper -->
				</div>
				<!-- /.container -->
			</div>
			<!-- /.header-top -->

			<div class="header-bottom">
				<div class="container">
					<div class="header-bottom__wrapper">
						<div class="mobile-menu">
							<div class="mobile-menu__button">
								<a href="<?php echo get_home_url(); ?>" class="mobile-menu__link">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12.5901 1.41003L12.5897 1.40961C12.4339 1.25471 12.2231 1.16776 12.0034 1.16776C11.7836 1.16776 11.5729 1.25471 11.417 1.40961L11.4167 1.40995L1.41668 11.41L1.41633 11.4096L1.40803 11.4193C1.27178 11.5784 1.20058 11.7831 1.20867 11.9924C1.21675 12.2017 1.30352 12.4002 1.45164 12.5483C1.59975 12.6965 1.7983 12.7832 2.00761 12.7913C2.21692 12.7994 2.42158 12.7282 2.58068 12.592L2.581 12.5923L2.59002 12.5833L12 3.17334L21.41 12.5899L21.4096 12.5903L21.4194 12.5986C21.5785 12.7349 21.7831 12.8061 21.9924 12.798C22.2017 12.7899 22.4003 12.7031 22.5484 12.555C22.6965 12.4069 22.7833 12.2083 22.7914 11.999C22.7995 11.7897 22.7283 11.5851 22.592 11.426L22.5924 11.4257L22.5834 11.4167L12.5901 1.41003Z" fill="white" stroke="white" stroke-width="0.33" />
										<path d="M18.5017 21.1683H16.3333C15.8722 21.1683 15.4983 20.7945 15.4983 20.3333V15.6666C15.4983 15.0232 14.9767 14.5016 14.3333 14.5016H9.66667C9.02325 14.5016 8.50167 15.0232 8.50167 15.6666V20.3333C8.50167 20.7945 8.12782 21.1683 7.66667 21.1683H5.49833V13.6094C5.49833 12.8685 4.60251 12.4974 4.07859 13.0214C3.92262 13.1773 3.835 13.3889 3.835 13.6094V21.3333C3.835 21.7307 3.99286 22.1118 4.27385 22.3928C4.55484 22.6738 4.93595 22.8316 5.33333 22.8316H9C9.64341 22.8316 10.165 22.31 10.165 21.6666V17C10.165 16.5388 10.5388 16.165 11 16.165H13C13.4612 16.165 13.835 16.5388 13.835 17V21.6666C13.835 22.31 14.3566 22.8316 15 22.8316H18.6667C19.064 22.8316 19.4452 22.6738 19.7261 22.3928C20.0071 22.1118 20.165 21.7307 20.165 21.3333V13.4494C20.165 13.2289 20.0774 13.0173 19.9214 12.8614C19.3975 12.3374 18.5017 12.7085 18.5017 13.4494V21.1683Z" fill="white" stroke="white" stroke-width="0.33" />
									</svg>
									<span class="mobile-menu__caption">Главная</span>
								</a>
							</div>
							<!-- /.mobile-menu__button -->
							<div class="mobile-menu__button">
								<a href="##" class="mobile-menu__link">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M1 13C1.55228 13 2 12.5523 2 12C2 11.4477 1.55228 11 1 11C0.447715 11 0 11.4477 0 12C0 12.5523 0.447715 13 1 13Z" fill="#BFCBD6" />
										<path d="M22.7243 11H6.27571C5.57116 11 5 11.4209 5 11.94V12.06C5 12.5791 5.57116 13 6.27571 13H22.7243C23.4288 13 24 12.5791 24 12.06V11.94C24 11.4209 23.4288 11 22.7243 11Z" fill="#BFCBD6" />
										<path d="M22.7467 17H1.25333C0.561136 17 0 17.4209 0 17.94V18.06C0 18.5791 0.561136 19 1.25333 19H22.7467C23.4389 19 24 18.5791 24 18.06V17.94C24 17.4209 23.4389 17 22.7467 17Z" fill="#BFCBD6" />
										<path d="M22.7467 5H1.25333C0.561136 5 0 5.42085 0 5.94V6.06C0 6.57915 0.561136 7 1.25333 7H22.7467C23.4389 7 24 6.57915 24 6.06V5.94C24 5.42085 23.4389 5 22.7467 5Z" fill="#BFCBD6" />
									</svg>
									<span class="mobile-menu__caption">Каталог</span>
								</a>
							</div>
							<!-- /.mobile-menu__button -->
							<div class="mobile-menu__button">
								<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="mobile-menu__link">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M8.38164 21.7034C9.20955 21.7034 9.88071 21.0394 9.88071 20.2203C9.88071 19.4011 9.20955 18.7371 8.38164 18.7371C7.55372 18.7371 6.88257 19.4011 6.88257 20.2203C6.88257 21.0394 7.55372 21.7034 8.38164 21.7034Z" fill="#BFCBD6" />
										<path d="M17.4893 21.7034C18.3173 21.7034 18.9884 21.0394 18.9884 20.2203C18.9884 19.4011 18.3173 18.7371 17.4893 18.7371C16.6614 18.7371 15.9903 19.4011 15.9903 20.2203C15.9903 21.0394 16.6614 21.7034 17.4893 21.7034Z" fill="#BFCBD6" />
										<path d="M21.5402 4.13853C21.4782 4.06292 21.4 4.00183 21.3113 3.95966C21.2226 3.91749 21.1256 3.89529 21.0272 3.89464H10.0661C9.61737 3.89464 9.2998 4.33323 9.43984 4.75953C9.52872 5.03009 9.7813 5.21298 10.0661 5.21298H20.1544L18.3755 12.1455H8.38164L5.33685 3.58484C5.30392 3.48363 5.24673 3.3918 5.17016 3.31719C5.09359 3.24259 4.99992 3.18741 4.89713 3.15638L2.16548 2.32583C2.08149 2.30029 1.99323 2.29137 1.90576 2.29958C1.81828 2.30779 1.73329 2.33297 1.65565 2.37367C1.49884 2.45588 1.38146 2.59634 1.32933 2.76417C1.27721 2.932 1.2946 3.11344 1.37769 3.26858C1.46078 3.42372 1.60276 3.53985 1.77239 3.59143L4.16425 4.31651L7.22236 12.8969L6.1297 13.7802L6.04308 13.8659C5.77281 14.174 5.61961 14.5658 5.60988 14.9737C5.60016 15.3816 5.7345 15.78 5.98978 16.1005C6.17138 16.319 6.40213 16.4924 6.66359 16.6068C6.92505 16.7213 7.20996 16.7736 7.49552 16.7596H18.6153C18.792 16.7596 18.9615 16.6902 19.0864 16.5666C19.2114 16.4429 19.2816 16.2753 19.2816 16.1005C19.2816 15.9256 19.2114 15.758 19.0864 15.6344C18.9615 15.5107 18.792 15.4413 18.6153 15.4413H7.38892C7.3122 15.4387 7.23745 15.4166 7.17189 15.3771C7.10634 15.3375 7.05219 15.282 7.01468 15.2157C6.97717 15.1494 6.95757 15.0747 6.95777 14.9988C6.95797 14.9228 6.97796 14.8482 7.01582 14.7821L8.62149 13.4638H18.9085C19.0625 13.4675 19.213 13.4183 19.3345 13.3246C19.456 13.2308 19.5409 13.0983 19.5747 12.9497L21.6867 4.69883C21.707 4.60056 21.7043 4.49901 21.6789 4.40191C21.6535 4.30482 21.6061 4.21474 21.5402 4.13853Z" fill="#BFCBD6" />
										<path fill-rule="evenodd" clip-rule="evenodd" d="M21.0272 3.89464C21.1256 3.89529 21.2226 3.91749 21.3113 3.95966C21.4 4.00183 21.4782 4.06292 21.5402 4.13853C21.6061 4.21474 21.6535 4.30482 21.6789 4.40191C21.7043 4.49901 21.707 4.60056 21.6867 4.69883L19.5747 12.9497C19.5409 13.0983 19.456 13.2308 19.3345 13.3246C19.213 13.4183 19.0625 13.4675 18.9085 13.4638H8.62149L7.01582 14.7821C6.97796 14.8482 6.95797 14.9228 6.95777 14.9988C6.95757 15.0747 6.97717 15.1494 7.01468 15.2157C7.05219 15.282 7.10634 15.3375 7.17189 15.3771C7.23745 15.4166 7.3122 15.4387 7.38892 15.4413H18.6153C18.792 15.4413 18.9615 15.5107 19.0864 15.6344C19.2114 15.758 19.2816 15.9256 19.2816 16.1005C19.2816 16.2753 19.2114 16.4429 19.0864 16.5666C18.9615 16.6902 18.792 16.7596 18.6153 16.7596H7.49552C7.20996 16.7736 6.92505 16.7213 6.66359 16.6068C6.40213 16.4924 6.17138 16.319 5.98978 16.1005C5.7345 15.78 5.60016 15.3816 5.60988 14.9737C5.61961 14.5658 5.77281 14.174 6.04308 13.8659L6.1297 13.7802L7.22236 12.8969L4.16425 4.31651L1.77239 3.59143C1.60276 3.53985 1.46078 3.42372 1.37769 3.26858C1.2946 3.11344 1.27721 2.932 1.32933 2.76417C1.38146 2.59634 1.49884 2.45588 1.65565 2.37367C1.73329 2.33297 1.81828 2.30779 1.90576 2.29958C1.99323 2.29137 2.08149 2.30029 2.16548 2.32583L4.89713 3.15638C4.99992 3.18741 5.09359 3.24259 5.17016 3.31719C5.24673 3.3918 5.30392 3.48363 5.33685 3.58484L8.38164 12.1455H18.3755L20.1544 5.21298H10.0661C9.7813 5.21298 9.52872 5.03009 9.43984 4.75953C9.2998 4.33323 9.61737 3.89464 10.0661 3.89464H21.0272ZM19.7805 5.5096H10.0631C9.65012 5.5096 9.28387 5.24441 9.155 4.8521C8.95195 4.23397 9.41242 3.59802 10.0631 3.59802H21.0291C21.1718 3.59896 21.3125 3.63116 21.4412 3.6923C21.5686 3.75289 21.681 3.8404 21.7705 3.94866C21.8648 4.05852 21.9327 4.18807 21.9692 4.32759C22.006 4.46838 22.0099 4.61562 21.9805 4.75811L21.9792 4.76435L19.8672 13.0148M19.7805 5.5096L18.135 11.8488H8.60136L5.62275 3.4955L5.62224 3.49393C5.57449 3.34718 5.49156 3.21403 5.38054 3.10585C5.26959 2.99775 5.13387 2.91778 4.98495 2.87276L2.25356 2.04229C2.13193 2.00531 2.00412 1.9924 1.87745 2.00428C1.75077 2.01617 1.6277 2.05263 1.51527 2.11157C1.2882 2.23061 1.11823 2.43402 1.04274 2.67704C0.967261 2.92007 0.99245 3.18281 1.11277 3.40747C1.23309 3.63212 1.43868 3.80029 1.68433 3.87497L3.92591 4.5545L6.87513 12.7946L5.92834 13.5599L5.82359 13.6636L5.81664 13.6715C5.50064 14.0318 5.32153 14.4898 5.31015 14.9667C5.29878 15.4436 5.45585 15.9095 5.75432 16.2841L5.75821 16.2889C5.96952 16.5431 6.23803 16.7449 6.54228 16.8781C6.84417 17.0102 7.17293 17.0712 7.50264 17.0563H18.6153C18.8715 17.0563 19.1173 16.9556 19.2984 16.7763C19.4796 16.5971 19.5814 16.354 19.5814 16.1005C19.5814 15.847 19.4796 15.6039 19.2984 15.4246C19.1172 15.2454 18.8715 15.1447 18.6153 15.1447H7.39542C7.37154 15.1433 7.34835 15.1361 7.32789 15.1238C7.30637 15.1108 7.28859 15.0925 7.27627 15.0708C7.26395 15.049 7.25752 15.0245 7.25758 14.9995C7.25761 14.9881 7.25901 14.9767 7.26172 14.9657L8.72969 13.7604H18.9051C19.1271 13.7649 19.3438 13.6936 19.5189 13.5585C19.695 13.4226 19.8181 13.2303 19.8672 13.0148M10.1805 20.2203C10.1805 21.2032 9.37514 22 8.38164 22C7.38814 22 6.58275 21.2032 6.58275 20.2203C6.58275 19.2373 7.38814 18.4405 8.38164 18.4405C9.37514 18.4405 10.1805 19.2373 10.1805 20.2203ZM19.2882 20.2203C19.2882 21.2032 18.4828 22 17.4893 22C16.4958 22 15.6905 21.2032 15.6905 20.2203C15.6905 19.2373 16.4958 18.4405 17.4893 18.4405C18.4828 18.4405 19.2882 19.2373 19.2882 20.2203ZM8.38164 21.7034C9.20955 21.7034 9.88071 21.0394 9.88071 20.2203C9.88071 19.4011 9.20955 18.7371 8.38164 18.7371C7.55372 18.7371 6.88257 19.4011 6.88257 20.2203C6.88257 21.0394 7.55372 21.7034 8.38164 21.7034ZM17.4893 21.7034C18.3173 21.7034 18.9884 21.0394 18.9884 20.2203C18.9884 19.4011 18.3173 18.7371 17.4893 18.7371C16.6614 18.7371 15.9903 19.4011 15.9903 20.2203C15.9903 21.0394 16.6614 21.7034 17.4893 21.7034Z" fill="#BFCBD6" />
									</svg>
									<span class="mobile-menu__caption">Корзина</span>
								</a>
							</div>
							<!-- /.mobile-menu__button -->
							<div class="mobile-menu__button">
								<a href="##" class="mobile-menu__link">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#BFCBD6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M20.9999 21L16.6499 16.65" stroke="#BFCBD6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
									<span class="mobile-menu__caption">Поиск</span>
								</a>
							</div>
							<!-- /.mobile-menu__button -->
							<div class="mobile-menu__button">
								<a href="##" class="mobile-menu__link">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="2" cy="12" r="2" fill="#BFCBD6" />
										<circle cx="12" cy="12" r="2" fill="#BFCBD6" />
										<circle cx="22" cy="12" r="2" fill="#BFCBD6" />
									</svg>
									<span class="mobile-menu__caption">Ещё</span>
								</a>
							</div>
							<!-- /.mobile-menu__button -->
						</div>
						<!-- /.mobile-menu -->

						<div class="header-bottom__left catalog-button">
							<span class="catalog-button__icon">
								<svg class="catalog-button__icon-svg" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5 17C5.55228 17 6 16.5523 6 16C6 15.4477 5.55228 15 5 15C4.44772 15 4 15.4477 4 16C4 16.5523 4.44772 17 5 17Z" fill="white" />
									<path d="M26.7243 15H10.2757C9.57116 15 9 15.4209 9 15.94V16.06C9 16.5791 9.57116 17 10.2757 17H26.7243C27.4288 17 28 16.5791 28 16.06V15.94C28 15.4209 27.4288 15 26.7243 15Z" fill="white" />
									<path d="M26.7467 21H5.25333C4.56114 21 4 21.4209 4 21.94V22.06C4 22.5791 4.56114 23 5.25333 23H26.7467C27.4389 23 28 22.5791 28 22.06V21.94C28 21.4209 27.4389 21 26.7467 21Z" fill="white" />
									<path d="M26.7467 9H5.25333C4.56114 9 4 9.42085 4 9.94V10.06C4 10.5791 4.56114 11 5.25333 11H26.7467C27.4389 11 28 10.5791 28 10.06V9.94C28 9.42085 27.4389 9 26.7467 9Z" fill="white" />
								</svg>
							</span>
							<span class="catalog-button__caption">Каталог товаров</span>
						</div>
						<!-- /.header-bottom__left -->
						<div class="header-bottom__right">
							<nav class="navbar">
								<?php wp_nav_menu(array(
									'theme_location' => 'header_menu',
									'container' => false,
									'menu_class' => 'navbar__wrapper',
								)); ?>
							</nav>
							<!-- /.navbar -->
						</div>
						<!-- /.header-bottom__right -->
					</div>
				</div>
				<!-- /.container -->
			</div>
			<?php echo wc_print_notices(); ?>
			<!-- /.header-bottom -->

			<div class="container">
				<div class="categories mobile-inner">
					<ul class="categories__list">
						<?php
						$prod_cat_args = array(
							'taxonomy'    => 'product_cat',
							'orderby'     => 'title',
							'hide_empty'  => false,
							'parent'      => 0
						);
						$woo_categories = get_categories($prod_cat_args);
						foreach ($woo_categories as $woo_cat) {
							$woo_cat_id = $woo_cat->term_id;
							$woo_cat_name = $woo_cat->name;
							$woo_cat_slug = $woo_cat->slug;
							echo '<li class="categories__item">';
							$category_thumbnail_id = get_woocommerce_term_meta($woo_cat_id, 'thumbnail_id', true);
							$thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);
							echo '<a href="' . get_term_link($woo_cat_id, 'product_cat') . '">' . $woo_cat_name . '</a>';
							echo "</li>";
						}
						?>
					</ul>
				</div>
				<!-- /.categories -->

				<nav class="navbar-mobile mobile-inner">
					<?php wp_nav_menu(array(
						'theme_location' => 'header_menu',
						'container' => false,
						'menu_class' => 'navbar-mobile__wrapper',
					)); ?>
				</nav>
				<!-- /.navbar-mobile -->
			</div>
			<!-- /.container -->
		</header>
		<!-- /.header -->
		<div class="page">

			<!-- /.autorization -->