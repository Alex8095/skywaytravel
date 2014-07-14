<?php 
global $arWords;
global $renderHtmlLinkObj;
$renderHtmlLinkObj->addJs("js/libs/zapatec/utils/zapatec");
$renderHtmlLinkObj->addJs("js/libs/zapatec/lang/ru-utf8");
$renderHtmlLinkObj->addJs("js/libs/zapatec/src/form-" . $_COOKIE['lang_code']);
$renderHtmlLinkObj->addJs("js/ant/libs/zapatec");
?>
<div class="interested-view">
	<a href="" rel="nofollow" title="<?php echo getLangString("Меня заинтересовало")?>" class="interested-btm"><?php echo getLangString("Меня заинтересовало")?></a>
	<form action="/index/immovablesinterested" id='userForm' class="zpFormWinXP interested-form shadow-border" method="post">
		<span class="hide-form">Свернуть</span>
        <div id='FormAlertIsOk'><p><?php echo $arWords['form_mail_ok'];?></p></div>
		<div id='errOutput' class="errOutput"></div>
		<fieldset>
			<label class='zpFormLabel'><?php echo $arWords['form_name_msq'];?></label>
		    <input class='zpFormRequired' value="" size="40" name="name" type="text" />
		    <br />
		    <label class='zpFormLabel'><?php echo $arWords['form_title_msq'];?></label>
		    <select name="titlemsq" class=''>
		    	<?php foreach ($arWords['forminterest']['titlemessage'] as $key => $value):?>
		    		<option value="<?php echo $value;?>"><?php echo $value;?></option>
		    	<?php endforeach; ?>
		    </select>
		    <br/>
		    <label class='zpFormLabel'><?php echo $arWords['form_tel_msq'];?></label>
		    <input value="" size="40" name="tel" type="text" class='zpFormRequired zpFormPhone zpFormMask="\(000\)\ 000\-0000"' />
		    <br/>
		    <label class='zpFormLabel'><?php echo $arWords['form_email_msq'];?></label>
		    <input value="" size="40" name="email" type="text" class='zpFormRequired zpFormEmail' />
		    <br />
		    <label class='zpFormLabel'><?php echo $arWords['form_text_msq'];?></label>
		    <textarea name="textmsq" cols="20" rows="2" class="zpFormRequired"></textarea>
		    <br />
		    <label class='zpFormLabel'><?php echo $arWords['form_not_robot'];?></label>
		    <input value="y" size="40" name="nr" type="checkbox" class='zpFormRequired' />
		    <input value="<?php echo $Model->item ["im_code"];?>" name="im_code" type="hidden" />
		    <input value="<?php echo $Model->getitemlink();?>" name="page_url" type="hidden" />
		    <br />
		</fieldset>
		<input value="<?php echo $arWords['form_send_msq'];?>" name="Submit" onClick="" type="submit" class="button" />
        <div class="clear"></div>
	</form>
</div>
<script type="text/javascript">
Zapatec.Form.setupAll({
	showErrors: false,
	showErrorsOnSubmit: true,
	statusImgPos: null,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: myOnFunctionAdd,
	busyConfig: {
		busyContainer: "userForm"
	}
});
checkIfLoadedFromHDD();
function myOnFunctionAdd() {
	systemalert($('#FormAlertIsOk p').html());
	$('#errOutput').hide();
}
</script>