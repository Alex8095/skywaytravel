<?php global $routingObj; ?>
<?php global $arWords; ?>
<?php 
	global $renderHtmlLinkObj; 
	$renderHtmlLinkObj->addJs( "js/ant/libs/immovablessearch");
	$renderHtmlLinkObj->addJs( "js/ant/modules/accounting.min" );
?>
<?php 
	global $formSearchModel;
	$formSearchModel = $Model;
?>
<div class="search-form">
	<div class="h bg-blocks">&nbsp;</div>
	<div class="c">
		<form id="SearchFormIm" name="SearchFormIm" enctype="application/x-www-form-urlencoded" action="/<?php echo $routingObj->getController(); ?>/<?php echo $routingObj->getaction();?>" method="get">
			<div class="colomns f-header">
				<div class="colomn c-rs ">
					<a href="/<?php echo $routingObj->getController(); ?>/rent" class="r <?php echo ($routingObj->getAction() == "rent" ? "active" : "")?>" title="<?php echo getLangString("ImRent")?>"><?php echo getLangString("ImRent")?></a>
					<a href="/<?php echo $routingObj->getController(); ?>/sale" class="s <?php echo ($routingObj->getAction() == "sale" ? "active" : "")?>" title="<?php echo getLangString("ImSale")?>"><?php echo getLangString("ImSale")?></a>
					<div class="clear"></div>
				</div>
				<div class="colomn c-region ">
					<?php echo appHtmlClass::partial("/immovables/search/regionalsearchblock", array("Data"=> $Model->dictionaryTreeObj));?>
				</div>
				<div class="colomn c-kyiv">
                	<a href="" class="bg-buttons" rel="nofollow" title="<?php echo getLangString("Kyiv")?>"><?php echo getLangString("Kyiv")?></a>
                	<div id="kiev-box">
                    	<div class="reginalTree" >
                            <div style="margin: 0px 0px 0px 10px; display: block;" class="rlist rListItem-1 parent-element-4c3eb33182810">
                            </div>
                        </div>
				    </div>
                </div>
				<div class="colomn c-adress form-lii">
					<label for="im_adress_id" class=""><?php echo getLangString('FormSearchNameAdress');?></label>
					<input class="ui-autocomplete-input w-140 bg-inputs form-i-black" placeholder="введите название улиц" value="<?php echo $routingObj->getParamItem('im_adress_id');?>" size="40" name="im_adress_id" id="im_adress_id" type="text" />
				</div>
                <?php if($routingObj->getController() == "flat"):?>
					<?php if(!empty($Model->PrintPropFormSt->metro)):?>
                        <div class="colomn c-metro">
                            <span class="bg-icons">&nbsp;</span>
                            <?php echo $Model->PrintPropFormSt->metro;?>
                            <div class="clear"></div>
                        </div>
                    <?php endif;?>
                <?php endif;?>
				<div class="colomn pre-count-found">
					<span class="text"><?php echo getLangString("Найдено объектов:")?></span>
					<span class="count"></span>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="colomns f-bottom">
			<?php devLogs::_printr($routingObj->getController() == "controller")?>
				<div class="colomn c-sq">
					<span class="pl"><?php echo ($routingObj->getController() == "land" ? "Участок" : getLangString("ImFListHeaderSqPl"))?></span>
					<label for="im_spaceb" class="from"><?php echo getLangString('from');?></label>
					<input type="text" id="im_spaceb" name="im_spaceb" class="w-60 bg-inputs form-i-gray-m-s" value="<?php echo $routingObj->getParamItem('im_spaceb');?>" size="20" />
					<label for="im_spacee" class="to"><?php echo getLangString('to');?></label>
					<input type="text" id="im_spacee" name="im_spacee" class="w-60 bg-inputs form-i-gray-m-s" value="<?php echo $routingObj->getParamItem('im_spacee');?>" size="20" />
					<span class="m2"><?php echo ($routingObj->getController() == "land" ? "соток" : "м.кв.")?></span>
					<div class="clear"></div>
				</div>
				<div class="colomn c-price">
					<span class="price"><?php echo getLangString("price")?></span>
					<?php if( $routingObj->getAction() == 'rent'): ?>
						<label for="im_prace_manthb" class=""><?php echo getLangString('from');?></label>
						<input type="text" id="im_prace_manthb" name="im_prace_manthb" class="w-34 bg-inputs form-i-gray-m-p" value="<?php echo $routingObj->getParamItem('im_prace_manthb');?>" size="20" />
						<label for="im_prace_manthe" class=""><?php echo getLangString('to');?></label>
						<input type="text" id="im_prace_manthe" name="im_prace_manthe" class="w-34 bg-inputs form-i-gray-m-p" value="<?php echo $routingObj->getParamItem('im_prace_manthe');?>" size="20" />
					<?php else:?>
						<label for="im_praceb" class=""><?php echo getLangString('from');?></label>
						<input type="text" id="im_praceb" name="im_praceb" class="w-70 bg-inputs form-i-gray-m-p" value="<?php echo $routingObj->getParamItem('im_praceb');?>" size="20" />
						<label for="im_pracee" class=""><?php echo getLangString('to');?></label>
						<input type="text" id="im_pracee" name="im_pracee" class="w-70 bg-inputs form-i-gray-m-p" value="<?php echo $routingObj->getParamItem('im_pracee');?>" size="20" />
					<?php endif;?>
					<div class="clear"></div>
				</div>	
				<div class="colomn c-exchange-list">
					<?php $exchange_select = ($routingObj->getParamItem('exchange_select') ? $routingObj->getParamItem('exchange_select') : "USD"); ?>
					<span class="UAH <?php echo ($exchange_select == "UAH" ? "active" : "")?>">грн</span>
					<span class="USD <?php echo ($exchange_select == "USD" ? "active" : "")?>">usd</span>
					<div class="clear"></div>
					<span class="RUB <?php echo ($exchange_select == "RUB" ? "active" : "")?>">руб</span>
					<span class="EUR <?php echo ($exchange_select == "EUR" ? "active" : "")?>">eur</span>
					<div class="clear"></div>
					<input type="hidden" id="exchange_select" name="exchange_select" value="<?php echo $exchange_select;?>"/> 
				</div>
				<div class="colomn c-immovable-types">
					<a href="/flat/<?php echo $routingObj->getAction(); ?>" class="<?php echo ($routingObj->getController() == "flat" ? "active" : "")?>" title="<?php echo getLangString("flat_title")?>"><?php echo getLangString("flat")?></a>
					<a href="/commercial/<?php echo $routingObj->getAction(); ?>" class="<?php echo ($routingObj->getController() == "commercial" ? "active" : "")?>" title="<?php echo getLangString("commercial_title")?>"><?php echo getLangString("commercial")?></a>
					<a href="/home/<?php echo $routingObj->getAction(); ?>" class="home <?php echo ($routingObj->getController() == "home" ? "active" : "")?>" title="<?php echo getLangString("home_title")?>"><?php echo getLangString("home")?></a>
					<a href="/land/<?php echo $routingObj->getAction(); ?>" class="<?php echo ($routingObj->getController() == "land" ? "active" : "")?>" title="<?php echo getLangString("land_title")?>"><?php echo getLangString("land")?></a>
					<div class="clear"></div>
				</div>
				<div class="colomn c-sybmit">
					<input type="submit" id="SearchSbtIm" class="bg-buttons" title="<?php echo getLangString('SearchBottom');?>" value="<?php echo getLangString('SearchBottom');?>"/>
				</div>
				<div class="clear"></div>
			</div>	
			<div class="hide">
				<input type="hidden" id="SearchIsAdvasedChecked" name="SearchIsAdvasedChecked" value="<?php echo ($routingObj->getParamItem("SearchIsAdvasedChecked") ? $routingObj->getParamItem("SearchIsAdvasedChecked") : 1);?>"/> 
				<input type="hidden" name="SearchImCode" value="<?php  echo time();?>"/> 
				<input type="hidden" name="im_catalog_id" value="<?php echo $arWords["typeCatImDictOfController"][$routingObj->getController()]?>"/> 
				<input type="hidden" name="im_is_rent" value="<?php echo ($routingObj->getAction() == "rent" ? "true" : "");?>"/> 
				<input type="hidden" name="im_is_sale" value="<?php echo ($routingObj->getAction() == "rent" ? "" : "true");?>"/> 
				<input type="hidden" name= "action" value="ImFormSearch"/>
			</div>
			<div class="colomns hide f-standart"><?php echo $Model->PrintPropFormSt->Form;?></div>
			<div class="colomns hide f-adviced"><?php echo $Model->PrintPropFormAd->Form;?></div>	
		</form>
	</div>
	<div class="f bg-blocks">&nbsp;</div>
	<div class="clear"></div>
</div>




<!--  

<a href="" rel="nofollow" title="<?php echo getLangString("")?>"><?php echo getLangString("")?></a>

<div class="colomn "></div>
				
<div class="clear"></div>
	-->		