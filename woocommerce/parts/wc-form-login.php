<?php

/**
 * Шаблон формы входа.
 */

if (!defined('ABSPATH')) {
   exit;
}
?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

   <div class="popup__content" id="customer_login">

   <?php endif; ?>

   <form class="popup__form" method="post">
      <div class="popup__subtitle">Электронная почта или пароль</div>
      <input type="text" class="popup__input" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required />

      <div class="popup__subtitle">Пароль</div>
      <div class="popup__password">
         <input type="password" class="popup__input" type="password" name="password" id="password" autocomplete="current-password" />
         <a href="#" class="popup__control"></a>
      </div>

      <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="popup__restore-link">Забыли пароль?</a>

      <div class="popup__checkbox">
         <input type="checkbox" checked="checked" class="popup__checkbox-input" name="rememberme" id="rememberme" value="forever" />
         Запомнить меня
      </div>
      <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
      <input type="submit" class="popup__button" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>" />

   </form>
   <div class="popup__link"><a href="#">Зарегистрироваться</a></div>
   </div>

   <?php do_action('woocommerce_after_customer_login_form'); ?>