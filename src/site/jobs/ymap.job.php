<?php
/**
 * джоба обновляет значение для геопозиции и шаблоны недвижимости для карты
 */
require 'config.php';
global $arWords;
$arWords = initLang ( "ru" );
global $exchangeRateObj;
$exchangeRateObj = new exchangeRateClass ();
$mysql = new mysql_select ( "immovables", "where im_geopos is not null" );
// $mysql->select_table("im_id");

$mysql->query ( "select i.* from immovables i 
		join immovables_logs l on i.im_id = l.im_id 
		where i.im_geopos is not null and l.change_date like '%" . date ( "Y-m-d" ) . "%' 
		or i.im_geopos is not null and i.im_date_add like '%" . date ( "Y-m-d" ) . "%'", "im_id" );

$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
$model->buildDictionaries ();
if ($mysql->table) {
	foreach ( $mysql->table as $key => $value ) {
		$pos = strpos ( $value["im_geopos"], "," );
		if (! empty ( $pos )) {
			$n = str_replace ( ",", "", substr ( $value["im_geopos"], 0, $pos ) );
			$e = str_replace ( ",", "", substr ( $value["im_geopos"], $pos + 1, strlen ( $value["im_geopos"] ) ) );
			if (! empty ( $n ) && ! empty ( $e )) {
				$param["im_id"] = sprintf ( '%s', $value["im_id"] );
				$model->getPropertiesList ( $param );
				unset ( $param["im_id"] );
				$model->buildPropertiesData ();
				$m = new ModuleSiteIm ( array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData );
				$model->item = $value;
				$rent_template = "";
				if ($value["im_is_rent"])
					$rent_template = mysql_real_escape_string ( appHtmlClass::partial ( "immovables/detailsymap", array(
							"Model" => $model,
							"m" => $m,
							"typeRentSale" => "rent") ) );
				$sale_template = "";
				if ($value["im_is_sale"])
					$sale_template = mysql_real_escape_string ( appHtmlClass::partial ( "immovables/detailsymap", array(
							"Model" => $model,
							"m" => $m,
							"typeRentSale" => "sale") ) );
				$mysql->insert ( sprintf ( "insert into immovables_map (im_id, im_geopos_e, im_geopos_n, rent_template, sale_template) VALUES (%s, %s, %s, '%s', '%s') ON DUPLICATE KEY UPDATE im_geopos_e = %s, im_geopos_n = %s, rent_template = '%s', sale_template = '%s';", $value["im_id"], $e, $n, $rent_template, $sale_template, $e, $n, $rent_template, $sale_template ) );
			}
		}
	}
}
devLogs::_echo ( "done" );
