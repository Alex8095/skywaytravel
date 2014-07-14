<?php 
global $arWords;
global $routingObj;
global $renderHtmlLinkObj;
global $exchangeRateObj;
//$renderHtmlLinkObj->addJs("js/libs/highslide/highslide-with-gallery-ru");
$renderHtmlLinkObj->addJs("js/ant/libs/immovable");  
//$renderHtmlLinkObj->addCss("js/libs/highslide/highslide"); 
$renderHtmlLinkObj->addJs("js/libs/cufon/cufon-yui");
$renderHtmlLinkObj->addJs("js/libs/cufon/cufon-script");
$renderHtmlLinkObj->addCss("css/cufon");
//$m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);
?>
<div class="report-navigation">
	<a class="word" target="_blank" href="http://admin.alfabrok.ua/report_center.php?im_id=<?php echo $Model->item["im_id"];?>&lang_id=1&act=word" title="<?php echo getLangString("SubmitImWord");?>"><span class="bg-icons">&nbsp;</span></a>                           
	<a class="pdf" target="_blank" href="http://admin.alfabrok.ua/application/topdf/examples/pdf.php?im_id=<?php echo $Model->item["im_id"];?>&lang_id=1" title="<?php echo getLangString("SubmitPdf");?>"><span class="bg-icons">&nbsp;</span></a>
	<div class="clear"></div>
