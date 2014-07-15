
<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: myOnFunctionAddImg,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
</script>


<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
<div id='errOutputGood' class="errOutputGood"></div>
<div id='errOutput' class="errOutput"></div>

<fieldset><label class='zpFormLabel'>Название материала</label> 
<input class='zpFormRequired' value="" size="40" name="ct_name" type="text"> <br />
<label class='zpFormLabel'>Производитель</label> 
<input class='zpForm' value="" size="40" name="ct_adress" type="text"> <br />
<label class="zpFormLabel">Позиция</label>
<input value="<?php echo $cl_sel_pages->table[0]['pos'] + 1;?>" name="pos" type="text" class="zpFormRequired zpFormInt" /> <br>
<label class="zpFormLabel">Отображать</label> <input value="1" name="hide" type="checkbox" checked class="zpForm" /> <br>
<br />
<input class='zpForm' value="" size="13" name="parent_id" type="hidden"> 
<input class='zpForm' value="4cf62997873ef" size="13" name="dict_id" type="hidden"> 
<input class='zpForm' value="<?php echo $ct_id;?>" size="13" name="ct_id" type="hidden"> 
<input class='zpForm' value="add_cat" size="13" name="retention" type="hidden">
</fieldset>

<input value="Добавить" name="Submit" onClick="" type="submit" class="button" /> 
</form>