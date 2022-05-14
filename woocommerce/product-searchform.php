<?php

/**
 * Форма поиска товаров
 */

if (!defined('ABSPATH')) {
   exit;
}
?>
<!--
$form =
'<div class="header-top__search-form search mobile-inner">
   <form role="search" method="get" id="searchform" action="' . esc_url(home_url('/')) . '" class="search__form">
      <input type="text" value="' . get_search_query() . '" name="s" id="s" class="search__input" placeholder="Поиск" />
   </form>
</div>
';
-->
<div class="header-top__search-form search mobile-inner">
   <form role="search" method="get" class="search__form" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>" class="search__input" placeholder="Поиск по товарам.." value="<?php echo get_search_query(); ?>" name="s" />
      <input type="hidden" name="post_type" value="product" />
   </form>
</div>