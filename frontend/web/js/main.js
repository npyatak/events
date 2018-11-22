$(window).on('load', function () {
    $('#preloader').fadeOut(300);
})

$(document).ready(function () {

    var ol = $('ol');
    $.each(ol, function() {
        var ol_li = $(this).find('li');
        for(var i=0;i<ol_li.length;i++){
            $(ol_li[i]).append('<span class="dot">'+(i+1)+'</span>');
        }
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

    var i = 1, total = $('.owl-dots div').length;
    $('#info').html('1/'+total);

    $('#owl-events').on('initialized.owl.carousel changed.owl.carousel resized.owl.carousel', function(e) {
        owl_carousel_page_numbers(e);
    });


    function owl_carousel_page_numbers(e){
        var items_per_page = e.page.size;

        if (items_per_page > 1){

            var min_item_index  = e.item.index,
                max_item_index  = min_item_index + items_per_page,
                display_text    = (min_item_index+1) + '-' + max_item_index;

        } else {

            var display_text = (e.item.index+1);

        }

        $('#info').text( display_text + '/' + e.item.count);

    }

    $(this)
        .on('click','.more-btn-other',function () {
            $(this).find('i').toggleClass('fa-chevron-right fa-chevron-up')
        })
        .on('click','.turn-btn',function () {
            $(this).parent().parent().parent().toggleClass('flip');
        });

    var table = $('.event-content').find('table');
    if(table){
        $(table).wrapAll('<div class="table-wrap"><div class="container_inner"><div class="ckeditor"></div></div></div>');
        $('.table-wrap').append('<div class="table-btn"></div>');
    }

    $(window).resize(function () {
        var owl_img_height = $('.owl-carousel .owl-item:first-child').find('.image').height();
        $('#info').css({top:owl_img_height});

        if($(this).width() > 768){
            $('.table-wrap').find('.table-btn').css({'display':'none'})
        }else{
            $('.table-wrap').find('.table-btn').css({'display':'block'})
        }
    });
    $(window).trigger('resize');

    var count = 0,
        u = 100;
    $(document).on('click', '.table-btn', function () {
       var el = $(this),
           table = $(this).parent().find('.ckeditor'),
           pos = table.find('table').width() - $(window).width();
       count++;
       $(table).animate({scrollLeft: count * u}, 200);
       if(pos < table.scrollLeft()){
           $(this).css({"display":'none'});
       }else{
           $(this).css({"display":'block'});
       }
    });

    $('.table-wrap .ckeditor').on('scroll', function () {
       var pos = $(this).find('table').offset().left,
           elWidth = $(this).find('table').width() - $(window).width(),
           btn = $(this).parents().find('.table-btn');
        if(elWidth < Math.abs(pos) + 50){
            btn.addClass('none');
            console.log('no')
        }else{
            btn.removeClass('none');
            console.log('yes')
        }
    });

    masonryInit();

    // $('.turn').click(function(){
    //     $(this).addClass('flip');
    // },function(){
    //     $(this).removeClass('flip');
    // });


    $('.big-image_btn').click(function (e) {
        e.preventDefault();
        var parent_block = $(this).parent().parent();
        var big_modal = $('.big-image_modal');
        var image = parent_block.find('img').attr('src');
        var cap = parent_block.find('.caption').clone();
        var title = parent_block.find('.big-image_title').clone();
        big_modal.addClass('visible');
        big_modal.find('img').attr({'src':image});
        big_modal.find('.big-image_inner').append(cap);
        big_modal.append(title)
    });

    $(this)
        .on('click', '.big-image_modal-close', function () {
            var big_modal = $('.big-image_modal');
            big_modal.removeClass('visible');
            big_modal.find('.big-image_title').remove();
            big_modal.find('.caption').remove();
        });

    $('.main-share_btn').click(function () {
        $(this).toggleClass('rotate');
        $(this).find('i').toggleClass('ion-android-share ion-android-close');
        $(this).parent().toggleClass('visible');
    });
});

$('a.share, a.btn-share').click(function(e) {
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
        url += '&text='        + encodeURIComponent(obj.data('text'));
        url += '&image='       + encodeURIComponent(obj.data('image'));
        url += '&noparse=true';
    } else if(obj.data('type') == 'fb') {
        url = 'https://www.facebook.com/sharer/sharer.php?';
        url += 'u=' + encodeURIComponent(obj.data('url'));
        url += '&title='     + encodeURIComponent(obj.data('title'));
    } else if(obj.data('type') == 'ok') {
        url  = 'https://connect.ok.ru/offer';
        url += '?url=' + encodeURIComponent(obj.data('url'));
        url += '&title=' + encodeURIComponent(obj.data('title'));
        url += '&text=' + encodeURIComponent(obj.data('text'));
        url += '&imageUrl=' + encodeURIComponent(obj.data('image'));
    } else if(obj.data('type') == 'tw') {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(obj.data('title'));
        url += '&url='      + encodeURIComponent(obj.data('url'));
        url += '&counturl=' + encodeURIComponent(obj.data('url'));
    } else if(obj.data('type') == 'tg') {
        url  = 'https://telegram.me/share/url?';
        url += 'text='      + encodeURIComponent(obj.data('title'));
        url += '&url='      + encodeURIComponent(obj.data('url'));
        url += '&counturl=' + encodeURIComponent(obj.data('url'));
    }

    return url;
}