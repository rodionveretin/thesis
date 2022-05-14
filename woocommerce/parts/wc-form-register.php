<?php

/**
 * Шаблон формы регистрации.
 */

if (!defined('ABSPATH')) {
   exit;
}
?>


<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

   <div class="popup__content">

      <form method="post" class="popup__form">


         <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
            <div class="popup__subtitle">Имя</div>
            <input type="text" class="popup__input" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
         <?php endif; ?>


         <div class="popup__subtitle">Электронная почта</div>
         <input type="email" class="popup__input" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />

         <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>


            <div class="popup__subtitle">Придумайте пароль</div>
            <div class="popup__password">
               <input type="password" class="popup__input" name="password" id="reg_password" autocomplete="new-password" />
               <a href="#" class="popup__control"></a>
            </div>

         <?php else : ?>

            <p><?php esc_html_e('Ссылка для установки нового пароля будет отправлена на вашу почту.', 'woocommerce'); ?></p>

         <?php endif; ?>

         <div class="popup__rules">
            Регистрируясь, вы соглашаетесь с <a href="<?php echo get_permalink(wc_terms_and_conditions_page_id()); ?>">пользовательским соглашением</a>
         </div>
         <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
         <input type="submit" class="popup__button" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>" />

      </form>

      <div class="popup__link"><a href="#">Я уже зарегистрирован</a></div>

   </div>
   <!-- /.popup__content -->

<?php endif; ?>