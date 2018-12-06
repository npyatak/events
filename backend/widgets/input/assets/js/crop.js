var inputImage;
var images = [];
var cropper = [];

function initCropper(i) {
    var wrapper = $('.imageWrapper[data-i=\"'+i+'\"]');
    var image = wrapper.find('.image');
    var preview = wrapper.find('.preview');

    if($(window).height() - 150 < inputImage.height) {
        $('.crop-modal .crop-wrap').height($(window).height() - 150);
        $('.crop-modal .crop-wrap').width(inputImage.width * $('.crop-modal .crop-wrap').height() / inputImage.height);

        if($('.crop-modal .crop-wrap').width() > 1200) {
            $('.crop-modal .crop-wrap').width(1200);
            $('.crop-modal .crop-wrap').height(inputImage.height * $('.crop-modal .crop-wrap').width() / inputImage.width);
        }
    }

    if(cropper.hasOwnProperty(i)) {
        image.cropper('destroy');
    }
    
    var minCropBoxWidth = $('#cropform-'+i+'-imagewidth').val();
    var minCropBoxHeight = $('#cropform-'+i+'-imageheight').val();

    var containerWidth = inputImage.width;
    var containerHeight = inputImage.height;
    if(inputImage.width > $('.crop-modal .crop-wrap').width()) {
        containerWidth = $('.crop-modal .crop-wrap').width();
        containerHeight = containerWidth * inputImage.height / inputImage.width;

        minCropBoxWidth = minCropBoxWidth * $('.crop-modal .crop-wrap').width() / inputImage.width;
        minCropBoxHeight = minCropBoxHeight * $('.crop-modal .crop-wrap').height() / inputImage.height;
    }

    height = image.height() + 4;
    preview.css({ 
        width: '100%', //width,  sets the starting size to the same as orig image  
        overflow: 'hidden',
        height:    height,
        //maxWidth:  image.width(),
        //maxHeight: height
    });

    image.cropper({
        preview: preview,
        viewMode: 1,
        dragMode: 'none',
        zoomable: false,
        minContainerWidth: containerWidth,
        minContainerHeight: containerHeight,
        aspectRatio: $('#cropform-'+i+'-imagewidth').val() / $('#cropform-'+i+'-imageheight').val(),
        minCropBoxWidth: minCropBoxWidth,
        minCropBoxHeight: minCropBoxHeight,
        crop: function(event) {
            $(event.target).closest('.imageWrapper').find('.x').val(event.detail.x);
            $(event.target).closest('.imageWrapper').find('.y').val(event.detail.y);
            $(event.target).closest('.imageWrapper').find('.width').val(event.detail.width);
            $(event.target).closest('.imageWrapper').find('.height').val(event.detail.height);
        },
    });

    cropper[i] = image.data('cropper');

    if(inputImage.width < minCropBoxWidth || inputImage.height < minCropBoxHeight) {
        wrapper.find('.modal-title span').html('Внимание! Выбранное изображение меньше минимального размера, возможна потеря качества');
    } else {
        wrapper.find('.modal-title span').html('');
    }
}


$(document).on('click', '.showResult', function(e) {
    i = $(this).closest('.imageWrapper').attr('data-i');

    if(cropper.hasOwnProperty(i)) {
        var result = cropper[i].getCroppedCanvas({width: $('#cropform-'+i+'-imagewidth').val(), height: $('#cropform-'+i+'-imageheight').val()})
        $('#viewResult').modal().find('.modal-body').html(result);
    } else {
        src = $(this).closest('.imageWrapper').find('.preview').attr('data-image');
        $('#viewResult').modal().find('.modal-body').html('<img src=\"'+src+'\">');
    }

    return false;
});

$(document).on('shown.bs.modal', '#viewResult', function () {
    $('#viewResult .modal-dialog').css({width: $('#viewResult .modal-body img').width() + 30});
});

$(document).on('click', '.showCrop', function(e) {
    $(this).closest('.imageWrapper').find('.crop-modal').modal().find('.modal-title span').html($(this).closest('.imageWrapper').find('.header').html());

    return false;
});

//$('.crop-modal').on('shown.bs.modal', function () {
$(document).on('shown.bs.modal', '.crop-modal', function () {
    var i = $(this).closest('.imageWrapper').attr('data-i');
    initCropper(i);
});

$('#event-imagefile').change(function(e) {
    var input = $(this);
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            inputImage = new Image;
            inputImage.src = reader.result;

            $('.image').attr('src', reader.result);

            inputImage.onload = function() {
                input.closest('.images-wrap').find('.crop-modal').modal();
            }
        }
        reader.readAsDataURL(this.files[0]);
    }
});

$(document).on('change', '.crop-image-input', function(e) {
    if (this.files && this.files[0]) {
    	var imageWrapper = $(this).closest('.imageWrapper');
        var i = imageWrapper.attr('data-i');
        var reader = new FileReader();

        reader.onload = function (e) {
            inputImage = new Image;
            inputImage.src = reader.result;

            imageWrapper.find('.image').attr('src', reader.result);

            if(imageWrapper.find('.crop-modal').length) {
                inputImage.onload = function() {
                    imageWrapper.find('.crop-modal').modal();
                }
            } else {
                imageWrapper.find('.preview img').attr('src', reader.result);
            }
        }
        reader.readAsDataURL(this.files[0]);
    }
});