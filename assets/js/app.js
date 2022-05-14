$(document).ready(function () {

const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    slidesPerView: 1,
    spaceBetween: 25,
    autoplay: {
        delay: 5000,
    },
});

$('.search__input').focus(function() {  
    if (window.innerWidth >= 768) {
        if ($('#wpadminbar').length > 0) {
            $('.focus').height(`calc(100vh - ${$('.header-top').height() + $('#wpadminbar').height()}px)`);
        } else {
            $('.focus').height(`calc(100vh - ${$('.header-top').height()}px)`);
        };   
        $('.focus').css('opacity', '0.6');
        $('.search__input').removeAttr('placeholder');
    }
}); 

$('.search__input').blur(function() {
    $('.focus').removeAttr('style');
    $('.search__input').attr('placeholder', 'Поиск');
}); 

$(window).scroll(function() {
    if ($('.focus').css('height') !== '0px') {
        $('.focus').height(0);
        $('.search__input').blur().attr('placeholder', 'Поиск');
    }
}); 

$('.catalog-button').click(function() {
    $('.categories').slideToggle('300');
}); 

$('.mobile-menu__button').eq(0).click(function() {
    $('.categories').removeAttr('style');
    $('.navbar-mobile').removeAttr('style');
    $('.header-top__search-form').removeAttr('style');
}); 

$('.mobile-menu__button').eq(1).click(function() {
    $('.categories').slideToggle('300');
    $('.header-top__search-form').removeAttr('style');
    $('.navbar-mobile').removeAttr('style');
}); 

$('.mobile-menu__button').eq(2).click(function() {
    $('.categories').removeAttr('style');
    $('.navbar-mobile').removeAttr('style');
    $('.header-top__search-form').removeAttr('style');
});

$('.mobile-menu__button').eq(3).click(function() {
    $('.header-top__search-form').slideToggle('300');
    $('.categories').removeAttr('style');
    $('.navbar-mobile').removeAttr('style');
});

$('.mobile-menu__button').eq(4).click(function() {
    $('.navbar-mobile').slideToggle('300');
    $('.categories').removeAttr('style');
    $('.header-top__search-form').removeAttr('style');
});

$('.header-top__login').click(function() {
    $('.popup__login').removeClass('popup--hidden');
    $('.focus').addClass('focus--active');
    $('body').css('overflow', 'hidden');
    $('.categories').removeAttr('style');
    $('.navbar-mobile').removeAttr('style');
    $('.header-top__search-form').removeAttr('style');
});

$('.header-top__img').click(function() {
    $('.header-top__profile-menu').slideToggle('300');
});

$('.popup__control').click(function() {
    $('.popup__control').toggleClass('popup__control--disabled');
    if ($('.popup__password').find('.popup__input').attr('type') == 'password') $('.popup__password').find('.popup__input').attr('type', 'text')
    else $('.popup__password').find('.popup__input').attr('type', 'password');
});

$('.popup__registration').find('.popup__link').eq(0).click(function() {
    $('.popup__registration').addClass('popup--hidden');
    $('.popup__login').removeClass('popup--hidden');
});

$('.popup__login').find('.popup__link').eq(0).click(function() {
    $('.popup__login').addClass('popup--hidden');
    $('.popup__registration').removeClass('popup--hidden');
});

$('.popup__button-close').click(function() {
    $('.popup__login').addClass('popup--hidden');
    $('.popup__registration').addClass('popup--hidden');
    $('.focus').removeClass('focus--active');
    $('body').css('overflow', 'visible');
});


});