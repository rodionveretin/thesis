<?php

get_header();

if (!defined('ABSPATH')) {
   exit;
}

?>


<div class="single-ticket" data-ticket="<?php echo $post->ID;?>">
   <div class="container">
      <?php if ($post->post_author == get_current_user_id()) : ?>
         <div class="single-ticket__title">Тема обращения: <?php the_title() ?></div>
         <div class="single-ticket__message">Тема обращения: <?php the_content() ?></div>
         <div class="single-ticket__wrapper">
            <?php
            $args = array(
               'post_id' => $post->ID,
               'status'  => 'approve',
               'order'   => 'ASC',

            );

            $comments_query = new WP_Comment_Query;
            $comments = $comments_query->query($args);

            if ($comments) {
               foreach ($comments as $comment) {
            ?>
                  <div class="single-ticket__item">
                     <div class="single-ticket__author"><?php echo $comment->comment_author ?></div>
                     <div class="single-ticket__comment"><?php echo $comment->comment_date ?></div>
                     <div class="single-ticket__comment"><?php echo $comment->comment_content ?></div>
                  </div>
            <?php
               }
            } else {
               echo 'Ответов еще не было.';
            }
            ?>
         </div>
         <div class="single-ticket__form">
            <form action="" method="post">
               <textarea name="message" id="message" class="single-ticket__input" placeholder="Сообщение" required></textarea>
               <input type="submit" class="single-ticket__submit theme-button" value="Отправить сообщение"></input>
            </form>
         </div>
      <?php else :
         echo 'Вам не разрешено просмартивать данную страницу';
      endif; ?>
   </div>
</div>


<?php get_footer(); ?>