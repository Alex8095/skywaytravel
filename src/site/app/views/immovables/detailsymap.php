<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php 
	$im_title = str_replace('"', "'", $Model->item["im_title"]);
	$area = $Model->dictionaries->getItemValue($Model->item["im_area_id"]);
	$city = $Model->dictionaries->getItemValue($Model->item["im_city_id"]);
	$category = $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]];
?>

<div class="ymap-view">
	<div class="main">
		<?php if($typeRentSale == "sale"):?>
			<dl class="price-block">
				<dt class="price-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></dt>
				<dd class="price-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace"], 4, "");?></dd>
				<dt class="price-msq-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / м.кв.</dt>
				<dd class="price-msq-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_sq"], 4, "");?> / м.кв.</dd>
			</dl>
		<?php else:?>
			<dl class="price-block">
				<dt class="price-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_manth"] * $exchangeRateObj->GetItemData('USD'), 4 );?></dt>
				<dd class="price-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_manth"], 4, "");?></dd>
				<?php if($Model->item["im_prace_day"]):?>
					<dt class="price-msq-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_day"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / сутки</dt>
					<dd class="price-msq-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_day"], 4, "");?> / сутки</dd>
				<?php endif;?>
			</dl>
		<?php endif;?>	
	</div>
	<a target="_blank" class="img" href="/<?php echo $category;?>/<?php echo $typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>" title="<?php echo $im_title;?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/<?php echo $Model->item["im_photo"];?>" width="250" alt="<?php echo $im_title;?>"/></a>
	<?php if($Model->item["im_adress_id"]):?> <h3 class="street"><a target="_blank" href="/<?php echo $category;?>/<?php echo $typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>"  title="<?php echo $im_title;?>"><?php echo ($Model->item["im_adress_id"] ? $Model->dictionaries->getItemValue($Model->item["im_adress_id"]) : $Model->dictionaries->getItemValue($Model->item["im_city_id"]))?><?php echo ($Model->item["im_adress_house"] ? sprintf(", %s", $Model->item["im_adress_house"]) : ""); ?></a></h3><?php endif;?>
	<div class="colomns info">
		<div class="colomn under-photo">
			<?php if($area): ?>
				<a href="/<?php echo $category;?>/<?php echo $typeRentSale;?>?<?php echo  $m->urlDictToParent($Model->item["im_area_id"])?>&action=ImFormSearch" title="<?php echo $area;?> район" class="city-area"><?php echo $area;?> район</a>
			<?php elseif ($city): ?>	
				<a href="/<?php echo $category;?>/<?php echo $typeRentSale;?>?<?php echo  $m->urlDictToParent($Model->item["im_city_id"], 2)?>&action=ImFormSearch" title="<?php echo $city;?>" class="city-area"><?php echo $city;?></a>
			<?php endif;?>
			<a target="_blank" href="/<?php echo $category;?>/<?php echo $typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>" title="<?php echo $im_title;?>"  class="im-code"><?php echo $Model->item["im_code"];?></a>
			<div class="clear"></div>
			<a target="_blank" class="panorama" href="http://maps.yandex.ru/?text=<?php echo $Model->dictionaries->getItemValue($Model->item["im_city_id"]);?>, <?php echo $Model->dictionaries->getItemValue($Model->item["im_adress_id"]);?> <?php echo $Model->item["im_adress_house"]?>&ol=stv&oll=<?php echo $Model->item["im_geopos"];?>&ll=<?php echo $Model->item["im_geopos"];?>&l=map%2Cstv"><span>&nbsp;</span><?php echo getLangString("viewImYPanorama");?></a>
		</div>
		<div class="colomn prop">
			<?php echo appHtmlClass::partial(sprintf("immovables/details/properties/%s", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model, "dontShowAdvicedParam" => true) )?><!--   -->
		</div>
		<div class="clear"></div>
		<div class="info-details">
			<?php echo appHtmlClass::partial(sprintf("immovables/details/properties/%s", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model) )?>
		</div>	
	</div>
	<div class="clear"></div>
</div>

<!-- 
<div class="ymap-view">
	<div class="colomns">
		<div class="colomn img">
			<div class="clear"></div>
			<?php if($typeRentSale == "rent"):?>
				<div class="price">
					<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_manth"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
					<p class="price-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_manth"], 4, "");?></p>
				</div>
			<?php else:?>
				<div class="price">
					<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
					<p class="price-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace"], 4, "");?></p>
					<p class="price-msq"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / $ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_sq"], 4, "");?> / 1 м.кв.</p>
				</div>
			<?php endif;?>
			<a target="_blank" href="/<?php echo $category;?>/<?php echo typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>" title="<?php echo $im_title;?>"  class="im-code"><?php echo $Model->item["im_code"];?></a>
			<a target="_blank" class="img" href="/<?php echo $category;?>/<?php echo typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>" title="<?php echo $im_title;?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/si_<?php echo $Model->item["im_photo"];?>" width="180" alt="<?php echo $im_title;?>"/></a>
		</div>
		<div class="colomn info">
			<h3 class="street"><a target="_blank" href="/<?php echo $category;?>/<?php echo typeRentSale;?>/1/<?php echo $Model->item["im_id"]?>" title="<?php echo $im_title;?>"><?php echo $Model->dictionaries->getItemValue($Model->item["im_adress_id"])?><?php echo ($Model->item["im_adress_house"] ? sprintf(", %s", $Model->item["im_adress_house"]) : ""); ?></a></h3>
			<?php if($area): ?>
				<a target="_blank" href="/<?php echo $category;?>/<?php echo typeRentSale;?>/1/?<?php echo $m->urlDictToParent($Model->item["im_area_id"])?>&action=ImFormSearch" title="<?php echo $area;?> район" class="city-area"><?php echo $area;?> район</a>
			<?php endif;?>
			<?php echo appHtmlClass::partial(sprintf("immovables/details/properties/%s", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model,) )?>"dontShowAdvicedParam" => true
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
 -->