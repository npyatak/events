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

$(document).ready(function () {
	CKEDITOR.on( 'dialogDefinition', function(ev) {
		var dialogName = ev.data.name;
	    var dialogDefinition = ev.data.definition;

		if (dialogName == 'table'){
			var infoTab = dialogDefinition.getContents('info');
			txtWidth = infoTab.get('txtWidth');
			txtWidth['default'] = 670;
	    }
	});
});