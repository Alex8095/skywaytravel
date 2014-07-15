function OnSuccessActionForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$("#li-tabs-2").show();
			$("#li-tabs-3").show();
			$("#GoodsStoresForm input:hidden[name=ga_id]").val("" + callbackArgs.newActionID + "");
			$("#ga-imageForm-ga_id").val("" + callbackArgs.newActionID + "");
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Data saved.').show();
}
function OnSuccessStoresForm(callbackArgs){
	if (callbackArgs) {
		if(callbackArgs.newActionID) {
			$('#block-tickets').load('/dmn/t-ajax.php?zone=dmn&cont=DMN_GoodsAction&action=getTickets&dataType=html&id=' + callbackArgs.newActionID);
			$("#li-tabs-4").show();
		}
	}
	$('#errOutput').hide();
	$('#errOutputGood').text('Data saved.').show();
}
function OnSuccessTicketForm(){
	$('#errOutput').hide();
	$('#errOutputGood').text('Data saved.').show();
}


function SaveImage (cont, action) {
	var optionsImage = { 
		target: "#place-image",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		success: sucessGAImage
	};	
	jQuery('#ga-imageForm').ajaxSubmit(optionsImage); 
	return false;
}
function sucessGAImage( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Data save.');
	return false;
}
