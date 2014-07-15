<script type="text/javascript">
//	Zapatec
//	функция возврата положительного ответа myOnFunctionEdit
//	<script type='text/javascript' src='../utils/js/js-zapatec/form.js'>
Zapatec.Form.setupAll({
	showErrors: 'afterField',
	showErrorsOnSubmit: true,
	submitErrorFunc: testErrOutput,
	asyncSubmitFunc: EditOrderIsOk,
	busyConfig: {
		busyContainer: "userForm"
	}
	
});
checkIfLoadedFromHDD();
function EditOrderIsOk () {
	var outputDiv = document.getElementById("errOutput");
		
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	$('#errOutput').hide();
	$('#errOutputGood').show();
	$('#errOutputGood').text('Editing the order was successful.');
	$('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_page');?>');
	return;
}
</script>

  

<form action="template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
<div id='errOutputGood' class="errOutputGood"></div>
<div id='errOutput' class="errOutput"></div>
<fieldset>
	<legend>Ordering Information</legend>
	<label class='zpFormLabel'>Order Number</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['order_id'];?>" size="30" disabled="disabled" name="order_id" type="text"> <br />

	<label class='zpFormLabel'>Name of client</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['user_fio'];?>" size="30" disabled="disabled" name="user_fio" type="text"> <br />
	
	<label class='zpFormLabel'>email client</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['user_email'];?>" size="30" disabled="disabled" name="user_email" type="text"> <br />
	
	<label class='zpFormLabel'>telephone customer</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['user_tel'];?>" size="30" disabled="disabled" name="user_tel" type="text"> <br />
	
	<label class='zpFormLabel'>delivery address</label>
    <input class='zpFormRequired' value="<?php echo $OrderData ['user_adress'];?>" size="30" name="user_adress" type="text"> <br />
   
   	<label class='zpFormLabel'>order date</label>
    <input class='zpFormRequired' value="<?php echo $OrderData ['date_add'];?>" size="30" name="date_add" disabled="disabled" type="text"> <br />
    
    <label class='zpFormLabel'>date last status</label>
    <input class='zpFormRequired' value="<?php echo $OrderData ['date_status'];?>" size="30" name="date_add" disabled="disabled" type="text"> <br />
    
    <label class='zpFormLabel'>status order</label> <select name="status_id" class="zpFormRequired">
	  <?php echo sel_parent_id ($status_order_dct, $OrderData ['status_id'], 'dict_id', 'dict_name' );?>
    </select> <br />
    
    <input class='zpFormRequired' value="<?php echo $OrderData ['order_id'];?>" size="30" name="order_id" type="hidden"> <br />
	<input class='zpForm' value="edit_order" size="13" name="retention" type="hidden"> 
</fieldset>

<fieldset>
	<legend>Comment</legend>
	<?php echo $OrderData ['order_comment'];?>
</fieldset>

<fieldset>
	<legend>Ordered goods</legend>
	<?php echo $gReturn;?>
</fieldset>

<fieldset>
	<legend>The amount and number of tickets booking</legend>
	<label class='zpFormLabel'>Number of tickets booking</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['order_g_count'];?>" size="30" disabled="disabled" name="g_count" type="text"> <br />
	
   	<label class='zpFormLabel'>Amount of the order</label> 
	<input class='zpFormRequired' value="<?php echo $OrderData ['order_sum'];?>" size="30" disabled="disabled" name="g_prices" type="text"> <br />
	
</fieldset>

<input value="Save" name="Submit" onClick="" type="submit"/>
</form>
