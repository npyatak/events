$(document).ready(function () {
    var body = $('body');

    $('html, body').animate({scrollTop:0}, 200);

    $(window).on('scroll', function () {
        var win_scr_top = $(window).scrollTop();
        if(win_scr_top <= 30){
            $('header, .general_content, .main-menu').removeClass('transform');
        }else if(win_scr_top >= 0){
            $('header, .general_content, .main-menu').addClass('transform');
        }

        scrollSpy();

        onScroll();
    });

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
        if($(this).hasClass('month_1')){
            $('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
        }else{
            if($(window).scrollTop() <= 0){
                $('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
            }else{
                $('html, body').animate({scrollTop:($(target).offset().top - 120)},500);
            }
        }
        // $('.navigation li').removeClass('active');
        // $(this).parent().addClass('active');
    });
    
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

    function scrollSpy() {
        var scrollSpy_wrap = $('.scrollSpy_wrap');
        var scrollSpy_wrapHeight = $('.scrollSpy_wrap').height();
        var scrollSpy_el = $('.scrollSpy');
        var win_offsetY = $(window).scrollTop() + 530;
        console.log(win_offsetY, scrollSpy_wrapHeight);
        if(win_offsetY >= scrollSpy_wrapHeight){
            $(scrollSpy_wrap).find(scrollSpy_el).addClass('no-fixed');
        }else {
            $(scrollSpy_wrap).find(scrollSpy_el).removeClass('no-fixed');
        }
    }
});
