$(document).ready(function () {
    var body = $('body');

    $('html, body').animate({scrollTop:0}, 200);

    function right_aside() {
        var cont = $('.container').width();
        var win_width = $(window).width();
        $('aside').css({right:((win_width - cont) / 2) - 20});
    }

    right_aside();

    $(window).resize(function () {
        right_aside();

    });
    $(window).trigger('resize');

    $('.scroll-month').click(function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        scrollToMonth(target, 'month_1');
    });

    function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');

        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
    }

    $('.share-inline_btn').click(function () {
        $(this).toggleClass('rotate');    
        $(this).find('i').toggleClass('ion-android-share ion-android-close');
        $(this).parent().toggleClass('visible');
    });

    $('aside a').click(function (e) {
        e.preventDefault();
        $('aside').removeClass('active');
        $('body').removeClass('overflow');
        $('aside a').removeClass('active');
        $(this).addClass('active');
    });

    $('.main-menu_btn').click(function () {
        $('body').addClass('overflow');
        $('aside').addClass('active');
    });
    $('.close_aside').click(function () {
        $('body').removeClass('overflow');
        $('aside').removeClass('active')
    });

    $('.navigation li:first-child').addClass('active');
    $('.categories li').first().find('a').addClass('all');

    var currentScreen;
    var goTos = $('.scroll-month');
    var sections = $('.month-items');

    function setActivationStatus(el, currentScreen) {
        if (el.getAttribute('href') === currentScreen) {
            el.parentElement.classList.add('active');
        } else {
            el.parentElement.classList.remove('active');
        }
    }

    function onScroll() {
        for (var i = 0; i < sections.length; i++) {
            var rect = sections[i].getBoundingClientRect();

            if (rect.top < 150 && rect.height + rect.top > 150) {
                currentScreen = '#' + sections[i].getAttribute('id');
                for (var i = 0; i < goTos.length; i++) {
                    setActivationStatus(goTos[i], currentScreen);
                }
            }
        }
    }

    $('.lazy').lazyload({
        effect : 'fadeIn',
        threshold : -200
    });
    
    $('.categories a').on('click', function() {
        var elem = $(this);

        $('.grid-item').addClass('inactive');
        $('.grid-item.cat_'+elem.data('category')).removeClass('inactive');

        history.pushState(null, '', elem .attr('href'));
        
        $('.categories a').removeClass('active');
        elem.addClass('active');
        
        if($(this).hasClass('all')){
            $('.grid-item').removeClass('inactive');
        }

        return false;
    });
});

function scrollToMonth(target, hasClass) {
    if(typeof hasClass == 'undefined'){
        $(window).on('load',function () {
            $('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
        });
    }else{
        if($(window).scrollTop() <= 0){
            $('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
        }else{
            $('html, body').animate({scrollTop:($(target).offset().top - 120)},500);
        }
    }
}

function scrollSpy() {
    var footer_top = $('footer').offset().top;
    var a = window.pageYOffset + window.innerHeight;
    var scrollSpy_wrap = $('.scrollSpy_wrap');
    var scrollSpy_el = $('.scrollSpy');
    if(a >= footer_top){
        $(scrollSpy_wrap).find(scrollSpy_el).addClass('no-fixed');
    }else{
        $(scrollSpy_wrap).find(scrollSpy_el).removeClass('no-fixed');
    }
}