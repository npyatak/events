
	var images = [];
	var cropper = [];

	$('#sourceImage').change(function(e) {
		$('.image').attr('src', $(this).val());
		initCroppers();
	});


	function initCroppers() {
		var rows = $('.image-row');
		for (var j = 1; j <= rows.length; j++) {
			i = j - 1;
			var row = $(rows[i]);
			images.push($(rows[i]).find('.image'));
			images[i].cropper({
				viewMode: 1,
				dragMode: 'move',
			    //minCropBoxWidth: $('#eventimagesform-'+i+'-imagewidth').val(),
			    //minCropBoxHeight: $('#eventimagesform-'+i+'-imageheight').val(),
			    aspectRatio: $('#eventimagesform-'+i+'-imagewidth').val() / $('#eventimagesform-'+i+'-imageheight').val(),
			    crop: function(event) {
			        $(event.target).closest('.image-row').find('.x').val(event.detail.x);
			        $(event.target).closest('.image-row').find('.y').val(event.detail.y);
			        $(event.target).closest('.image-row').find('.width').val(event.detail.width);
			        $(event.target).closest('.image-row').find('.height').val(event.detail.height);
			        //$(event.target).closest('.image-row').find('.scaleX').val(event.detail.scaleX);
			        //$(event.target).closest('.image-row').find('.scaleY').val(event.detail.scaleY);
			        console.log(event.detail);
			    }
			});

			cropper.push(images[i].data('cropper'));
		}
	}


	$('.getCroppedCanvas').click(function(e) {
		i = $(this).closest('.image-row').attr('data-i');
		var result = cropper[i].getCroppedCanvas({width: $('#eventimagesform-'+i+'-imagewidth').val(), height: $('#eventimagesform-'+i+'-imageheight').val()})
		$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
		$('#getCroppedCanvasModal .modal-dialog').css({width: parseInt($('#eventimagesform-'+i+'-imagewidth').val()) + 30});

		return false;
	});

	$('.showModal').click(function(e) {
		$(this).closest('.image-row').find('.modal').modal();
		alert('ok');

		return false;
	});

    $('#event-imagefile').change(function(e) {
    	if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
				$('.image').attr('src', e.target.result);
				initCroppers();
            }
            reader.readAsDataURL(this.files[0]);
        }
    });