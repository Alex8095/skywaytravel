<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: AddtempIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function AddtempIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Добавление шаблона выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=print_temp');
	return;
}
</script>

<form action="template.data.retention.php" id='userForm'
	class="zpFormWinXP" method="POST">
<div id='errOutput' class="errOutput"></div>
<fieldset><label class='zpFormLabel'>Название шаблона</label> <input
	class='zpFormRequired' value="" size="40" name="temp_name" type="text">
<br />
<label class='zpFormLabel'>Системное имя шаблона</label> <input
	class='zpForm' value="" size="40" name="temp_s_name" type="text"> <br />
<label class='zpFormLabel'>Код для вставки</label> <input class='zpForm'
	value="" size="40" name="temp_s_code" type="text"> <br />
<label class='zpFormLabel'>Тип шаблона</label> <select name="temp_type"
	class="zpFormRequired">
	<option value="">--select--</option>
      <?php
						echo sel_parent_id ( $temp_dct, '', 'dict_id', 'dict_name' );
						?>
    </select> <br />
<label class='zpFormLabel'>Родитель</label> <select name="parent_id"
	class="zpForm">
	<option value="">--select--</option>
      <?php
						echo sel_parent_id ( $ClTempCel->table, '', 'temp_id', 'temp_name' );
						?>
    </select> <br />
<input class='zpForm' value="add_temp" size="13" name="retention"
	type="hidden"> <br />
</fieldset>
<input value="Сохранить" name="Submit" onClick="" type="submit"
	class="button" /> <input value="Очистить" name="Clear" onClick=""
	type="reset" class="button" /></form>
