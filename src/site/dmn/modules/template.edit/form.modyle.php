<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EditModIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditModIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Редактирование модуля выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=print_module');
	return;
}
</script>

<form action="template.data.retention.php" id='userForm'
	class="zpFormWinXP" method="POST">
<div id='errOutput' class="errOutput"></div>
<fieldset><label class='zpFormLabel'>Название модуля</label> <input
	class='zpFormRequired' value="<?php
	echo $ActiveIdData ['m_name'];
	?>"
	size="20" name="m_name" type="text"> <br />
<label class='zpFormLabel'>Системное имя модуля</label> <input
	class='zpFormRequired' value="<?php
	echo $ActiveIdData ['m_s_name'];
	?>"
	size="20" name="m_s_name" type="text"> <br />
<label class='zpFormLabel'>Тип модуля</label> <select name="m_type"
	class="zpFormRequired">
	<option value="">--select--</option>
      <?php
						echo sel_parent_id ( $mod_dct, $ActiveIdData ['m_type'], 'dict_id', 'dict_name' );
						?>
    </select> <br />
<label class='zpFormLabel'>Родитель</label> <select name="parent_id"
	class="zpForm">
	<option value="">--select--</option>
      <?php
						echo sel_parent_id ( $ClModCel->table, $ActiveIdData ['parent_id'], 'm_id', 'm_name' );
						?>
    </select> <br />
<input class='zpForm' value="edit_module" size="13" name="retention"
	type="hidden"> <input class='zpForm'
	value="<?php
	echo $ActiveIdData ['m_id'];
	?>" size="13" name="m_id"
	type="hidden"> <br />
</fieldset>
<input value="Сохранить" name="Submit" onClick="" type="submit"
	class="button" /> <input value="Очистить" name="Clear" onClick=""
	type="reset" class="button" /></form>
