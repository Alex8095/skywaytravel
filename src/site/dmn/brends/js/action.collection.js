function OnSuccessCDataForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#Cli-tabs-2").show();
			$("#DataCForm input:hidden[name=ct_id]").val("" + callbackArgs.newActionID + "");
			$("#imageCForm-ct_id").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function SaveCImage (cont, action) {
	var optionsImage = { 
		target: "#images-catalog-list",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		//beforeSubmit: valideCImage,
		success: sucessCImage
	};	
	jQuery('#imageCForm').ajaxSubmit(optionsImage); 
	return false;
}
function valideCImage(formData, jqForm, options) {
	var value = $("#Cimage").val();
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
function sucessCImage( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Данные сохранены.');
	return false;
}

