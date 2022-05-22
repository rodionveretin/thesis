<?php

get_header();
?>


<div class="single-post">
   <div class="container">
      <nav class="breadcrumbs" itemprop="breadcrumb">
         <div class="breadcrumbs__item"><a href="<?php echo get_home_url(); ?>">Главная</a></div>
         <div class="breadcrumbs__item"><a href="<?php echo get_home_url() . '/news' ?>">Новости</a></div>ghgbf
      </nav>

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h2 class="single-post__title"><?php the_title() ?></h2>
            <div class="single-post__wrapper">
               <div class="single-post__content">
                  <?php the_content() ?>
               </div>
               <div class="single-post__image">
                  <?php if (has_post_thumbnail()) : ?>
                     <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                  <?php endif; ?>
               </div>
            </div>
         <?php endwhile; ?>
      <?php endif; ?>
   </div>
</div>

<?php
get_footer();
