$(document).ready(function () {
   var page = 1;
   $('.advert').on('click', '#load-more', function(e) {
      e.preventDefault();
      page++;
      let api = wpApiSettings.root;
      $('.loader__anim').removeClass('hidden');
      $('#load-more').addClass('hidden');
      $.ajax({
            url: api + 'top/v1/get_products/',
            data: { page: page },
            type: 'post',
            success: function(result) {
               $('.loader__anim').addClass('hidden');
               $('.product-block__wrapper').html($('.product-block__wrapper').html() + result.html);
               if (result.count < 8) {
                  $('#load-more').addClass('hidden');
               } else {
                  $('#load-more').removeClass('hidden');
               }
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });

   $('.favorites-button').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      let button = $(this);
      let product;
      if (!$('.favorites').length) {
         product = button.closest('.product-card').data('id');
      } else {
         product = $('.favorites').closest('.favorites-item').data('id');
      }
      $.ajax({
            url: api + 'favourites/v1/get_favourites/',
            data: { 
               productId: product,
               userId: $('.header-top__profile').data('user'),
            },
            type: 'post',
            success: function(result) {
               if (!$('.favorites').length) {
                  if (result.operation === 'add') {
                     button.find('.favorites-button__icon__not').addClass('hidden');
                     button.find('.favorites-button__icon-added').removeClass('hidden');
                  } else if (result.operation === 'remove') {    
                     button.find('.favorites-button__icon__not').removeClass('hidden');
                     button.find('.favorites-button__icon-added').addClass('hidden');
                  }
               } else {
                  //$('.favorites-button').closest('.favorites__item').remove();
               }
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });


   $('.interactions__cart').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      let button = $(this);
      console.log('work');
      $.ajax({
            url: api + 'cart/v1/add_to_cart/',
            data: { 
               productId: button.closest('.product-card').data('id'),
               userId: $('.header-top__profile').data('user'),
            },
            type: 'post',
            success: function(result) {
               $('.header-top__counter').removeClass('hidden');
               $('.header-top__counter').html(parseInt($('.header-top__counter').html(), 10)+1);
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });

})