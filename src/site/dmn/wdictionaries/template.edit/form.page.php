
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: myOnFunctionEdit,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditDictIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Редактирование справочника выполнено успешно.');
	$('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_page');?>');
	return;
}
</script>


<form action="template.data.retention.php" id='userForm'
	class="zpFormWinXP" method="POST">
<div id='errOutput' class="errOutput"></div>

<fieldset><label class='zpFormLabel'>Kод словаря</label> <input
	class='zpForm' value="<?php
	echo $active_id ['ld_code'];
	?>" size="40"
	name="ld_code" type="text"> <br />
<label class='zpFormLabel'>Имя словаря</label> <input
	class='zpFormRequired' value="<?php
	echo $active_id ['ld_name'];
	?>"
	size="40" name="ld_name" type="text"> <br />
<label class='zpFormLabel'>Краткое описание</label> <input
	class='zpForm' value="<?php
	echo $active_id ['ld_descr'];
	?>" size="40"
	name="ld_descr" type="text"> <br />
<label class='zpFormLabel'>Родительский ID</label> <select
	name="ld_parent" class="zpForm">
	<option value="">--select--</option>
									<?php
									echo sel_parent_id ( $cl_sel_pages->table, $active_id ['ld_parent'], 'ld_id', 'ld_name' );
									?>
								</select> <br />
<input class='zpForm' value="edit_page" size="13" name="retention"
	type="hidden"> <input class='zpForm'
	value="<?php
	echo $active_id ['ld_id'];
	?>" size="13" name="ld_id"
	type="hidden"> <br />
</fieldset>

<input value="Редактировать" name="Submit" onClick="" type="submit"
	class="button" /> <input value="Очистить" name="Clear" onClick=""
	type="reset" class="button" /></form>