<?php
global $routingObj;
global $arWords;
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJsFull ( "http://api-maps.yandex.ru/2.0/?load=package.full&mode=debug&lang=ru-RU" );
$renderHtmlLinkObj->addJs ( "js/ant/libs/ymap" );
?>
<?php 
	//devLogs::_printr($Model->PrintPropFormAd->printFieldsArray);
?>
<div class="colomns ycolomns">
	<div class="colomn white-bg w-600 y-map">
		<div class="region-auto-search">
			<input type="text" id="region-auto-search-text" name="region-auto-search-text" size="40" value="" placeholder="введите город, район, улицу, метро" class="ui-autocomplete-inputbg-inputs form-i-black" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"/>
			<span id="region-auto-search-btn" class="btn">Поиск</span>
			<div class="clear"></div>
		</div>
		<div id="map" style="width: 600px; height: 400px"></div>
	</div>
	<div class="colomn w-198 y-search-filter">
		<div class="search-filter">
			<div class="h bg-blocks">&nbsp;</div>
			<div class="c">
				<!-- 
					<h1 class="title"><?php echo getLangString("formYMapSearchTitle");?></h1>
					<a rel='nofollow' href="#" onclick="" title="<?php echo getLangString("formYMapSearchFullScreenTitle");?>" class="showFullScreen" id="showFullScreen"><span>&nbsp;</span><?php echo getLangString("formYMapSearchFullScreen");?> </a> <span title="<?php echo getLangString("formYMapSearchClean");?>" class="clean" id=""><span>&nbsp;</span><?php echo getLangString("formYMapSearchClean");?></span>
				-->
				<p id="CountSearchIm"><?php echo getLangString("formYMapSearchCount");?>: <span></span></p>
				<!-- <p class="RealEstateAds"><?php echo getLangString("formYMapSearchRealEstateAds");?></p>-->
				<form enctype="application/x-www-form-urlencoded" name="formYMapSearch" method="get" id="formYMapSearch" action="">
					<input name="region_param" id="region_param"  type="hidden" value=""/>
					<input name="im_catalog_id" type="hidden" id="im_catalog_id" value="4c3ec51d537c0"/>
					<div class="fDiv style-4c3ec331811b6">
						<label class="lName SearchFormAdvasedLabel"><?php echo getLangString("FormSearchNamePrice"); ?>:</label>
						<div class="clear"></div>
						<label class="lMin"><?php echo getLangString("from"); ?></label>
						<input id="im_priceb" class="fMin" type="text" size="20" value="" name="im_priceb"/>
						<label class="lMax"><?php echo getLangString("to"); ?></label>
						<input id="im_pricee" class="fMax" type="text" size="20" value="" name="im_pricee"/>
						<div class="clear"></div>
                    </div>    
                    <div class="SearchFormAdvasedDivFloat style-4c3ec1f67fe1b item-">
						<label class="SearchFormAdvasedLabel">Валюта</label>
						<select class="FormSearchInputText" name="exchange_select">
							<option value="UAH">UAH </option>
							<option value="RUB">RUB </option>
							<option value="USD" selected="selected">USD</option>
							<option value="EUR">EUR</option>
						</select>
					</div>
					<div class="fDiv style-4c3ec331811b6 item-space">
						<label class="lName SearchFormAdvasedLabel"><?php echo getLangString("FormSearchNameSq"); ?>:</label>
						<div class="clear"></div>
						<label class="lMin"><?php echo getLangString("from"); ?></label>
						<input id="im_spaceb" class="fMin" type="text" size="20" value="" name="im_spaceb"/>
						<label class="lMax"><?php echo getLangString("to"); ?></label>
						<input id="im_spacee" class="fMax" type="text" size="20" value="" name="im_spacee"/>
						<div class="clear"></div>
					</div>
                    
                    <div id="accYMapSearchTypeIm">
						<h3 id="accPosImLinkHome"><a class="a-4c3ec51d537c0" href="" rel="nofollow" title="<?php echo getLangString("home_title");?>"><?php echo getLangString("home");?></a></h3>
						<div class="clear"></div>
						<div id="blck-4c3ec51d537c0" class="params">
							<input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_rent" value="1"/>
							<label><?php echo getLangString("ImRent");?></label>
							<div class="clear"></div>
							<input rel="4c3ec51d537c0" type="checkbox" title="" name="im_is_sale" value="1"/>
							<label><?php echo getLangString("ImSale");?></label>
							<div class="clear"></div>
						 	<?php echo $Model->PrintPropFormAd->printFieldsArray["4c4069e4f04ec"]?>
						 	<div class="clear"></div>
						 	<?php echo $Model->PrintPropFormAd->printFieldsArray["4c403061af179"]?>
						 	<div class="clear"></div>
						</div>
						<h3 id="accPosImLinkLand"><a class="a-4c3ec51d537c3" href="" rel="nofollow" title="<?php echo getLangString("land_title");?>"><?php echo getLangString("land");?></a></h3>
						<div class="clear"></div>
						<div id="blck-4c3ec51d537c3" class="params">
							<input rel="4c3ec51d537c3" type="checkbox" title="" name="im_is_sale" value="1"/>
							<label><?php echo getLangString("ImSale");?></label>
							<div class="clear"></div>
						 	<?php echo $Model->PrintPropFormSt->printFieldsArray["4c4057205e1d3"]?>
						 	<div class="clear"></div>
						</div>
						<h3 id="accPosImLinkFlat"><a href="" class="a-4c3ec3ec5e9b5" rel="nofollow" title="<?php echo getLangString("flat_title");?>"><?php echo getLangString("flat");?></a></h3>
						<div class="clear"></div>
						<div id="blck-4c3ec3ec5e9b5" class="params">
							<input rel="4c3ec3ec5e9b5"  type="checkbox" title="" checked="checked" name="im_is_rent" value="1"/>
							<label><?php echo getLangString("ImRent");?></label>
							<div class="clear"></div>
							<input rel="4c3ec3ec5e9b5" type="checkbox" title="" name="im_is_sale" value="1"/>
							<label><?php echo getLangString("ImSale");?></label>
							<div class="clear"></div>
							<?php echo $Model->PrintPropFormSt->printFieldsArray["4c400ed4e5797"]?>
						 	<div class="clear"></div>
						 	<?php echo $Model->PrintPropFormAd->printFieldsArray["4c4016aeca9be"]?>
						 	<div class="clear"></div>
						</div>
						<h3 id="accPosImLinkCommercial"><a href="" class="a-4c3ec3ec5e9b7" rel="nofollow" title="<?php echo getLangString("commercial_title");?>"><?php echo getLangString("commercial");?></a></h3>
						<div class="clear"></div>
						<div id="blck-4c3ec3ec5e9b7" class="params">
							<input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_rent" value="1"/>
							<label><?php echo getLangString("ImRent");?></label>
							<div class="clear"></div>
							<input rel="4c3ec3ec5e9b7" type="checkbox" title="" name="im_is_sale" value="1"/>
							<label><?php echo getLangString("ImSale");?></label>
							<div class="clear"></div>
							<div class=" m-b-5"></div>
						 	<?php echo $Model->PrintPropFormAd->printFieldsArray["4c4050a2cbf80"]?>
						 	<div class="clear"></div>
						 	<?php echo $Model->PrintPropFormAd->printFieldsArray["4c4051d78227a"]?>
						 	<div class="clear"></div>
						</div>
                    </div>
					<div class="dropdown">
						<?php //echo appHtmlClass::partial("/immovables/search/regionalsearchblock", array("Data"=> $Model->dictionaryTreeObj));?>
					</div>
					<div class="clear"></div>
					<a href="" rel='nofollow' title="<?php echo getLangString("btmYMapSearch");?>" class="bg-buttons submit" id="btmYMapSearch"><?php echo getLangString("btmYMapSearch");?></a>
				</form>
				<div class="clear"></div>
			</div>
			<div class="f bg-blocks">&nbsp;</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

