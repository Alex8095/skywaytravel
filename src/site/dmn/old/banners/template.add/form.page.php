
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

<fieldset><label class='zpFormLabel'>Название пункта</label> 
<input class='zpFormRequired' value="<?php echo $active_id ['ct_name']; ?>" size="40" name="ct_name" type="text"> <br />
<label class='zpFormLabel'>Price</label>
<input class='zpFormRequired' value="<?php echo $active_id ['ct_title']; ?>" size="40" name="ct_title" type="text"><br />
<label class='zpFormLabel'>Link</label>
<input class='zpFormRequired' value="<?php echo $active_id ['ct_url']; ?>" size="40" name="ct_url" type="text"><br />
<label class="zpFormLabel">Позиция</label>
<input value="<?php echo $active_id ['pos'];?>" name="pos" type="text" class="zpFormRequired zpFormInt" /> 
<br />	
<label class="zpFormLabel">Отображать</label> <input value="1" name="hide" type="checkbox" <?php echo $hide; ?> class="zpForm" /> <br>
<br />
<label class='zpFormLabel'>Type</label> 
<select name="parent_id" class="zpForm">
	<?php echo sel_parent_standart ( $cl_sel_pages->table, '', 'ct_id', 'ct_name' ); ?>
</select>
<br />
<input class='zpForm' value="4e98627036f58" size="13" name="dict_id" type="hidden"> 
</fieldset>

<input class='zpForm' value="<?php echo $ct_id;?>" size="13" name="ct_id" type="hidden"> 
<input class='zpForm' value="add_cat" size="13" name="retention" type="hidden">

<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" /> 
</form>
