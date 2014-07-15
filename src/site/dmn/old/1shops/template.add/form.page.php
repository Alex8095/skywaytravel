
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
	
	<fieldset>
		<legend>Мета данные</legend>
		<label class='zpFormLabel'>Веб заголовок</label> 
		<input class='zpForm' value="<?php echo $active_id ['ct_w_title'];?>" size="40" name="ct_w_title" type="text"> <br />
		<label class='zpFormLabel'>Веб ключевые слова</label> 
		<input class='zpForm' value="<?php echo $active_id ['ct_w_keywords'];?>" size="40" name="ct_w_keywords" type="text"> <br />
		<label class='zpFormLabel'>Веб описание</label> 
		<input class='zpForm' value="<?php echo $active_id ['ct_w_description'];?>" size="40" name="ct_w_description" type="text"> <br />
	</fieldset>
	<fieldset>
		<label class='zpFormLabel'>Адрес</label><br />
		<textarea name="ct_text" cols="40" rows="10" class="zpForm"><?php echo $active_id ['ct_text'];?></textarea>
	</fieldset>
	<fieldset>
		<label class='zpFormLabel'>Бренд</label> 
		<select name="brand_id" class="zpFormRequired">
			<?php echo sel_parent_standart ( $cl_sel_pages->table, '', 'ct_id', 'ct_name' ); ?>
		</select>
		<br />
		<label class='zpFormLabel'>Город</label> 
		<select name="city_id" class="zpFormRequired">
			<?php echo sel_parent_standart ( $cityDict, '', 'dict_id', 'dict_name' ); ?>
		</select>
		<br />
		<label class="zpFormLabel">Позиция</label>
		<input value="" name="pos" type="text" class="zpForm zpFormInt" /> 
		<br />	
		<label class="zpFormLabel">Отображать</label> 
		<input value="1" name="hide" type="checkbox" <?php echo $hide; ?> class="zpForm" /> <br>
		<br />
		
		<input class='zpForm' value="4fb0f701c0e1f" size="13" name="dict_id" type="hidden"> 
		<input class='zpForm' value=""	 size="13" name="ct_id" type="hidden"> 
		<input class='zpForm' value="edit_cat" size="13" name="retention" type="hidden"> 
		<input class='zpForm' value="1000000000000" size="13" name="parent_id" type="hidden"> 
	</fieldset>
	
	<input class='zpForm' value="<?php echo $ct_id;?>" size="13" name="ct_id" type="hidden"> 
	<input class='zpForm' value="add_cat" size="13" name="retention" type="hidden">
	<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" /> 
</form>
