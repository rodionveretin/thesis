$(document).ready(function () {
   $('.favorites-button').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      let button = $(this);
      let product;
      if ($('.product-item').length) {
         product = $('.product-item').data('id');
      } else {
         product = button.closest('.product-card').data('id');
      }
      button.find('button').addClass('loading');
      button.find('.favorites-button__icon__not').addClass('hidden');
      button.find('.favorites-button__icon-added').addClass('hidden');     
      $.ajax({
            url: api + 'favourites/v1/get_favourites/',
            data: { 
               productId: product,
               userId: $('.header-top__profile').data('user'),
            },
            type: 'post',
            success: function(result) {
               button.find('button').removeClass('loading');
               if (result.operation === 'add') {
                  button.find('.favorites-button__icon__not').addClass('hidden');
                  button.find('.favorites-button__icon-added').removeClass('hidden');
               } else if (result.operation === 'remove') {    
                  button.find('.favorites-button__icon__not').removeClass('hidden');
                  button.find('.favorites-button__icon-added').addClass('hidden');
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
      button.find('button').addClass('loading');
      button.find('svg').addClass('hidden');
      console.log('test');
      $.ajax({
            url: api + 'cart/v1/add_to_cart/',
            data: { 
               productId: button.closest('.product-card').data('id'),
               userId: $('.header-top__profile').data('user'),
            },
            type: 'post',
            success: function(result) {
               button.find('button').removeClass('loading');
               button.find('svg').removeClass('hidden');
               $('.header-top__counter').removeClass('hidden');
               $('.header-top__counter').html(parseInt($('.header-top__counter').html(), 10)+1);
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });

   $('.show-more').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      let page = 1;
      $.ajax({
            url: api + 'news/v1/get_news/',
            data: { 
               page: ++page,
            },
            type: 'post',
            success: function(result) {
               $('.blog__wrapper').html($('.blog__wrapper').html() + result.html);
               console.log(result.count);
               if (result.count < 4) {
                  $('.show-more').addClass('hidden');
               }
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });
  
   $('.tickets-modal__submit').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      
      $.ajax({
            url: api + 'tickets/v1/add_ticket/',
            data: {
               userId: $('.header-top__profile').data('user'),
               title: $('.tickets-modal__title').val(),
               message: $('.tickets-modal__message').val(),
            },
            type: 'post',
            success: function(result) {
               location.reload(); 
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });

   $('.single-ticket__submit').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      $.ajax({
            url: api + 'tickets/v1/add_ticket_answer/',
            data: {
               userId: $('.header-top__profile').data('user'),
               message: $('.single-ticket__input').val(),
               ticketId: $('.single-ticket').data('ticket'),
            },
            type: 'post',
            success: function(result) {
               location.reload(); 
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });

   $('.tickets__close-button').on('click', function(e) {
      e.preventDefault();
      let api = wpApiSettings.root;
      let button = $(this);
      $.ajax({
            url: api + 'tickets/v1/ticket_close/',
            data: {
               ticketId: button.closest('.tickets__item').data('ticket'),
            },
            type: 'post',
            success: function(result) {
               console.log('res');
               location.reload(); 
            },
            error: function(result) {
               console.warn(result);
            }
      });
      return false;
   });
})