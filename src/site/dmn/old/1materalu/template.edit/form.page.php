
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EditCatIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditCatIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Редактирование выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=list_page');
	return;
}
</script>

<form action="template.data.retention.php" id='userForm'
	class="zpFormWinXP" method="POST">
<div id='errOutputGood' class="errOutputGood"></div>
<div id='errOutput' class="errOutput"></div>

<fieldset><label class='zpFormLabel'>Название материала</label> 
<input class='zpFormRequired' value="<?php echo $active_id ['ct_name']; ?>" size="40" name="ct_name" type="text"> <br />
<label class='zpFormLabel'>Производитель</label>
<input class='zpForm' value="<?php echo $active_id ['ct_adress']; ?>" size="40" name="ct_adress" type="text"><br />
<label class="zpFormLabel">Позиция</label>
<input value="<?php echo $active_id ['pos'];?>" name="pos" type="text" class="zpFormRequired zpFormInt" /> 
<br />	
<label class="zpFormLabel">Отображать</label> <input value="1" name="hide" type="checkbox" <?php echo $hide; ?> class="zpForm" /> <br>
<br />

<input class='zpForm' value="" size="13" name="parent_id" type="hidden"> 
<input class='zpForm' value="4cf62997873ef" size="13" name="dict_id" type="hidden"> 
<input class='zpForm' value="<?php echo $active_id ['ct_id'];?>"	 size="13" name="ct_id" type="hidden"> 
<input class='zpForm' value="edit_cat" size="13" name="retention" type="hidden"> 
</fieldset>

<input value="Сохранить" name="Submit" onClick="" type="submit"
	class="button" /> <input value="Очистить" name="Clear" onClick=""
	type="reset" class="button" /></form>