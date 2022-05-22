<?php
/*
   Template Name: Страница новостей
*/

get_header();

?>

<div class="blog">
   <div class="container">
      <?php
      echo esc_html(woocommerce_breadcrumb());
      ?>
      <h1 class="blog__title">Новости</h1>
      <div class="blog__wrapper">
         <?php
         $args = array(
            'post_type' => 'post',
            'posts_per_page' => '4',
         );

         $query = new WP_Query($args);

         if ($query->have_posts()) {
            while ($query->have_posts()) {
               $query->the_post();
         ?>
               <div class="blog__item">
                  <?php if (has_post_thumbnail()) : ?>
                     <div class="blog__img"><?php esc_html(the_post_thumbnail()) ?></div>
                  <?php endif; ?>
                  <div class="blog__content">
                     <h3 class="blog__title"><?php esc_html(the_title()) ?></h3>
                     <div class="blog__text"><?php the_content() ?></div>
                     <div class="blog__bottom">
                        <span class="blog__link"><a href="<?php esc_html(the_permalink()); ?>">Подробнее</a></span>
                        <span class="blog__date"><?php esc_html(the_date()) ?></span>
                     </div>
                  </div>
               </div>
            <?php
            }
            wp_reset_postdata();
            if ($query->found_posts) :
            ?>



            <?php endif; ?>
         <?php
         } else
            echo 'Записей нет.';
         ?>

      </div>

      <div class="show-more"><button class="theme-button">Показать больше</button></div>
   </div>
</div>

<?php
get_footer();
?>