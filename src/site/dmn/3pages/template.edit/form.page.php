<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EditConIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditConIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Редактирование контента выполнено успешно.');
	$('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_pc');?>');
	return;
}
</script>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
	<div id='errOutput' class="errOutput"></div>
  	<fieldset>
    	<label class='zpFormLabel'>Подробное описание</label>
    	<br />
   		<textarea name="pc_text" cols="40" rows="10" class="zpForm"><?php echo $active_id ['pc_text'];?></textarea>
    	<input class='zpForm' value="<?php echo $active_id ['pc_id'];?>" size="13" name="pc_id" type="hidden"/>
    	<input class='zpForm' value="edit_page" size="13" name="retention" type="hidden">
    	<br />
  	</fieldset>
  	<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
</form>
