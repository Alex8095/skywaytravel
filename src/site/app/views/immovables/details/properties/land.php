<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<?php 
	$rooms = $m->GetPropValue($Model->item, "4c400ed4e5797");
	$level =  $m->GetPropValue($Model->item, "4c400ec87481e");
	$sqlive =  $m->GetPropValue($Model->item, "4c402f924bc2a");
	$im_title = str_replace('"', "'", $Model->item["im_title"]);
	$area = $Model->dictionaries->getItemValue($Model->item["im_area_id"]);
?>
<div class="properties-view">
	<div class="h">
		<p class="title-ul-sq"><?php echo getLangString('ImFListHeaderSqPl');?>, соток</p>
		<dl class="param-list">
			<dt><?php echo getLangString('ImFListHeaderSq');?>:</dt>
			<dd><?php echo $Model->item["im_space"];?></dd>
			<?php if($sqlive):?>
				<dt><?php echo getLangString('ImFListHeaderSqLive');?>:</dt>
				<dd><?php echo $sqlive;?></dd>
			<?php endif;?>
			<?php if($sqkitchen):?>
				<dt><?php echo getLangString('ImFListHeaderSqKitchen');?>:</dt>
				<dd><?php echo $sqkitchen;?></dd>
			<?php endif;?>
		</dl>
		<div class="clear"></div>
		<?php if(($level) || ($rooms)):?>
		<dl class="param-list">
			<?php if($level):?>
				<dt><?php echo getLangString('ImLavel');?>:</dt>
				<dd><?php echo $level;?></dd>
			<?php endif;?>
			<?php if($rooms):?>
				<dt><?php echo getLangString('ImRoom');?>:</dt>
				<dd><?php echo $rooms;?></dd>
			<?php endif;?>
			</dl>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	<?php if(!$dontShowAdvicedParam):?>
		<table class="param-list-adviced">
			<?php echo $m->ClassPropPrint->GetPrint ($Model->propertiesData->ImPropData['is_print_ad'][$Model->item["im_id"]], 'GetPropTextTr' );?>
		</table>
	<?php endif;?>	
	<div class="clear"></div>
</div>