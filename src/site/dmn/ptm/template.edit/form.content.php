<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: contentErrOutput,
	asyncSubmitFunc: EditContentIsOk,
	busyConfig: {
		busyContainer: "contentForm"
	}
	
});
checkIfLoadedFromHDD();

function contentErrOutput(objErrors){
	var message = objErrors.generalError + '<br />';
	if (objErrors.fieldErrors) {
		for (var ii = 0; ii < objErrors.fieldErrors.length; ii++)
			message += objErrors.fieldErrors[ii].errorMessage + "<br />";
	}
	if(message != "")
		alert(message);
}

function EditContentIsOk () {
	var outputDiv = document.getElementById("errOutputContent");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutputContent').text('');
	$('#errOutputContent').show();
	$("#errOutputContent").append('Редактирование контента выполнено успешно.');
	return;
}
</script>
   
<form action="template.data.retention.php" id='contentForm' class="zpFormWinXP" method="POST">
  <div id='errOutputContent' class="errOutput"></div>
  <fieldset>
    <label class='zpFormLabel'>Контент</label> <br />
    <textarea name="pc_text" cols="40" rows="10" class="zpForm"><?php echo $Content ['pc_text'];?></textarea>   
    <input class='zpForm' value="<?php echo $Content ['pc_type'];?>" size="13" name="pc_type" type="hidden"/>
    <input class='zpForm' value="<?php echo $Content ['page_id'];?>" size="13" name="page_id" type="hidden"/>
    <input class='zpForm' value="<?php echo $Content ['pc_id'];?>" size="13" name="pc_id" type="hidden"/>
    <input class='zpForm' value="edit_content" size="13" name="retention" type="hidden">
    <br />
  </fieldset>
  <input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
