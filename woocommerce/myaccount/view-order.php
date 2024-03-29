<?php

/**
 * Аккаунт: отображение заказа.
 */

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();
?>

<section class="order">
	<div class="order__title">Заказ №<?php echo $order->get_order_number(); ?> от <?php echo wc_format_datetime($order->get_date_created()); ?></div>
	<div class="order__status">Статус: <span><?php echo wc_get_order_status_name($order->get_status()); ?></span></div>
</section>

<?php if ($notes) : ?>
	<h2><?php esc_html_e('Order updates', 'woocommerce'); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ($notes as $note) : ?>
			<li class="woocommerce-OrderUpdate comment note">
				<div class="woocommerce-OrderUpdate-inner comment_container">
					<div class="woocommerce-OrderUpdate-text comment-text">
						<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date));?></p>
						<div class="woocommerce-OrderUpdate-description description">
							<?php echo wpautop(wptexturize($note->comment_content)); 
							?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action('woocommerce_view_order', $order_id); ?>