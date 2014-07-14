1<?php
global $renderHtmlLinkObj;
global $arWords;
$renderHtmlLinkObj->addJs ( "js/libs/jquery.synctranslit" );
$renderHtmlLinkObj->addJs ( "js/ant/libs/comparing" );
?>
<?php if(!empty($Model->list)): ?>
<?php $Model->buildDictionaries(); ?>
<?php $m = new ModuleSiteIm(array(), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData);?>
<div class="comparing-list colomns">
	<div class="param-list m-r-20">
		<div class="header">
		</div>
		<div class="params">
			<span class="izobrazhenie"><?php echo getLangString("ImFListHeaderImg")?></span>
			<span class="kod"><?php echo getLangString("ImFListHeaderCodeN")?></span>
			<span class="oblast"><?php echo getLangString("FormSearchNameRegion")?></span>
			<span class="r-n-oblasti"><?php echo getLangString("FormSearchNameRRegionN")?></span>
			<span class="gorod-poselok"><?php echo getLangString("FormSearchNameCity")?></span>
			<span class="r-n-goroda"><?php echo getLangString("FormSearchNameACityN")?></span>
			<span class="ulitsa"><?php echo getLangString("FormSearchNameAdress")?></span>
			<a href="" class="tsena-prodazha" title="<?php echo getLangString("fai_fv_im_prace")?>"><?php echo substr(getLangString("fai_fv_im_prace"), 0, strlen(getLangString("fai_fv_im_prace")) - 1)?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="tsena-arenda" title="<?php echo getLangString("fai_fv_im_prace_manth")?>"><?php echo substr(getLangString("fai_fv_im_prace_manth"), 0, strlen(getLangString("fai_fv_im_prace_manth")) - 1)?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="tsena-za-m2" title="<?php echo getLangString("ImFListHeaderM2Sotku")?>"><?php echo getLangString("ImFListHeaderM2Sotku")?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<a href="" class="obschaja-ploschad" title="<?php echo getLangString("FormSearchNameSq")?>"><?php echo getLangString("FormSearchNameSq")?><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
			<div class="properties">
				<?php if($Model->propertiesListGroup):?>
					<?php foreach ($Model->propertiesListGroup as $key => $value):?>
						<a href="" class="<?php echo strtolower(translit($value["im_prop_name"]))?>" title="<?php echo $value["im_prop_name"]?>"><?php echo $value["im_prop_name"]?><span class="to"><?php echo getLangString("comparingParamTo")?></span><span class="from"><?php echo getLangString("comparingParamFrom")?></span></a>
					<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>
	</div>
     <a class="slider-left" href="" rel="nofollow"><</a>
    <a class="slider-rigth" href="" rel="nofollow">></a>
	<div class="item-list">
		<div class="item-list-inner">
			<?php $comparinglist = json_decode($_COOKIE["comparing"]); //devLogs::_printr($Model->listData); ?>
			<ul id="comparing-sort" class="comparison-slider">
				<?php foreach (json_decode($_COOKIE["comparing"]) as $key => $value) :?>
				 	<?php echo appHtmlClass::partial("immovables/comparing/item", array("Model"=> $Model, "m" => $m, "item" => $Model->listData[$value]));?>
	 			<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php else:?>
	<div class="comparing-no-item-list"><?php echo getLangString("comparingNoSelectedItems")?></div>
<?php endif;?>
	<div class="comparing-no-item-list hide"><?php echo getLangString("comparingNoSelectedItems")?></div>
