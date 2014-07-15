function SaveSectors (cont, action) {
	var optionsSectorsCodeImage = { 
		target: "#sector-list",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		success: sucessSectorsCode
	};	
	jQuery('#t-sectorForm').ajaxSubmit(optionsSectorsCodeImage); 
	return false;
}
function SaveImage (cont, action) {
	var optionsImage = { 
		target: "#place-image",	
		url: "/dmn/t-ajax.php?zone=dmn&cont=" + cont + "&action=" + action + "&dataType=html",
		success: sucessSectorsCode
	};	
	jQuery('#t-imageForm').ajaxSubmit(optionsImage); 
	return false;
}
function sucessSectorsCode( data ) {
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Data save.');
	return false;
}


