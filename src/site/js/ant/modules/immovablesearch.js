// JavaScript Document Module
function FieldsetClickHideShowListCheckbox(id) {
	if ($(id).is(":hidden")) {
		$(id).show();
		$(id + '_span').removeClass('ui-icon ui-icon-triangle-1-s');
		$(id + '_span').addClass('ui-icon ui-icon-triangle-1-n');
	} else {
		$(id).hide();
		$(id + '_span').removeClass('ui-icon ui-icon-triangle-1-n');
		$(id + '_span').addClass('ui-icon ui-icon-triangle-1-s');
	}
	return;
}
/**
 * предварительное найденное количество объектов недвижимости
 */
function precountfound(sleepcount) {
	setTimeout(function(){
		var form_params = $("#SearchFormIm").serialize();
		$.getJSON("/immovables/precountfound?" + form_params, function(data) {
			if (data.count) {
				$(".pre-count-found").show();	
				$(".pre-count-found .count").html(data.count);
			}
		});
	}, 500);
}
function split(val) {
	return val.split(/,\s*/);
}
function extractLast(term) {
	return split(term).pop();
}
function getImmovableImages(id){
	$.getJSON("/immovables/immovableimages?im_id=" + id, function(data) {
		if (data.length > 0) {
			$(".i-" + id + " .images").html("");
			for ( var i = 1; i < (data.length < 4 ? data.length : 4); i++) {
				$(".i-" + id + " .images").append('<img width="180" alt="" src="http://img.alfabrok.ua/files/images/immovables/st_' + data[i]["im_photo_name"] + '"/>');
			}
			$(".i-" + id + " .images").append('<div class="clear"></div>');
			$(".i-" + id + " .images").show();
		}
	});
}
function separatorInputNumber(id) {
	$(id).keyup(function () {
		if($(this).val() != "")
			$(this).val(accounting.formatNumber($(this).val()));
	});
}
