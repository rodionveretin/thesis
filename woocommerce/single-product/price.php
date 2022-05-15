<?php

/**
 * Цена товара
 */

if (!defined('ABSPATH')) {
	exit;
}

global $product;

?>
<p class="product-item__price"><?php echo $product->get_price_html(); ?></p>