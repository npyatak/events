$('input[type=text], textarea').bind('input propertychange', function() {
	if(typeof($(this).attr('maxlength')) !== 'undefined') {
		var remain = $(this).attr('maxlength') - $(this).val().length;

		var remainContainer = $(this).parent().find('.remain');
		if(!remainContainer.length) {
			$(this).after('<span class="remain">'+remain+'</span>');
		} else {
			remainContainer.html(remain);
		}
	}
});