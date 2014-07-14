
<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>

<div class="immovables-list ilnew w-782">
	<div class="h bg-blocks">&nbsp;</div>
	<div class="c">
	<?php foreach ($Model->list as $key => $value):?>
		<?php 
			$rooms = $m->GetPropValue($value, "4c400ed4e5797");
			$float =  $m->GetPropValue($value, "4c400ea1b5657");
			$level =  $m->GetPropValue($value, "4c400ec87481e");
			$sqlive =  $m->GetPropValue($value, "4c4012253a36f");
			$sqkitchen =  $m->GetPropValue($value, "4c40122f31138");
			$im_title = str_replace('"', "'", $value["im_title"]);
			$area = $Model->dictionaries->getItemValue($value["im_area_id"]);
		?>
		<div class="item colomns">
			<div class="colomn w-200 img">
				<a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/si_<?php echo $value["im_photo"];?>" width="180" alt="<?php echo $im_title;?>"/></a>
				<div class="colomns">
					<?php if($value["photos"]): ?>
						<div class="colomn bg-icons photos"><span class="bg-icons">&nbsp;</span><?php echo $value["photos"];?></div>
					<?php endif;?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="colomn info">
				<h3 class="street"><a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>"><?php echo $Model->dictionaries->getItemValue($value["im_adress_id"])?><?php echo ($value["im_adress_house"] ? sprintf(", %s", $value["im_adress_house"]) : ""); ?></a></h3>
				<div class="colomns ">
					<div class="colomn w-160">
						<?php if($area): ?><a href="/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>/<?php echo $routingObj->getParamItem("page_id", 1);?>?<?php echo  $m->urlDictToParent($value["im_area_id"])?>&action=ImFormSearch" title="<?php echo $area;?> район" class="city-area"><?php echo $area;?> район</a><?php endif;?>
						<div class="clear"></div>
						<a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>"  class="im-code"><?php echo getLangString('ImFListHeaderCodeN');?>: <?php echo $value["im_code"];?></a>
						<div class="clear"></div>
						<a class="type-category" href="/<?php echo $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]; ?>/<?php echo ($value["im_is_sale"] ? "sale" : "rent");?>" title="<?php echo getLangString($value["im_catalog_id"] . "_item"); ?>"><?php echo getLangString($value["im_catalog_id"] . "_item"); ?></a>
					</div>
					<div class="colomn w-230 sq">
						<?php 
							$Model->item = $value;
							echo appHtmlClass::partial(sprintf("immovables/details/properties/%s", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model) );
						?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="buttoms">
					<a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>" class="readmore"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMore');?></a>
                    <a target="_blank" href="<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>" class="readmoreblank"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMoreBlank');?></a>
					<a href="/<?php echo $Model->getitemlink($value);?>#map" title="<?php echo $im_title;?>" class="map"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMoreMap');?></a>
					<a href="/immovables/sravnenie" title="<?php echo getLangString("sravnenie_link_title"); ?>" class="comparing-objects-link" id="comparing-item-<?php echo $value["im_id"];?>"><span class="bg-icons">&nbsp;</span><?php echo getLangString("sravnenie_link"); ?></a>
				</div>
			</div>
			<div class="colomn price w-155">
				<?php if($value["im_is_sale"]):?>
					<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $value ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
					<p class="price-usd">$ <?php echo Discharge::GetDisValue ($value ["im_prace"], 4, "");?></p>
					<p class="price-msq"><?php echo Discharge::GetDisValue ( $value ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / $ <?php echo Discharge::GetDisValue ($value ["im_prace_sq"], 4, "");?> / 1 м.кв.</p>
               		<p class="price-eur">&#8364; <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('EUR'), 4, "");?></p>
					<p class="price-rub"><span>ք</span> <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('RUB'), 4, "");?></p>
				<?php else: ?>
					<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $value ["im_prace_manth"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
					<p class="price-usd">$ <?php echo Discharge::GetDisValue ($value ["im_prace_manth"], 4, "");?></p>
                	<p class="price-eur">&#8364; <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('EUR'), 4, "");?></p>
					<p class="price-rub"><span>ք</span> <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('RUB'), 4, "");?></p>
                    <?php if($value ["im_prace_sq"])?>
					<p class="price-msq"><?php echo Discharge::GetDisValue ( $value ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / $ <?php echo Discharge::GetDisValue ($value ["im_prace_sq"], 4, "");?> / 1 м.кв.</p>
				<?php endif;?>
			</div>
			<div class="clear"></div>
		</div>
	<?php endforeach;?>
	</div>
	<div class="f bg-blocks">&nbsp;</div>
 </div>