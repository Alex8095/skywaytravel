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
	$('#DivRequest').load('template.load.php?print=print_ptm');
	return;
}
var maxPTID = <?php echo $MaxPTId?>;
function addBaceTemplate(pt_id) {
	maxPTID = maxPTID + 1;
	var template = $(".temp-pt").html();
	var pos = parseInt($("#block-id-" + pt_id ).attr("rel"));
	$("#block-id-" + pt_id ).attr("rel", pos + 1);
	template = template.replace(/{new-id}/g, maxPTID);
	parent_id = "";
	template = template.replace(/{parent_id}/g, 'null');
	template = template.replace(/{pos}/g, pos);
	$("#block-id-" + pt_id + " .inner-" + pt_id).append(template);
}
function addNewTemplate(pt_id) {
	maxPTID = maxPTID + 1;
	var template = $(".temp-pt").html();
	var pos = parseInt($("#block-id-" + pt_id ).attr("rel"));
	$("#block-id-" + pt_id ).attr("rel", pos + 1);
	template = template.replace(/{new-id}/g, maxPTID);
	parent_id = pt_id;
	if($(".inner-<?php echo $mainTempId;?>").html() == "") {
		parent_id = "";
	}
	template = template.replace(/{parent_id}/g, parent_id);
	template = template.replace(/{pos}/g, pos)
	$("#block-id-" + pt_id + " .inner-" + pt_id).append(template);
	//alert(pt_id);
}
function dellNewTemplate(pt_id) {
	maxPTID = maxPTID - 1;
	$("#block-id-" + pt_id).remove();
}
</script>

<form action="template.data.retention.php" id='TempModulesForm'
	class="zpFormWinXP" method="POST">
	<div id='errOutput' class="errOutput"></div>
    <div class="ptm" id="block-id-<?php echo $mainTempId;?>" rel="1">
    <fieldset class="">
    	<legend>Добавление шаблона, модуль</legend>
    	<a clas="" href="javascript:addBaceTemplate(<?php echo $mainTempId?>);">Add</a> 
		<div class="inner-<?php echo $mainTempId;?>">
			<?php if(count($ClPTMCel->table) > 0) {
				echo buildPageStructure($ClPTMCel->buld_table, $ClPTMHad->ArrFormation, "NULL");
			}?>
		</div>
	</fieldset>
	<input class='zpForm' value="<?php echo $_POST['page_id'];?>" size="13" name="page_id" type="hidden"> 
	<input class='zpForm' value="edit_ptm" size="13" name="retention" type="hidden"> <br />
</fieldset>
<input value="Сохранить" name="Submit" onClick="" type="submit" class="button" /></form>
</form>
<br/>

<div class="temp-pt" style=" display: none;">
	<div class="ptm" style="" id="block-id-{new-id}" rel="1">
		<fieldset class="">
			<legend>Добавление шаблона, модуль</legend>
			<a href="javascript:addNewTemplate({new-id});">Add</a> <a href="javascript:dellNewTemplate({new-id});">Dell</a>
			<div class="clear"></div>
			<label class='zpFormLabel'>Шаблон</label>
			<select name="temp_id-{new-id}" class="zpForm">
			<?php echo sel_parent_catalog ( $ClTempHad->ArrFormation, $ClTempCel->buld_table, '', 'temp_id', 'temp_name' ); ?>
			</select>
			<br>
			<label class='zpFormLabel'>Модуль</label>
			<select name="mod_id-{new-id}" class="zpForm">
			<?php echo sel_parent_catalog ( $ClModHad->ArrFormation, $ClModCel->buld_table, '', 'm_id', 'm_name' ); ?>
			</select>
			<br>
			<label class='zpFormLabel'>Значение</label>
			<input class='zpForm' value="" size="50" name="pt_val-{new-id}" type="text">
			<br>
			<label class='zpFormLabel'>Позиция</label>
			<input class='zpForm' value="{pos}" size="50" name="pos-{new-id}">
			<br>
			<label class='zpFormLabel'>Позиция в шаблоне</label>
			<input class='zpForm' value="{pos}" size="50" name="pos_temp_id-{new-id}" type="text">
			<br>
			<label class="zpFormLabel">Кешировать</label>
		  	<input value="1" name="pt_is_cache-{new-id}" type="checkbox" class="zpForm"/>
		  	<input class='zpForm' value="{parent_id}" size="50" name="parent_id-{new-id}" type="hidden"/>
		  	<input class='zpForm' value="{new-id}" size="50" name="pt_id-{new-id}" type="hidden"/>
		  	<div class="clear"></div>
		  	<div class="inner-{new-id}"></div>
		</fieldset>	
	</div>
</div>
