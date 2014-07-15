function OnSuccessADataForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#Ali-tabs-2").show();
			$("#DataAForm input:hidden[name=ct_id]").val("" + callbackArgs.newActionID + "");
			$("#imageAForm-ct_id").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function SaveAImage (cont, action) {
	var optionsImage = { 
		target: "#images-archive-list",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		//beforeSubmit: valideAImage,
		success: sucessAImage
	};	
	jQuery('#imageAForm').ajaxSubmit(optionsImage); 
	return false;
}
function valideAImage(formData, jqForm, options) {
	var value = $("#Aimage").val();
	var queryString = $.param(formData); 
	alert(queryString);
	if(value == '') {
		$('#errOutput').show();
		$('#errOutput').text('Прикрепите пожалуйста файл для зарузки.');
		return false;
	}
	else 
		return true;
}
function sucessAImage( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Данные сохранены.');
	return false;
}

