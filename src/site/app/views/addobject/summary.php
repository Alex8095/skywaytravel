<?php 
global $routingObj;
global $renderHtmlLinkObj;
global $arWords;
$renderHtmlLinkObj->addJs("js/ant/libs/addobject"); 
$renderHtmlLinkObj->addJs("js/libs/zapatec/utils/zapatec");
$renderHtmlLinkObj->addJs("js/libs/zapatec/lang/ru-utf8");
$renderHtmlLinkObj->addJs("js/libs/zapatec/src/form-" . $_COOKIE['lang_code']);
$renderHtmlLinkObj->addJs("js/ant/libs/zapatec");
?>
<div class="colomns">
	<div class="colomn white-bg w-200 content m-r-30">
		<?php echo appHtmlClass::partialAction("addobject", "menu", array("active" => "opisanie", "im_id" => $routingObj->getParamItem("im_id")))?>
	</div>
	<div class="colomn w-720 bg-white form-block">
		<form action="/addobject/save" id='userForm' class="zpFormWinXP" method="POST">
			<div id='errOutput' class="errOutput"></div>
			<div id='FormAlertIsOk' class="hide"><p><?php echo $arWords['user_add_im_st_ok'];?></p></div>
			<fieldset>
				<label class='zpFormLabel'><?php echo $arWords['ImFListHeaderSummary'];?></label>
				<textarea rows="10" class='zpFormRequired' cols="15" name="im_su_text"><?php echo $Model->summary["im_su_text"] ?></textarea>
				<br/>
				<input class='zpForm' value="summary" size="13" name="retention" type="hidden"/>
				<input class='zpForm' value="<?php echo $Model->item["im_id"]?>" size="13" name="im_id" id="im_id" type="hidden"/>
				<input class='zpForm' value="<?php echo $Model->summary["im_su_id"] ?>" size="13" name="im_su_id" id="im_su_id" type="hidden"/>
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
	$("#errOutput").show();
	$("#FormAlertIsOk").show();
}
</script>	