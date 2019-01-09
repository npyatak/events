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
        $('.table-wrap').append('<div class="table-btn right"></div><div class="table-btn left"></div>');
    }

    $(window).resize(function () {
        var owl_img_height = $('.owl-carousel .owl-item:first-child').find('.image').height();
        $('#info').css({top:owl_img_height});

        if($(this).width() > 768) {
            $('.table-wrap').find('.table-btn.right').css({'display':'none'});
            $('.table-wrap').find('table').css({'min-width':'inherit'});
        } else {
            $('.table-wrap').find('.table-btn.right').css({'display':'block'});
            var tables = $('.table-wrap table');
            $.each(tables, function () {
                $(this).css({'min-width': $(this).css('width')});
            })
        }
    });
    $(window).trigger('resize');

    var u = 100;
    window.count = 0;
    $(document)
        .on('click', '.table-btn.right', function () {
            var el = $(this),
               table = $(this).parent().find('.ckeditor'),
               pos = table.find('table').width() - $(window).width();
            window.count++;
            $(table).animate({scrollLeft: window.count * u}, 200);
            if(pos < table.scrollLeft()){
               $(this).css({"display":'none'});
            }else{
               $(this).css({"display":'block'});
            }
        })
        .on('click', '.table-btn.left', function () {
            var el = $(this),
                table = $(this).parent().find('.ckeditor'),
                pos = table.find('table').width() - $(window).width();
            window.count--;
            $(table).animate({scrollLeft: window.count * u}, 200);
            if(pos > table.scrollLeft()){
                $(this).css({"display":'none'});
            }else{
                $(this).css({"display":'block'});
            }
        });

    $('.table-wrap .ckeditor').on('scroll', function () {
       var pos = $(this).find('table').offset().left,
           elWidth = $(this).find('table').width() - $(window).width(),
           btn_left = $(this).parents().find('.table-btn.left'),
           btn_right = $(this).parents().find('.table-btn.right');
        if (elWidth < Math.abs(pos) + 40) {
            btn_right.addClass('none');
        }else {
            btn_right.removeClass('none');
        }
        if(Math.abs(pos) > 60) {
            btn_left.css({'display':'block'});
            btn_left.removeClass('none');
        }else{
            btn_left.addClass('none');
        }
        if(Math.abs(pos) === 35) {
            window.count = 0;
        }
    });

    masonryInit();

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

// SCRIPT ON GENERAL

$(document).ready(function () {
    var monthId = window.monthId;

    $('.scroll-month').click(function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        scrollToMonth(target, 'month_1');
    });

    if(monthId) {
        var currentYear = new Date().getFullYear();

        if(window.year != currentYear) {
            scrollToMonth('#month_'+monthId);
        } else {
            var prev = 1;
            if(monthId != 1){
                prev = monthId - 1;
            }
            $('html, body').animate({'scrollTop':$('#month_'+prev+'.month-items').offset().top - 350},0);
            scrollToMonth('#month_'+monthId);
        }
        setTimeout(function () {
            $('.navigation').find('li.active').removeClass('active');
            $('.navigation').find('.month_'+monthId).parent().addClass('active');
            $('#events').find('month_items.active').removeClass('active');
            $('#events').find('#month_'+monthId).addClass('active');
        },50);
        setTimeout(function () {
            $(window).on('scroll', function () {
                var win_scr_top = $(window).scrollTop();
                if(win_scr_top <= 30){
                    $('header, .general_content, .main-menu').removeClass('transform');
                    $('.main-share_btn.rotate').click();
                }else if(win_scr_top >= 0){
                    $('header, .general_content, .main-menu').addClass('transform');
                }
                scrollSpy();
                onScroll();
                scrollSpy2();
            });
        },3000);
    }

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

        $('.month-items').removeClass('active');
        $('.month-items:first-child').addClass('active');
    }

    function scrollToMonth(target, hasClass) {
        if($(window).width() >= 768) {
            if(typeof hasClass == 'undefined'){
                $(window).on('load',function () {
                    $('html, body').animate({scrollTop:($(target).offset().top - 360)},500);
                });
            }else{
                if($(window).scrollTop() <= 0){
                    $('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
                }else{
                    $('html, body').animate({scrollTop:($(target).offset().top - 120)},500);
                }
            }
        }else{
            if(monthId === 1){
                $(window).on('load',function () {
                    $('html, body').animate({scrollTop:($(target).offset().top - 200)},500);
                });
            }else{
                $('html, body').animate({scrollTop:($(target).offset().top - 200)},500);
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

    function scrollSpy2() {
        var footer_top = $('footer').offset().top;
        var scrollSpy_el = $('aside');
        var a = window.pageYOffset + scrollSpy_el.height() + 200;
        var scrollSpy_wrap = $('.scrollSpy_wrap');
        if(a >= footer_top){
            $(scrollSpy_wrap).find(scrollSpy_el).addClass('no-fixed');
        }else{
            $(scrollSpy_wrap).find(scrollSpy_el).removeClass('no-fixed');
        }
    }
});

// END

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
        transitionDuration: 0,
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