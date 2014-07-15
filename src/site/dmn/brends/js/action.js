function OnSuccessDataForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#li-tabs-2").show();
			$("#DataForm input:hidden[name=ct_id]").val("" + callbackArgs.newActionID + "");
			$("#imageForm-ct_id").val("" + callbackArgs.newActionID + "");
			$("#li-tabs-3").show();
			$("#li-tabs-4").show();
			$("#ParentCtId").html("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Данные сохранены.').show();
}

function SaveImage (cont, action) {
	var optionsImage = { 
		target: "#images-list",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		beforeSubmit: valideImage,
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
function changeMainImageBrend() {
	var selected = $("#brend_ct_photo_type_id option:selected").val();
	if(selected == "4d05c24dc8477")
		$("#brend_is_main").val("1");
	else 
		$("#brend_is_main").val("");
}
/*	========================================================	*/
function TShowPageBrend(cont, action, div) {
	jQuery("#" + div).load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&parent_id=" + $("#ParentCtId").html() + "&dataType=html");
}

function TAddBrend(cont, action, div) {
	jQuery("#" + div).load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&parent_id=" + $("#ParentCtId").html() + "&dataType=html");
}

/*	banners	*/
function TBrendsEdit(cont, action, id, div) {
	jQuery("#" + div).load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&parent_id=" + $("#ParentCtId").html() + "&dataType=html&id=" + id);
}
function TBrendsDelete(cont, action, id, div) {
	jQuery("#" + div).load("/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&parent_id=" + $("#ParentCtId").html() + "&dataType=html&id=" + id);
}

