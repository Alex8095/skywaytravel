<?php global $routingObj; ?>
<?php global $exchangeRateObj; ?>
<?php global $arWords; ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<?php if($Model->list):?>
	<div class="colomns">
		<div class="colomn w-782">
			<div class="im-search-bycode-list">
				<div class="h bg-blocks">&nbsp;</div>
				<div class="inner c">
					<?php foreach ($Model->list as $key => $value){
							$ModelPartial = $Model;
							$ModelPartial ->list = array($value);
							if($value["im_is_rent"])
								echo appHtmlClass::partial(sprintf("%s/rentlist", $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]), array ("Model" => $ModelPartial));
							if($value["im_is_sale"])
								echo appHtmlClass::partial(sprintf("%s/salelist", $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]]), array ("Model" => $ModelPartial));
							}
					?>	
				</div>
				<div class="f bg-blocks">&nbsp;</div>
	 		</div>
		</div>
		<div class="colomn w-198">
			<div class="SearchImmovablesCodes hide">
				<?php foreach ($Model->list as $key => $value):?>
					<span><?php echo $value["im_code"];?><a href="/immovables/search?id=<?php echo str_replace($value["im_code"], "", strtoupper($routingObj->getParamItem("id")));?>&action=s_code">X</a></span>
				<?php endforeach;?>
			</div>
		</div>
		<div class="clear"></div>
	</div>	
	<div class="clear"></div>										
<?php else:?>
	<?php if($param["canRedirect"] == "true"):?>
		<?php echo appHtmlClass::partial("immovables/immovablesnoposition"); ?>
	<?php endif;?>
<?php endif;?>