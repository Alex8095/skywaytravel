function OnSuccessDataForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#li-tabs-2").show();
			$("#DataForm input:hidden[name=ct_id]").val("" + callbackArgs.newActionID + "");
			$("#imageForm-ct_id").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function SaveImage (cont, action) {
	var optionsImage = { 
		target: "#images-list",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		//beforeSubmit: valideImage,
		success: sucessImage
	};	
	jQuery('#imageForm').ajaxSubmit(optionsImage); 
	return false;
}
function valideImage(formData, jqForm, options) {
	var value = $("#image").val();
	var queryString = $.param(formData); 
	//alert(queryString);
	if(value == '') {
		$('#errOutput').show();
		$('#errOutput').text('Прикрепите пожалуйста файл для зарузки.');
		return false;
	}
	else 
		return true;
}
function sucessImage( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Данные сохранены.');
	return false;
}
function changeMainImage() {
	var selected = $("#image_ct_photo_type_id option:selected").val();
	if(selected == "4fb2c2c75e2f5")
		$("#is_main").val("1");
	else 
		$("#is_main").val();
}
