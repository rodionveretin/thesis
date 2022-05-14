<?php
/*
   Template Name: Особая категория
*/

?>

<?php get_header(); ?>


<div class="advert">
   <div class="container">
      
      <?php
      echo woocommerce_breadcrumb();
      $args = array(
         'limit'     => 8,
         'orderby'   => array('meta_value_num' => 'DESC', 'title' => 'ASC'),
         'meta_type' => 'NUMERIC',
         'meta_key'  => 'total_sales',
         'page' => 1,
      );
      $query = new WC_Product_Query($args);
      $products = $query->get_products();
      if ($products) : ?>
         <section class="product-block">
            <div class="container">
               <div class="product-block__header">
                  <h2 class="product-block__title">Хиты продаж</h2>
               </div>
               <!-- /.product-block__header -->
               <div class="product-block__wrapper">
                  <?php for ($product = 0; $product < count($products); ++$product) : ?>
                     <div class="product-block__item product-card" data-id="<?php echo $products[$product]->get_id(); ?>">
                        <div class="product-card__top">
                           <?php $dateCreated = $products[$product]->get_date_created()->format('Y-m-d');
                           $currentDateTime = date("Y-m-d");
                           if (date("Y-m-d", strtotime("$currentDateTime -7 day")) < $dateCreated) : ?>
                              <div class="product-card__mark">Новинка</div>
                           <?php endif; ?>

                           <div class="product-card__img">
                              <a href="<?php echo $products[$product]->get_permalink(); ?>"><img src="<?php echo wp_get_attachment_url($products[$product]->get_image_id()); ?>" alt="<?php echo $products[$product]->get_name(); ?>" /></a>
                           </div>
                           <div class="product-card__category"><a href="#"><?php echo $products[$product]->get_categories(); ?></a></div>
                           <div class="product-card__title" title="<?php echo $products[$product]->get_name(); ?>">
                              <a href="<?php echo $products[$product]->get_permalink(); ?>"><?php echo $products[$product]->get_name(); ?></a>
                           </div>
                        </div>
                        <!-- /.product-card__top -->
                        <div class="product-card__bottom">
                           <div class="product-card__rating rating">
                              <div class="rating__stars stars">
                                 <?php $rating = floor($products[$product]->get_average_rating());
                                 for ($i = 0; $i < $rating; $i++) :
                                 ?>
                                    <svg class="stars__icon stars__icon--active" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#EAEAF0" />
                                    </svg>
                                 <?php endfor; ?>
                                 <?php for ($i = 0; $i < 5 - $rating; $i++) :
                                 ?>
                                    <svg class="stars__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#EAEAF0" />
                                    </svg>
                                 <?php endfor; ?>
                              </div>
                              <div class="rating__reviews">
                                 <a href="#">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#070C11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="rating__counter">(<?php echo $products[$product]->get_review_count(); ?>)</span>
                                 </a>
                              </div>
                           </div>
                           <div class="product-card__interactions interactions">
                              <div class="interactions__prices prices">
                                 <?php if ($products[$product]->get_type() == 'simple') : ?>
                                    <?php if ($products[$product]->get_sale_price()) : ?>
                                       <del class="prices__old"><?php echo $products[$product]->get_regular_price(); ?> ₽</del>
                                       <span class="prices__new"><?php echo $products[$product]->get_sale_price(); ?> ₽</span>
                                    <?php else : ?>
                                       <span class="prices__new"><?php echo $products[$product]->get_regular_price(); ?> ₽</span>
                                    <?php endif; ?>
                                 <?php elseif ($products[$product]->get_type() == 'variable') : ?>
                                    <span class="prices__new">От <?php echo $products[$product]->get_variation_price('min', true); ?> ₽</span>
                                 <?php elseif ($products[$product]->get_type() == 'grouped') : ?>
                                    <span class="prices__new">От <?php
                                                                  $children = $products[$product]->get_children();
                                                                  foreach ($children as $key => $value) {
                                                                     $_product = wc_get_product($value);
                                                                     $prices[] = $_product->get_price();
                                                                  }
                                                                  echo min($prices);
                                                                  ?> ₽</span>
                                 <?php endif; ?>
                              </div>
                              <div class="interactions__favourites" title="Добавить в избранное">
                                 <a href="#">
                                    <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M19.16 2.00004C18.1 0.937251 16.6948 0.288583 15.1984 0.171213C13.7019 0.0538432 12.2128 0.475509 11 1.36004C9.72769 0.413681 8.14402 -0.0154454 6.56795 0.159081C4.99188 0.333607 3.54047 1.09882 2.506 2.30063C1.47154 3.50244 0.930854 5.05156 0.992833 6.63606C1.05481 8.22055 1.71485 9.72271 2.84003 10.84L9.05003 17.06C9.57005 17.5718 10.2704 17.8587 11 17.8587C11.7296 17.8587 12.43 17.5718 12.95 17.06L19.16 10.84C20.3276 9.66531 20.983 8.07632 20.983 6.42004C20.983 4.76377 20.3276 3.17478 19.16 2.00004Z" fill="#F15152" />
                                    </svg>
                                 </a>
                              </div>
                              <div class="interactions__cart" title="Добавить в корзину">
                                 <a href="<?php echo $products[$product]->add_to_cart_url() ?>">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M7.38164 19.7034C8.20955 19.7034 8.88071 19.0394 8.88071 18.2203C8.88071 17.4011 8.20955 16.7371 7.38164 16.7371C6.55372 16.7371 5.88257 17.4011 5.88257 18.2203C5.88257 19.0394 6.55372 19.7034 7.38164 19.7034Z" fill="white" />
                                       <path d="M16.4893 19.7034C17.3173 19.7034 17.9884 19.0394 17.9884 18.2203C17.9884 17.4011 17.3173 16.7371 16.4893 16.7371C15.6614 16.7371 14.9903 17.4011 14.9903 18.2203C14.9903 19.0394 15.6614 19.7034 16.4893 19.7034Z" fill="white" />
                                       <path d="M20.5402 2.13853C20.4782 2.06292 20.4 2.00183 20.3113 1.95966C20.2226 1.91749 20.1256 1.89529 20.0272 1.89464H9.06608C8.61737 1.89464 8.2998 2.33323 8.43984 2.75953C8.52872 3.03009 8.7813 3.21298 9.06608 3.21298H19.1544L17.3755 10.1455H7.38164L4.33685 1.58484C4.30392 1.48363 4.24673 1.3918 4.17016 1.31719C4.09359 1.24259 3.99992 1.18741 3.89713 1.15638L1.16548 0.325828C1.08149 0.300292 0.993233 0.291373 0.905756 0.299582C0.818278 0.307791 0.733291 0.332967 0.655647 0.373671C0.498839 0.455877 0.38146 0.596345 0.329333 0.764174C0.277206 0.932002 0.294601 1.11344 0.377691 1.26858C0.46078 1.42372 0.602759 1.53985 0.772393 1.59143L3.16425 2.31651L6.22236 10.8969L5.1297 11.7802L5.04308 11.8659C4.77281 12.174 4.61961 12.5658 4.60988 12.9737C4.60016 13.3816 4.7345 13.78 4.98978 14.1005C5.17138 14.319 5.40213 14.4924 5.66359 14.6068C5.92505 14.7213 6.20996 14.7736 6.49552 14.7596H17.6153C17.792 14.7596 17.9615 14.6902 18.0864 14.5666C18.2114 14.4429 18.2816 14.2753 18.2816 14.1005C18.2816 13.9256 18.2114 13.758 18.0864 13.6344C17.9615 13.5107 17.792 13.4413 17.6153 13.4413H6.38892C6.3122 13.4387 6.23745 13.4166 6.17189 13.3771C6.10634 13.3375 6.05219 13.282 6.01468 13.2157C5.97717 13.1494 5.95757 13.0747 5.95777 12.9988C5.95797 12.9228 5.97796 12.8482 6.01582 12.7821L7.62149 11.4638H17.9085C18.0625 11.4675 18.213 11.4183 18.3345 11.3246C18.456 11.2308 18.5409 11.0983 18.5747 10.9497L20.6867 2.69883C20.707 2.60056 20.7043 2.49901 20.6789 2.40191C20.6535 2.30482 20.6061 2.21474 20.5402 2.13853Z" fill="white" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0272 1.89464C20.1256 1.89529 20.2226 1.91749 20.3113 1.95966C20.4 2.00183 20.4782 2.06292 20.5402 2.13853C20.6061 2.21474 20.6535 2.30482 20.6789 2.40191C20.7043 2.49901 20.707 2.60056 20.6867 2.69883L18.5747 10.9497C18.5409 11.0983 18.456 11.2308 18.3345 11.3246C18.213 11.4183 18.0625 11.4675 17.9085 11.4638H7.62149L6.01582 12.7821C5.97796 12.8482 5.95797 12.9228 5.95777 12.9988C5.95757 13.0747 5.97717 13.1494 6.01468 13.2157C6.05219 13.282 6.10634 13.3375 6.17189 13.3771C6.23745 13.4166 6.3122 13.4387 6.38892 13.4413H17.6153C17.792 13.4413 17.9615 13.5107 18.0864 13.6344C18.2114 13.758 18.2816 13.9256 18.2816 14.1005C18.2816 14.2753 18.2114 14.4429 18.0864 14.5666C17.9615 14.6902 17.792 14.7596 17.6153 14.7596H6.49552C6.20996 14.7736 5.92505 14.7213 5.66359 14.6068C5.40213 14.4924 5.17138 14.319 4.98978 14.1005C4.7345 13.78 4.60016 13.3816 4.60988 12.9737C4.61961 12.5658 4.77281 12.174 5.04308 11.8659L5.1297 11.7802L6.22236 10.8969L3.16425 2.31651L0.772393 1.59143C0.602759 1.53985 0.46078 1.42372 0.377691 1.26858C0.294601 1.11344 0.277206 0.932002 0.329333 0.764174C0.38146 0.596345 0.498839 0.455877 0.655647 0.373671C0.733291 0.332967 0.818278 0.307791 0.905756 0.299582C0.993233 0.291373 1.08149 0.300292 1.16548 0.325828L3.89713 1.15638C3.99992 1.18741 4.09359 1.24259 4.17016 1.31719C4.24673 1.3918 4.30392 1.48363 4.33685 1.58484L7.38164 10.1455H17.3755L19.1544 3.21298H9.06608C8.7813 3.21298 8.52872 3.03009 8.43984 2.75953C8.2998 2.33323 8.61737 1.89464 9.06608 1.89464H20.0272ZM18.7805 3.5096H9.06305C8.65012 3.5096 8.28387 3.24441 8.155 2.8521C7.95195 2.23397 8.41242 1.59802 9.06305 1.59802H20.0291C20.1718 1.59896 20.3125 1.63116 20.4412 1.6923C20.5686 1.75289 20.681 1.8404 20.7705 1.94866C20.8648 2.05852 20.9327 2.18807 20.9692 2.32759C21.006 2.46838 21.0099 2.61562 20.9805 2.75811L20.9792 2.76435L18.8672 11.0148M18.7805 3.5096L17.135 9.84884H7.60136L4.62275 1.4955L4.62224 1.49393C4.57449 1.34718 4.49156 1.21403 4.38054 1.10585C4.26959 0.997748 4.13387 0.917781 3.98495 0.872763L1.25356 0.0422902C1.13193 0.00531213 1.00412 -0.00760412 0.877446 0.00428294C0.750772 0.01617 0.627705 0.0526258 0.515271 0.111568C0.288201 0.230608 0.118228 0.434015 0.0427445 0.677043C-0.0327391 0.920072 -0.00755033 1.18281 0.11277 1.40747C0.23309 1.63212 0.438685 1.80029 0.684326 1.87497L2.92591 2.5545L5.87513 10.7946L4.92834 11.5599L4.82359 11.6636L4.81664 11.6715C4.50064 12.0318 4.32153 12.4898 4.31015 12.9667C4.29878 13.4436 4.45585 13.9095 4.75432 14.2841L4.75821 14.2889C4.96952 14.5431 5.23803 14.7449 5.54228 14.8781C5.84417 15.0102 6.17293 15.0712 6.50264 15.0563H17.6153C17.8715 15.0563 18.1173 14.9556 18.2984 14.7763C18.4796 14.5971 18.5814 14.354 18.5814 14.1005C18.5814 13.847 18.4796 13.6039 18.2984 13.4246C18.1172 13.2454 17.8715 13.1447 17.6153 13.1447H6.39542C6.37154 13.1433 6.34835 13.1361 6.32789 13.1238C6.30637 13.1108 6.28859 13.0925 6.27627 13.0708C6.26395 13.049 6.25752 13.0245 6.25758 12.9995C6.25761 12.9881 6.25901 12.9767 6.26172 12.9657L7.72969 11.7604H17.9051C18.1271 11.7649 18.3438 11.6936 18.5189 11.5585C18.695 11.4226 18.8181 11.2303 18.8672 11.0148M9.18053 18.2203C9.18053 19.2032 8.37514 20 7.38164 20C6.38814 20 5.58275 19.2032 5.58275 18.2203C5.58275 17.2373 6.38814 16.4405 7.38164 16.4405C8.37514 16.4405 9.18053 17.2373 9.18053 18.2203ZM18.2882 18.2203C18.2882 19.2032 17.4828 20 16.4893 20C15.4958 20 14.6905 19.2032 14.6905 18.2203C14.6905 17.2373 15.4958 16.4405 16.4893 16.4405C17.4828 16.4405 18.2882 17.2373 18.2882 18.2203ZM7.38164 19.7034C8.20955 19.7034 8.88071 19.0394 8.88071 18.2203C8.88071 17.4011 8.20955 16.7371 7.38164 16.7371C6.55372 16.7371 5.88257 17.4011 5.88257 18.2203C5.88257 19.0394 6.55372 19.7034 7.38164 19.7034ZM16.4893 19.7034C17.3173 19.7034 17.9884 19.0394 17.9884 18.2203C17.9884 17.4011 17.3173 16.7371 16.4893 16.7371C15.6614 16.7371 14.9903 17.4011 14.9903 18.2203C14.9903 19.0394 15.6614 19.7034 16.4893 19.7034Z" fill="white" />
                                    </svg>
                                 </a>
                              </div>
                           </div>
                        </div>
                        <!-- /.product-card__bottom -->
                     </div>
                     <!-- /.product-card -->
                  <?php endfor; ?>
               </div>
               <!-- /.product-block__wrapper -->
            </div>
            <!-- /.container -->
         </section>
         <!-- /.product-block -->
      <?php endif; ?>
      <div class="loader">
         <svg class="loader__anim hidden" xmlns="http://www.w3.org/2000/svg" style="margin: auto; display: block; shape-rendering: auto;" width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <rect x="17.5" y="30" width="15" height="40" fill="#182731">
               <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
               <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
            </rect>
            <rect x="42.5" y="30" width="15" height="40" fill="#a7d4ec">
               <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
               <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
            </rect>
            <rect x="67.5" y="30" width="15" height="40" fill="#182731">
               <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
               <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
            </rect>
         </svg>
      </div>
      <a href="" id="load-more" class="advert__button">Показать ещё</a>
   </div>
   <!-- /.container -->
</div>
<!-- /.advert -->


<?php get_footer(); ?>