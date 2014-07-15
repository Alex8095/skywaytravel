
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: AddCatalogIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function AddCatalogIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Добавление выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=list_page');
	return;
}

</script>

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
<div id='errOutputGood' class="errOutputGood"></div>
<div id='errOutput' class="errOutput"></div>

<fieldset>
<legend>Мета данные</legend>
<label class='zpFormLabel'>Веб заголовок</label> 
<input class='zpForm' value="<?php echo $active_id ['ct_w_title'];?>" size="40" name="ct_w_title" type="text"> <br />
<label class='zpFormLabel'>Веб ключевые слова</label> 
<input class='zpForm' value="<?php echo $active_id ['ct_w_keywords'];?>" size="40" name="ct_w_keywords" type="text"> <br />
<label class='zpFormLabel'>Веб описание</label> 
<input class='zpForm' value="<?php echo $active_id ['ct_w_description'];?>" size="40" name="ct_w_description" type="text"> <br />
</fieldset>

<fieldset><label class='zpFormLabel'>Название пункта</label> 
<input class='zpFormRequired' value="<?php echo $active_id ['ct_name']; ?>" size="40" name="ct_name" type="text"> <br />
<label class='zpFormLabel'>Заголовок пункта</label>
<input class='zpFormRequired' value="<?php echo $active_id ['ct_title']; ?>" size="40" name="ct_title" type="text"><br />
<label class="zpFormLabel">Позиция</label>
<input value="<?php echo $active_id ['pos'];?>" name="pos" type="text" class="zpFormRequired zpFormInt" /> 
<br />	
<label class="zpFormLabel">Отображать</label> <input value="1" name="hide" type="checkbox" <?php echo $hide; ?> class="zpForm" /> <br>
<br />
<input class='zpForm' value="" size="13" name="parent_id" type="hidden"> 
<input class='zpForm' value="4d3c421816e39" size="13" name="dict_id" type="hidden"> 
<input class='zpForm' value="<?php echo $active_id ['ct_id'];?>"	 size="13" name="ct_id" type="hidden"> 
<input class='zpForm' value="edit_cat" size="13" name="retention" type="hidden"> 
</fieldset>

<input class='zpForm' value="<?php echo $ct_id;?>" size="13" name="ct_id" type="hidden"> 
<input class='zpForm' value="add_cat" size="13" name="retention" type="hidden">

<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" /> 
</form>