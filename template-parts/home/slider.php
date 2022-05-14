<?php

/**
 * Шаблон слайдера
 */

?>

<?php if (have_rows('slider')) : ?>
   <div class="swiper slider">
      <div class="swiper-wrapper">
         <?php while (have_rows('slider')) : the_row(); ?>
            <div class="swiper-slide slide">
               <div class="slide__wrapper">
                  <a href="<?php echo the_sub_field('slide_link'); ?>" class="slide__link">
                     <h2 class="slide__title"><?php echo the_sub_field('slide_title'); ?></h2>
                     <p class="slide__subtitle"><?php echo the_sub_field('slide_subtitle'); ?></p>
                  </a>
               </div>
               <div class="slide__img">
                  <img src="<?php
                              $image = get_sub_field('slide_img');
                              echo $image['url']; ?>" />
               </div>
            </div>
         <?php endwhile; ?>
      </div>
   </div>
<?php endif; ?>