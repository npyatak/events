$(document).ready(function () {
    $(window).scroll(function () {
        if($(window).scrollTop() > 50){
            $('.main-menu').addClass('bg-white');
        }else{
            $('.main-menu').removeClass('bg-white');
        }
    })
});
