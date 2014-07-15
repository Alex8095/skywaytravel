
<script type="text/javascript">
	$(document).ready(function(){
		$('#DivRequestBSList').load('template.load.php?print=list_bs&ct_id=<?php echo $_POST ['ct_id']?>');

		$('#showAddBs').bind("click", function(){
			$('#FormAddBs').show();
		});

/***************************************************/
		var optionsAddBs = { 
					target: "#DivRequestBs",
					url:'template.data.retention.php',
					beforeSubmit: showRequest,
					success: afterAjax
				  };					   
		//  запуск аякса для добавления   
		$('#submitBs').bind("click", function(){
			  $('#FormAddBs').ajaxSubmit(optionsAddBs); 
				return false;
		});
		function afterAjax(responseText, statusText)
		{
			$('#errOutputBs').show();
			$('#errOutputBs').text('Магазин добавлен!');
			
			$('#DivRequestBSList').load('template.load.php?print=list_bs&ct_id=<?php echo $_POST ['ct_id']?>');
			return true;
		}
		function showRequest(formData, jqForm, options) { 
			var value = $("#shop_id").val();
			var queryString = $.param(formData); 
			if(value == '') {
				$('#errOutputBs').show();
				$('#errOutputBs').text('Выберите пожалуйста магазин!');
				return false; 
			}
			else return true; 
		} 
/***************************************************/

/***************************************************/		
		//  опции для назначения главным изобр. 
			var optionsIndexPhoto = { 
				target: "#DivRequestBs",
				beforeSubmit: valideIndexPhoto,
				url:'template.data.retention.php',
				success: afterIndex
			};
		//  запуск аякса для редактирования
			$('#submitIndexPhoto').bind("click", function(){
				$('#FormListBs').ajaxSubmit(optionsIndexPhoto); 
				return false;
			});
/***************************************************/						  

/***************************************************/				
		//  опции для удаления пункта
			var optionsDellBs = { 
				target: "#DivRequestBs",
				beforeSubmit: valideDellPhoto
				//url:'template.event.hadler.php'
			};
		//  запуск аякса для удаления
			$('#submitDellBs').bind("click", function(){
			  	$('#FormListBs').ajaxSubmit(optionsDellBs); 
				return false;
		  	});
				$('#submitDellOk').bind("click", function(){
				  	$('#FormListBs').ajaxSubmit(optionsDellBsOk); 
					return false;
			  	});
				$('#submitDellOff').bind("click", function(){
				  	$('#divSubmitDell').hide();	 
					return false;
			  	});
	});

/************/	
	//	функция проверки выбран ли пункт для удаления
	function valideDellPhoto(formData, jqForm, options)
	{
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('bs_id');
		if(ImPropId == -1) {
			$('#errOutputBs').show();
			$('#errOutputBs').text('Не выбран магазин для удаления!');
			return false;
		} 
		else {
			$.prompt('Вы действительно хотите удалить магазин?',{ callback: mycallbackformPhoto, buttons: { Ok: 'dell', Отмена: false  } });
			return false;
		}
	}
	//функция отменяет либо производит удаление позиции
	function mycallbackformPhoto(v,m,f){
		if(v == 'dell')
		{
			var optionsDellBsOk = { 
				target: "#DivRequestBs",
				success: afterDellImage,
				url:'template.dell.item.bs.php'
			};
			$('#FormListBs').ajaxSubmit(optionsDellBsOk); 
			return true;
		} else return false;
	}

/************/

	function afterDellImage()
	{
		$('#DivRequestBSList').load('template.load.php?print=list_bs&ct_id=<?php echo $_POST ['ct_id']?>');
		$('#errOutputBs').show();
		$('#errOutputBs').text('Магазин удален!');
		return true;
	}
	
	
	function afterIndex()
	{
		$('#DivRequestBSList').load('template.load.php?print=list_bs&ct_id=<?php echo $_POST ['ct_id']?>');
		$.prompt('Изминение сохранено.');
		return true;
	}
	
</script>

<div id="DivRequestBs"></div>
<div class="eventForm no-fixed" style="margin-bottom:10px;"> 
	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить магазин" id="showAddBs"><span class="ui-icon ui-icon-plus"></span>добавить магазин</a> 
	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить магазин" id="submitDellBs"><span class="ui-icon ui-icon-trash"></span>удалить магазин</a>
    <div class="clean"></div>
</div>

<div id='errOutputBs' class="errOutput"></div>

<form id="FormAddBs" action="" method="post" class="jqueryForm" style="display: none">
<fieldset>
<legend>Добавление магазина</legend>
<label>Магазин (Название/Адрес)</label>
<select name="shop_id">
	<?php echo printListShop ( $ShopsData->table ); ?>
</select>
<br />  
<br />  
<input type="hidden" name="ct_id" value="<?php echo $_POST ['ct_id']; ?>" /> 
	<input type="hidden" name="retention" value="edit_brand_shops" />
    <input id="submitBs" value="Добавить" name="Submit" onClick=""  class="d-filter-button-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="submit" /></fieldset>
</form>

<form id="FormListBs" action="" method="post">
<div id="DivRequestBSList"></div>
<input type="hidden" name="ct_id" value="<?php echo $_POST ['cp_id']; ?>" /> 

</form>


