<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<?php
//$sost = $m->GetPropValue ( $Model->item, "4c4016aeca9be" );
//devLogs::_printr($Model->propertiesData->ImPropData);

$rooms = $m->GetPropValue ( $Model->item, "4c400ed4e5797" );
$float = $m->GetPropValue ( $Model->item, "4c400ea1b5657" );
$level = $m->GetPropValue ( $Model->item, "4c400ec87481e" );
$sqlive = $m->GetPropValue ( $Model->item, "4c4012253a36f" );
$sqkitchen = $m->GetPropValue ( $Model->item, "4c40122f31138" );
$im_title = str_replace ( '"', "'", $Model->item ["im_title"] );
$area = $Model->dictionaries->getItemValue ( $Model->item ["im_area_id"] );
?>
<?php $data = $m->ClassPropPrint->GetPrint ($Model->propertiesData->ImPropData['is_print_ad'][$Model->item["im_id"]], 'GetPropTextTr' );?>
<?php if($data): ?>
	<div id="advised-properties-view" class="advised-properties-view">
		<a class="btm" href="#advised-properties-view" title="<?php echo getLangString("Расширенные характеристики")?>"><?php echo getLangString("Расширенные характеристики")?></a>
		<div class="block">
			<table class="param-list-adviced">
				<?php echo $data?>
			</table>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
<?php endif;?>