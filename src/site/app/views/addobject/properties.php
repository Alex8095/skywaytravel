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
		<?php echo appHtmlClass::partialAction("addobject", "menu", array("active" => "harakteristiki", "im_id" => $routingObj->getParamItem("im_id")))?>
	</div>
	<div class="colomn w-720 bg-white form-block">
		<form action="/addobject/save" id='userForm' class="zpFormWinXP addobject-form-properties" method="POST">
			<div id='errOutput' class="errOutput"></div>
			<div id='FormAlertIsOk' class="hide"><p><?php echo $arWords['user_add_im_ad_ok'];?></p></div>
			<fieldset>
				<?php echo $PrintPropForm->Form;?>
				<input class='zpForm' value="<?php echo $model->item['im_id'];?>" size="13" name="im_id" id="im_id" type="hidden" >
				<input class='zpForm' value="properties" size="13" name="retention" type="hidden" >
				<br />
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
		if (callbackArgs) {
			var link =  "http://alfabrok.ua/addobject/izobrazheniya/" + callbackArgs.newActionID;
			window.location = link;
		}
	}
</script>	