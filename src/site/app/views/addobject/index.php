<?php 
global $routingObj;
global $renderHtmlLinkObj;
global $arWords;
$renderHtmlLinkObj->addJs("js/ant/libs/addobject"); 
$renderHtmlLinkObj->addJs("js/libs/zapatec/utils/zapatec");
$renderHtmlLinkObj->addJs("js/libs/zapatec/lang/ru-utf8");
$renderHtmlLinkObj->addJs("js/libs/zapatec/src/form-" . $_COOKIE['lang_code']);
$renderHtmlLinkObj->addJs("js/ant/libs/zapatec");

$Model->dictionaries->do_dictionaries(17);
$catalogDict = $Model->dictionaries->my_dct;
$Model->dictionaries->do_dictionaries(54);
$spaceTypeDict = $Model->dictionaries->my_dct;
?>
<script type="text/javascript">
	var JSArray = new Array();
	<?php echo BuildJSNextLevelArray($modelSearch->terrotoryParentChildResult, $Model->dictionaries);?>
</script>
<div class="colomns">
	<div class="colomn white-bg w-200 content m-r-30">
		<?php echo appHtmlClass::partialAction("addobject", "menu", array("active" => "index", "im_id" => $routingObj->getParamItem("im_id")))?>
	</div>
	<div class="colomn w-720 bg-white form-block">
		<form action="/addobject/save" id='userForm' class="zpFormWinXP" method="POST">
			<div id='errOutput' class="errOutput"></div>
			<div id='FormAlertIsOk' class="hide"><p><?php echo $arWords['user_add_im_st_ok'];?></p></div>
			<fieldset>
				<label class='zpFormLabel'><?php echo $arWords['form_tel_msq'];?></label>
				<input value="" size="40" name="tel" type="text" class='zpFormRequired zpFormPhone zpFormMask="\(000\)\ 000\-0000"' />
				<br/>
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_title'];?></label>
				<input class='zpForm' value="" size="40" name="im_title" id="im_title" maxlength="255" type="text" onkeypress="javascript: showLimitLenghtInput('im_title', 254);" >
				<span id="span_im_title" style="color:red; margin-left:-130px;"></span>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_catalog_id'];?></label>
				<select name="im_catalog_id" id="im_catalog_id" class="zpFormRequired">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php echo sel_parent_standart($catalogDict, '', 'dict_id', 'dict_name');?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_region_id'];?></label>
				<select name="im_region_id" onchange="javascript:showNextLevel('im_a_region_id', this.value);"  id="im_region_id" class="zpFormRequired">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php echo sel_parent_standart($modelSearch->dRegionList, '4c3eb33182810', 'dict_id', 'dict_name');?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_a_region_id'];?></label>
				<select name="im_a_region_id" onchange="javascript:showNextLevel('im_city_id', this.value);" id="im_a_region_id" class="zpForm">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php //echo sel_parent_standart($im_a_region_add, '', 'dict_id', 'dict_name', TRUE);?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_city_id'];?></label>
				<select name="im_city_id" onchange="javascript:showNextLevel('im_area_id', this.value);" id="im_city_id" class="zpFormRequired">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php echo sel_parent_standart($modelSearch->dCityList, '4c3eb839f144e', 'dict_id', 'dict_name', TRUE);?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_area_id'];?></label>
				<select id="im_area_id" onchange="javascript:showNextLevel('im_array_id', this.value);" name="im_area_id" class="zpForm">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php //echo sel_parent_standart($im_area_id_add, '', 'dict_id', 'dict_name', TRUE);?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_array_id'];?></label>
				<select name="im_array_id"  id="im_array_id" class="zpForm">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php //echo sel_parent_standart($im_array_id_add, '', 'dict_id', 'dict_name');?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_id'];?></label>
				<select name="im_adress_id" id="im_adress_id" class="zpForm">
					<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php echo sel_parent_standart($modelSearch->dAdressList, '', 'dict_id', 'dict_name');?>
				</select>
				<br />  
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_house'];?></label>
				<input class='zpForm' value="" size="40" name="im_adress_house" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_adress_flat'];?></label>
				<input class='zpForm' value="" size="40" name="im_adress_flat" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace'];?></label>
				<input class='zpForm zpFormInt' value="" size="40" name="im_prace" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace_day'];?></label>
				<input class='zpForm zpFormInt' value="" size="40" name="im_prace_day" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_prace_manth'];?></label>
				<input class='zpForm zpFormInt' value="" size="40" name="im_prace_manth" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_space'];?></label>
				<input class='zpFormRequired zpFormFloat' value="" size="40" name="im_space" type="text"/>
				<br />
				<label class='zpFormLabel'><?php echo $arWords['fai_fv_im_space_value_id'];?></label>
				<select name="im_space_value_id" class="zpFormRequired">
				<option value=""><?php echo $arWords['fai_fv_no_selected'] ;?></option>
					<?php echo sel_parent_standart($spaceTypeDict, '', 'dict_id', 'dict_name');?>
				</select>
				<br />  
				<label class="zpFormLabel"><?php echo $arWords['fai_fv_im_is_sale'];?></label>
				<input value="1" name="im_is_sale" type="checkbox" class="zpForm"/>
				<br/>
				<br/>
				<label class="zpFormLabel"><?php echo $arWords['fai_fv_im_is_rent'];?></label>
				<input value="1" name="im_is_rent" type="checkbox" class="zpForm"/>
				<br/>
				<input class='zpForm' value="main" size="13" name="retention" type="hidden"/>
				<input class='zpForm' value="1" size="13" name="im_is_special" type="hidden"/>
				<input class='zpForm' value="<?php echo $Model->item["im_id"]?>" size="13" name="im_id" id="im_id" type="hidden"/>
			</fieldset>
			<input value="Добавить" name="Submit" onClick="" type="submit" class="button" />
		</form>
	</div>
	<div class="clear"></div>
</div>	
<script type="text/javascript">
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: OnSuccessDataForm,
	busyConfig: {
		busyContainer: "userForm"
	}
});
checkIfLoadedFromHDD();
function OnSuccessDataForm(callbackArgs){
	var link =  "http://alfabrok.ua/addobject/harakteristiki/" + callbackArgs.newActionID;
	window.location = link;
}
</script>	