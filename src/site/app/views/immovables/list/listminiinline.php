<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php if($Model->list):?>
	<?php foreach ($Model->list as $key => $value):?>
		<?php 
			$im_title = str_replace('"', "'", $value["im_title"]);
			$area = $Model->dictionaries->getItemValue($value["im_area_id"]);
		?>
		<div class="item <?php echo (!empty($itemWidth) ? $itemWidth : "w-290");?> type-im-<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]];?>">
			<div class="colomns">
				<div class="colomn w-140">
					<a href="/<?php echo $Model->getitemlink($value); ?>" title="<?php echo $im_title;?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/si_<?php echo $value["im_photo"];?>" height="120" alt="<?php echo $im_title;?>"/></a>
				</div>
				<div class="colomn w-150 info">
					<h3 class="street"><a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>"><?php echo $Model->dictionaries->getItemValue($value["im_adress_id"])?><?php echo ($value["im_adress_house"] ? sprintf(", %s", $value["im_adress_house"]) : ""); ?></a></h3>
					
					<a href="/<?php echo $Model->getitemlink($value); ?>" title="<?php echo $im_title;?>"  class="im-code"><?php echo getLangString('ImFListHeaderCodeN');?>: <?php echo $value["im_code"];?></a>
					<div class="clear"></div>
					<?php if($value["im_is_rent"]):?>
						<h4 class="price-grn"><?php echo Discharge::GetDisValue ( $value ["im_prace_manth"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h4>
					<?php else:?>
						<h4 class="price-grn"><?php echo Discharge::GetDisValue ( $value ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h4>
					<?php endif;?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php endforeach;?>
	<div class="clear"></div>
<?php endif; ?>