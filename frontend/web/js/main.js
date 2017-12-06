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

    // $(window).resize(function () {
    //     var event_content = $('.event-content').width();
    //     var block_content = $('.block_content').position().left;
    //     if($(this).width() < 1279 && $(this).width() > 768){
    //         $('.table-wrap').css({width: event_content + 120,'margin-left':-block_content})
    //     }
    // });
    // $(window).trigger('resize');

    masonryInit();

    // $('.turn').click(function(){
    //     $(this).addClass('flip');
    // },function(){
    //     $(this).removeClass('flip');
    // });
});

$('a.share').click(function(e) {
    url = getShareUrl($(this));

    window.open(url,'','toolbar=0,status=0,width=626,height=436');

    return false;
});

function masonryInit() {    
    var $container = $('.masonry-items');
    var columnWidth = 300;
    $('.grid-item').each(function () {
        if ($(this).width() < columnWidth) {
            columnWidth = $(this).width();
        }
    });
    // Инициализация Масонри, после загрузки изображений
    $container.masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: columnWidth,
        gutter: 40
    });
}

function getShareUrl(obj) {
    if(obj.data('type') == 'vk') {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(obj.data('url'));
        url += '&title='       + encodeURIComponent(obj.data('title'));
        url += '&text='        + encodeURIComponent(obj.data('desc'));
        url += '&image='       + encodeURIComponent(obj.data('image'));
        url += '&noparse=true';
    } else if(obj.data('type') == 'fb') {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(obj.data('title'));
        url += '&p[url]='       + encodeURIComponent(obj.data('url'));
        url += '&p[images][0]=' + encodeURIComponent(obj.data('image'));
        url += '&p[summary]='   + encodeURIComponent(obj.data('desc'));
    } else if(obj.data('type') == 'ok') {
        url  = 'http://www.ok.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments='  + encodeURIComponent(obj.data('desc'));
        url += '&st._surl='     + encodeURIComponent(obj.data('url'));
    } else if(obj.data('type') == 'tw') {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(obj.data('title'));
        url += '&url='      + encodeURIComponent(obj.data('url'));
        url += '&counturl=' + encodeURIComponent(obj.data('url'));
    } else if(obj.data('type') == 'tg') {
        url  = 'https://t.me/share/url?url=https://telegram.wiki';
    }

    return url;
}