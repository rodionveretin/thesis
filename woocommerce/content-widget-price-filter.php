<?php

/**
 * Шаблон для отображения виджета фильтра цены товара.
 */

defined( 'ABSPATH' ) || exit;

?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>">
	<div class="price_slider_wrapper">
		<div class="price_slider" style="display:none;"></div>
		<div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
			<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'woocommerce' ); ?>" />
			<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'woocommerce' ); ?>" />
			<div class="filter-wrapper__buttons">
				<button type="submit" class="theme-button">Применить</button>
				<div class="price_label" style="display:none;">
					<?php echo esc_html__( 'Price:', 'woocommerce' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
				</div>
			</div>
			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
			<div class="clear"></div>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
