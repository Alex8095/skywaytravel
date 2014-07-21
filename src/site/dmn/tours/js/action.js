function OnSuccesstourForm(callbackArgs) {
	if (callbackArgs) {
		if (callbackArgs.newActionID) {
			$("#li-tabs-2").show();
			$("#li-tabs-3").show();
			$("#li-tabs-4").show();
			$("#li-tabs-5").show();
			$("#tourForm input:hidden[name=tour_id]").val("" + callbackArgs.newActionID + "");
			$("#imageForm-tour_id").val("" + callbackArgs.newActionID + "");
			$("#tourDatesForm input:hidden[name=tour_id]").val("" + callbackArgs.newActionID + "");
			$("#tourPriceForm input:hidden[name=tour_id]").val("" + callbackArgs.newActionID + "");
			$("#tourContryesForm input:hidden[name=tour_id]").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function OnSuccessTourCountryForm(callbackArgs) {
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function OnSuccessTourDateForm(callbackArgs) {
	$("#dates-list").html(callbackArgs.template);
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function OnSuccessTourPriceForm(callbackArgs) {
	$("#price-list").html(callbackArgs.template);
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function SaveImage(cont, action) {
	var optionsImage = {
		target : "#images-list",
		url : "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		// beforeSubmit: valideImage,
		success : sucessImage
	};
	jQuery('#imageForm').ajaxSubmit(optionsImage);
	return false;
}
function SaveImageGallery(cont, action) {
	var optionsImage = {
		target : "#images-gallery-list",
		url : "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		// beforeSubmit: valideImage,
		success : sucessImage
	};
	jQuery('#imageGalleryForm').ajaxSubmit(optionsImage);
	return false;
}
function valideImage(formData, jqForm, options) {
	var value = $("#image").val();
	var queryString = $.param(formData);
	alert(queryString);
	if (value == '') {
		$('#errOutput').show();
		$('#errOutput').text('Прикрепите пожалуйста файл для зарузки.');
		return false;
	} else
		return true;
}
function sucessImage(data) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Данные сохранены.');
	return false;
}
function changeMainImage() {
	var selected = $("#image_ct_photo_type_id option:selected").val();
	if (selected == "4fba172ec899c")
		$("#is_main").val("1");
	else
		$("#is_main").val("");
}