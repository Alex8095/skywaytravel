
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EditDictPosIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditDictPosIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Редактирование значение справочника выполнено успешно.');
	$('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=position_portfolio');?>');
	return;
}
</script>


<form action="template.data.retention.php" id='userForm'
	class="zpFormWinXP" method="POST">
<div id='errOutput' class="errOutput"></div>

<fieldset><label class='zpFormLabel'>Код позиции</label> <input
	class='zpForm' value="<?php
	echo $active_id ['dict_code'];
	?>" size="40"
	name="dict_code" type="text"> <br />
<label class='zpFormLabel'>Значение позиции</label> <input
	class='zpFormRequired' value="<?php
	echo $active_id ['dict_name'];
	?>"
	size="40" name="dict_name" type="text"> <br />
<label class='zpFormLabel'>Словарь</label> <select name="ld_id"
	class="zpFormRequired">
	<option value="">--select--</option>
									<?php
									echo sel_parent_id ( $cl_sel_pages->table, $active_id ['ld_id'], 'ld_id', 'ld_name' );
									?>
								</select> <br />

<label class='zpFormLabel'>Родитель</label> <select name="parent_id"
	class="zpForm">
	<option value="">--select--</option>
									<?php
									echo sel_parent_id ( $cl_sel_position->table, $active_id ['parent_id'], 'dict_id', 'dict_name' );
									?>
								</select> <br />
	<label class='zpFormLabel'>Позиция</label>
 	<input class='zpForm' value="<?php echo $active_id ['pos']; ?>" size="40" name="pos" type="text"> <br />
 	
<input class='zpForm' value="<?php
echo $active_id ['dict_id'];
?>"
	size="13" name="dict_id" type="hidden"> <input class='zpForm'
	value="edit_position_page" size="13" name="retention" type="hidden"> <br />
</fieldset>

<input value="Редактировать" name="Submit" onClick="" type="submit"
	class="button" /> <input value="Очистить" name="Clear" onClick=""
	type="reset" class="button" /></form>