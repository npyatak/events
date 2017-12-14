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
            $('html, body').animate({scrollTop:($(target).offset().top - 430)},500);
        }else{
            if($(window).scrollTop() <= 0){
                $('html, body').animate({scrollTop:($(target).offset().top - 430)},500);
            }else{
                $('html, body').animate({scrollTop:($(target).offset().top - 130)},500);
            }
        }
        $('.navigation li').removeClass('active');
        $(this).parent().addClass('active');
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

    $('.categories li').first().find('a').addClass('all');

    // $(window).scroll(function () {
    //     scrollSpy()
    // });
    // function scrollSpy() {
    //     var scrollSpy_wrap = $('.scrollSpy_wrap');
    //     var scrollSpy_wrapHeight = $('.scrollSpy_wrap').height();
    //     var scrollSpy_el = $('.scrollSpy');
    //     var scrollSpy_elTop = scrollSpy_el.offset().top;
    //     var win_offsetY = window.pageYOffset;
    //     console.log(win_offsetY, scrollSpy_elTop);
    //     if(win_offsetY >= (scrollSpy_elTop -90) && win_offsetY <= (scrollSpy_elTop + (scrollSpy_wrapHeight -300))){
    //
    //     }else {
    //
    //     }
    // }
});
