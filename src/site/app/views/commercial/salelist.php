<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>

<div class="immovables-list ilfat">
	<div class="h bg-blocks">&nbsp;</div>
	<div class="pager pager-top"><?php echo $Model->pager;?></div>
	<div class="c">
	<?php foreach ($Model->list as $key => $value):?>
		<?php 
			$rooms = $m->GetPropValue($value, "4c400ed4e5797");
			$float =  $m->GetPropValue($value, "4c404804b576c");
			$level =  $m->GetPropValue($value, "4c400ec87481e");
			$sqlive =  $m->GetPropValue($value, "4c604016208bc");
			$im_title = str_replace('"', "'", $value["im_title"]);
			$area = $Model->dictionaries->getItemValue($value["im_area_id"]);
			$city = $Model->dictionaries->getItemValue($value["im_city_id"]);
// 			if($value["im_city_id"] != "4c3eb839f144e") 
// 				$area = $city;
		?>
		<div class="item colomns i-<?php echo $value["im_id"]; ?>">
			<div class="colomn w-200 img">
				<div class="images"></div>
				<a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>" title="<?php echo $im_title;?>"><img src="<?php echo getLangString('imageDomain');?>/files/images/immovables/si_<?php echo $value["im_photo"];?>" width="180" alt="<?php echo $im_title;?>"/></a>
				<div class="colomns">
					<?php if($value["photos"]): ?>
						<div class="colomn bg-icons photos"><span class="bg-icons">&nbsp;</span><?php echo $value["photos"];?></div>
					<?php endif;?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="colomn info">
				<?php if($value["im_adress_id"]): ?><h3 class="street"><a href="/<?php echo $Model->getitemlink($value);?>" title="<?php echo $im_title;?>"><?php echo ($value["im_adress_id"] ? $Model->dictionaries->getItemValue($value["im_adress_id"]) : $Model->dictionaries->getItemValue($value["im_city_id"]))?><?php echo ($value["im_adress_house"] ? sprintf(", %s", $value["im_adress_house"]) : ""); ?></a></h3><?php endif;?>
				<div class="colomns ">
					<div class="colomn w-160">
						<?php if($area): ?>
							<a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>?<?php echo  $m->urlDictToParent($value["im_area_id"])?>&action=ImFormSearch" title="<?php echo $area;?> район" class="city-area"><?php echo $area;?> район</a>
						<?php elseif ($city): ?>	
							<a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>?<?php echo  $m->urlDictToParent($value["im_city_id"], 2)?>&action=ImFormSearch" title="<?php echo $city;?>" class="city-area"><?php echo $city;?></a>
						<?php endif;?>
						<div class="clear"></div>
						<a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>" title="<?php echo $im_title;?>"  class="im-code"><?php echo getLangString('ImFListHeaderCodeN');?>: <?php echo $value["im_code"];?></a>
					</div>
					<div class="colomn w-230 sq">
						<p class="title-ul-sq"><?php echo getLangString('ImFListHeaderSqPl');?>, м.кв.</p>
						<div class="colomn w-110">
							<ul class="colomn param-list">
								<li><?php echo getLangString('ImFListHeaderSq');?>:</li>
								<?php if($sqlive):?>
									<li><?php echo getLangString('ImFListHeaderSqLive');?>:</li>
								<?php endif;?>
								<?php if($sqkitchen):?>
									<li><?php echo getLangString('ImFListHeaderSqKitchen');?>:</li>
								<?php endif;?>
							</ul>
							<ul class="colomn param-list param-list-val">
								<li><?php echo $value["im_space"];?></li>
								<?php if($sqlive):?>
									<li><?php echo $sqlive;?></li>
								<?php endif;?>
							</ul>
							<div class="clear"></div>
						</div>
						<?php if(($float) || ($rooms)):?>
							<div class="colomn">
								<ul class="colomn param-list">
									<?php if($float):?>
										<li><?php echo getLangString('ImLavel');?>:</li>
									<?php endif;?>
									<?php if($rooms):?>
										<li><?php echo getLangString('ImRoom');?>:</li>
									<?php endif;?>
								</ul>
								<ul class="colomn param-list param-list-val">
									<?php if($float):?>
										<li><?php echo $float;?><?php if($level): ?> из <?php echo $level;?><?php endif;?></li>
									<?php endif;?>
									<?php if($rooms):?>
										<li><?php echo $rooms;?></li>
									<?php endif;?>
								</ul>
								<div class="clear"></div>
							</div>
						<?php endif;?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="buttoms">
					<a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>" title="<?php echo $im_title;?>" class="readmore"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMore');?></a>
					<a target="_blank" href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>" title="<?php echo $im_title;?>" class="readmoreblank"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMoreBlank');?></a>
                    <a href="/commercial/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>/<?php echo $value["im_id"]; ?>#map" title="<?php echo $im_title;?>" class="map"><span class="bg-icons">&nbsp;</span><?php echo getLangString('imReadMoreMap');?></a>
					<a href="/immovables/sravnenie" title="<?php echo getLangString("sravnenie_link_title"); ?>" class="comparing-objects-link" id="comparing-item-<?php echo $value["im_id"];?>"><span class="bg-icons">&nbsp;</span><?php echo getLangString("sravnenie_link"); ?></a>
				</div>
			</div>
			<div class="colomn price w-155">
				<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $value ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
				<p class="price-usd">$ <?php echo Discharge::GetDisValue ($value ["im_prace"], 4, "");?></p>
                <p class="price-eur">&#8364; <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('EUR'), 4, "");?></p>
				<p class="price-rub"><span>ք</span> <?php echo Discharge::GetDisValue (($value ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('RUB'), 4, "");?></p>
				<div class="immovable-mes">
					<?php if($value["im_date_add"] == date("y-m-d")): ?><p class="new"><?php echo getLangString("immovableMesNew")?></p><?php endif;?>
					<?php if($value["im_prace"] < $value["im_prace_old"]): ?><p class="price"><?php echo getLangString("immovableMesPrice")?></p><?php endif;?>
					<?php if($value["im_is_hot"]): ?><p class="hot"><?php echo getLangString("immovableMesHot")?></p><?php endif;?>
				</div>	
				<p class="price-msq"><?php echo Discharge::GetDisValue ( $value ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / $ <?php echo Discharge::GetDisValue ($value ["im_prace_sq"], 4, "");?> / 1 м.кв.</p>
			</div>
			<div class="clear"></div>
		</div>
	<?php endforeach;?>
	</div>
	<div class="pager"><?php echo $Model->pager;?></div>
	<div class="f bg-blocks">&nbsp;</div>
 </div>