</div>
<div class="immovable-view">
	<div class="colomns">
		<div class="colomn w-500">
			<div class="info">
				<h3 class="adress"><?php echo ($Model->item["im_adress_id"] ? $Model->dictionaries->getItemValue($Model->item["im_adress_id"]) : $Model->dictionaries->getItemValue($Model->item["im_city_id"]))?><?php echo ($Model->item["im_adress_house"] ? sprintf(", %s", $Model->item["im_adress_house"]) : ""); ?></h3>
				<span class="code"><?php echo getLangString('ImFListHeaderCodeN');?>: <?php echo $Model->item["im_code"];?></span>
				<div class="clear"></div>
				<div class="photos">
					<div class="colomns">
						<div class="colomn w-300">
							<a href="<?php echo getLangString("imageDomain");?>/files/images/immovables/<?php echo $Model->item["im_photo"];?>" class="highslide"><img height="225" src="<?php echo getLangString("imageDomain");?>/files/images/immovables/si_<?php echo $Model->item["im_photo"];?>" alt="<?php echo $Model->item["im_title"];?>" title="<?php echo $Model->item["im_title"];?>"/></a>
                       <?php if($Model->imagesList): ?>
                       		<div>
                                <div class="bg-icons photos-count"><span class="bg-icons">&nbsp;</span><?php echo count($Model->imagesList);?></div>
                                <div class="clear"></div>
                            </div>
						<?php endif;?>
						</div>
						<div class="colomn w-160">
						</div>
						<div class="clear"></div>
					</div>
					<?php echo appHtmlClass::partialAction("immovables", "partailImages", $routingObj->getParam());?>
				</div>
				<div class="text">
					<h2><?php echo $Model->item["im_title"];?></h2>
					<div class="summary"><?php echo appHtmlClass::partialAction("immovables", "partailSummary", $routingObj->getParam());?></div>
				</div>
				<?php echo appHtmlClass::partial("immovables/details/social", array("socialData" => $appDataObj->social));?>
			</div>
			<div class="info-b bg-blocks">&nbsp;</div>
		</div>
		<div class="colomn w-475">
			<div class="colomns">
				<div class="colomn price-prop-colomn" >
					<div class="price-prop">
						<h3 class="price-grn"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace"] * $exchangeRateObj->GetItemData('USD'), 4 );?></h3>
						<p class="price-usd">$ <?php echo Discharge::GetDisValue ($Model->item ["im_prace"], 4, "");?></p>
               			<p class="price-eur">&#8364; <?php echo Discharge::GetDisValue (($Model->item ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('EUR'), 4, "");?></p>
						<p class="price-rub"><span>ք</span> <?php echo Discharge::GetDisValue (($Model->item ["im_prace"] * $exchangeRateObj->GetItemData('USD'))/$exchangeRateObj->GetItemData('RUB'), 4, "");?></p>
						<p class="price-msq"><?php echo Discharge::GetDisValue ( $Model->item ["im_prace_sq"] * $exchangeRateObj->GetItemData('USD'), 4 );?> / $ <?php echo Discharge::GetDisValue ($Model->item ["im_prace_sq"], 4, "");?> / 1 м.кв.</p>
                        <?php $area = $Model->dictionaries->getItemValue($Model->item["im_area_id"]); ?>
						 <?php $city = $Model->dictionaries->getItemValue($Model->item["im_city_id"]); ?>
						<?php if($area): ?>
							<a href="/<?php echo $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]];?>/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>?<?php echo  $m->urlDictToParent($Model->item["im_area_id"])?>&action=ImFormSearch" title="<?php echo $area;?> район" class="city-area"><?php echo $area;?> район</a>
						<?php elseif ($city): ?>	
							<a href="/<?php echo $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]];?>/sale/<?php echo $routingObj->getParamItem("page_id", 1);?>?<?php echo  $m->urlDictToParent($Model->item["im_city_id"], 2)?>&action=ImFormSearch" title="<?php echo $city;?>" class="city-area"><?php echo $city;?></a>
						<?php endif;?>
						<div class="clear"></div>
						<?php echo appHtmlClass::partial(sprintf("immovables/details/properties/%s", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model, "dontShowAdvicedParam" => true) )?>
						<div class="report-inner">
							<a class="send-to-friend" href="" alt="<?php echo getLangString("SubmitImFriend");?>" title="<?php echo getLangString("SubmitImFriend");?>"><span class="bg-icons">&nbsp;</span></a>
							<a class="print" href="/report/printpage/<?php echo $Model->item["im_id"];?>" alt="<?php echo getLangString("SubmitImPrint");?>" target="_blank" title="<?php echo getLangString("SubmitImPrint");?>"><span class="bg-icons">&nbsp;</span></a>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="price-prop-b bg-blocks">&nbsp;</div>
					<div class="qr-code-block">
						<img src="<?php echo getLangString("gr_code_url")?>?link=<?php echo $Model->getitemlink();?>&im_id=<?php echo $Model->item["im_id"];?>" alt="<?php echo getLangString("gr_code_title")?>"/>
						<div class="clear"></div>
					</div>
				</div>
				<div class="colomn three">
					<?php echo appHtmlClass::partial("immovables/details/realtor", array("Model" => $Model));?>
					<div class="comparing bg-blocks">
						<a href="/immovables/sravnenie" title="<?php echo getLangString("sravnenie_link_title"); ?>" class="comparing-objects-link" id="comparing-item-<?php echo $Model->item["im_id"];?>"><span class="bg-icons">&nbsp;</span><?php echo getLangString("sravnenie_link"); ?></a>
						<?php if(!empty($_COOKIE["comparing"])):?>
                        	<a href="/immovables/sravnenie" title="<?php echo getLangString("goToComparingList")?>" class="to-comparing-list"><span class="bg-icons">&nbsp;</span><?php echo getLangString("goToComparingList")?>: <span class="count"><?php echo count(json_decode($_COOKIE["comparing"], true)) ?></span></a>
                        <?php endif; ?>
						<div class="clear"></div>
					</div>
                    <?php echo appHtmlClass::partial("immovables/details/forminterested", array("Model" => $Model));?>
                    <?php echo appHtmlClass::partial(sprintf("immovables/details/properties/%sadvised", $arWords["TypeCatImNameArrIdPAge"][$Model->item["im_catalog_id"]]), array("Model" => $Model) )?>
				</div>
				<div class="clear"></div>
			</div>
			<?php if($Model->item["im_geopos"]):?>
                <div class="map">
                    <?php echo appHtmlClass::partial("immovables/details/ymap", array("Model" => $Model) )?>
                </div>
            <?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	var immovable = <?php echo json_encode($Model->item);?>;
</script>	
<?php
	$paramSimilar = array("is_cashe" => true, "im_is_sale" => true, "hide" => "show",  "im_catalog_id" => $Model->item["im_catalog_id"], "im_id" => $Model->item["im_id"], "im_area_id" => $Model->item["im_area_id"], "im_adress_id" => $Model->item["im_adress_id"], "im_space_like" => $Model->item["im_space"], "im_prace_like" => $Model->item["im_prace"], "limit" => 10);
	echo appHtmlClass::partialAction("immovables", "similarList", $paramSimilar); 
?>