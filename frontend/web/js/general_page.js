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
