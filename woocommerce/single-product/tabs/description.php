<?php
/**
 * Вкладка "описание"
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

?>

<h2>Описание <?php echo $product->get_title(); ?></h2>

<?php the_content(); ?>
