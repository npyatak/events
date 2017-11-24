$(document).ready(function () {

    $('.ckeditor ol li').each(function(i) {
        $(this).append('<span class="dot">'+(++i)+'</span>');
    });

    $('#owl-events').owlCarousel({
        margin: 0,
        autoplay: false,
        loop: false,
        items: 1,
        dots: true,
        nav: true,
        navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>']
    });

    $(this)
        .on('click','.show',function () {
            $(this).parent().parent().find('.visible').fadeOut(50);
            $(this).parent().parent().find('.hidden').fadeIn(200);
            $(this).toggleClass('show hide');
            $(this).find('.more-text').text('свернуть');
        })
        .on('click','.hide',function () {
            $(this).parent().parent().find('.visible').fadeIn(200);
            $(this).parent().parent().find('.hidden').fadeOut(50);
            $(this).toggleClass('show hide');
            $(this).find('.more-text').text('показать');
        })
        .on('click','.more-btn-other',function () {
            $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up')
        })
        .on('click','.turn',function () {
            $('.panel').toggleClass('flip');
        });

    var table = $('.event-content').find('table');
    if(table){
        $(table).wrapAll('<div class="table-wrap"><div class="container_inner"><div class="ckeditor"></div></div></div>');
    }

    $(window).resize(function () {
        var event_content = $('.event-content').width();
        var block_content = $('.block_content').position().left;
        if($(this).width() < 1279 && $(this).width() > 768){
            $('.table-wrap').css({width: event_content + 120,'margin-left':-block_content})
        }
    });
    $(window).trigger('resize');

    // $('.turn').click(function(){
    //     $(this).addClass('flip');
    // },function(){
    //     $(this).removeClass('flip');
    // });
});