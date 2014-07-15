<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EdittempModIsOk,
	busyConfig: {
		busyContainer: "TempModulesForm"
	}
	
});
checkIfLoadedFromHDD();
function EdittempModIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Редактирование шаблона выполнено успешно.');
	$('#DivRequest').load('template.load.php?print=print_temp');
	return;
}
</script>

<form action="template.data.retention.php" id='TempModulesForm'
	class="zpFormWinXP" method="POST">
<div id='errOutput' class="errOutput"></div>
    <?php
				echo PrintTempMod ( $ClTempModCel->table );
				?>
    
    <fieldset class="zpFormMultipleInside"><label class='zpFormLabel'>Возможный
модуль</label> <select name="child-m_id" class="zpFormRequired">
        	<?php
									echo sel_parent_id ( $mod_dct, '', 'm_id', 'm_name' );
									?>
      	</select></fieldset>
<input class='zpForm' value="<?php
echo $ActiveIdData ['temp_id'];
?>"
	size="13" name="temp_id" type="hidden"> <input class='zpForm'
	value="edit_temp_modules" size="13" name="retention" type="hidden"> <br />
</fieldset>
<input value="Сохранить" name="Submit" onClick="" type="submit"
	class="button" /></form>
