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
		<?php echo appHtmlClass::partialAction("addobject", "menu", array("active" => "izobrazheniya", "im_id" => $routingObj->getParamItem("im_id")))?>
	</div>
	<div class="colomn w-720 bg-white form-block">
		<form action="/addobject/izobrazheniya/<?php echo $Model->item["im_id"]?>" id='SendOrder' enctype="multipart/form-data" class="zpFormWinXP addobject-form-images" method="post">
			<div id='errOutput' class="errOutput"></div>
			<div id='FormAlertIsOk' class="hide"><p><?php echo $arWords['user_add_im_st_ok'];?></p></div>
			<fieldset>
				<div style="height:4px"></div>
	            <div id="firstMultipleInside" class="zpFormMultipleInside">
	               	<label class='zpFormLabel'><?php echo $arWords['ImFListHeaderImg'];?></label>
				   	<input value="" onchange="appendNext();" size="26" name="file" type="file" class='zpForm item' />
				</div>
            	<div id="otherMultipleInside"></div>
                <div class="clear"></div>
				<input class='zpForm' value="images" size="13" name="retention" type="hidden"/>
				<input class='zpForm' value="<?php echo $Model->item["im_id"]?>" size="13" name="im_id" id="im_id" type="hidden"/>
			</fieldset>
			<input value="Добавить" name="Submit" onClick="" type="submit" class="button" />
		</form>
	</div>
	<div class="clear"></div>
</div>	
<script type="text/javascript">
Zapatec.Form.setupAll({
	showErrors: false,
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	busyConfig: {
		busyContainer: "SendOrder"
	}
});
checkIfLoadedFromHDD();
function OnSuccessDataForm(callbackArgs){
	$("#errOutput").show();
	$("#FormAlertIsOk").show();
}
var iInput = 1;
function appendNext() {
	$("#otherMultipleInside").append("<div class=\"zpFormMultipleInside\">" + $("#firstMultipleInside").html().replace('name="file"', 'name="file-' + iInput +'"') + "</div>");
	iInput = iInput + 1;
}
$(document).ready(function() {
	$(".multipleButton").hide();
});
</script>	