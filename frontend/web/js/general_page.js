$(document).ready(function () {
    var body = $('body');

    $('html, body').animate({scrollTop:0}, 200);

    body.on('mousewheel', function (e) {
        var win_scr_top = $(window).scrollTop();
        if(e.originalEvent.wheelDelta > 0){
            if(win_scr_top <= 30){
                $('header, .general_content, .main-menu').removeClass('transform');
            }
        }else{
            if(win_scr_top >= 0){
                $('header, .general_content, .main-menu').addClass('transform');
            }
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

    $('.navigation li a').click(function (e) {
        e.preventDefault();
        $('.navigation li').removeClass('active');
        $(this).parent().addClass('active');
    });
    
    $('.share-inline_btn').click(function () {
        $(this).toggleClass('rotate');    
        $(this).find('i').toggleClass('fa-share-alt fa-times');
        $(this).parent().toggleClass('visible');
    });
});
