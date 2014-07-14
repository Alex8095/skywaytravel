<div class="ps">
<?php
global $arWords;
$m = new ModuleSiteIm ( array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData );

devLogs::_printr($Model->list);
return;
foreach ( $Model->list as $key => $value ) {
	$Model->item = $value;
	if ($value["im_is_rent"]) {
		devLogs::_echo ( "rent" );
		echo appHtmlClass::partial ( "immovables/detailsymap", array(
				"Model" => $Model,
				"m" => $m,
				"typeRentSale" => "rent") );
	}
	if ($value["im_is_rent"]) {
		devLogs::_echo ( "sale" );
		echo appHtmlClass::partial ( "immovables/detailsymap", array(
				"Model" => $Model,
				"m" => $m,
				"typeRentSale" => "sale") );
	}
}
?>
</div>