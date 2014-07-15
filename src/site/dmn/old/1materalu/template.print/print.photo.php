
<script type="text/javascript">
	$(document).ready(function(){
		$('#DivRequestPhotoList').load('template.load.img.php?ct_id=<?php
		echo $_POST ['ct_id']?>');

		$('#showAddImg').bind("click", function(){
			$('#FormAddImgIm').show();
		});

/***************************************************/
		var optionsAddImg = { 
					target: "#DivRequestImg",
					url:'template.data.retention.php',
					beforeSubmit: showRequest,
					success: afterAjax
				  };					   
		//  запуск аякса для добавления   
		$('#submitImg').bind("click", function(){
			  $('#FormAddImgIm').ajaxSubmit(optionsAddImg); 
				return false;
		});
		function afterAjax(responseText, statusText)
		{
			$('#errOutputImage').show();
			$('#errOutputImage').text('Изображения добавлено.');
			
			$('#DivRequestPhotoList').load('template.load.img.php?ct_id=<?php echo $_POST ['ct_id']?>');
			return true;
		}
		function showRequest(formData, jqForm, options) { 
			var value = $("#images").val();
			var queryString = $.param(formData); 
			if(value == '') {
				$('#errOutputImage').show();
				$('#errOutputImage').text('Прикрепите пожалуйста файл для зарузки.');
				return false; 
			}
			else return true; 
		} 
/***************************************************/

/***************************************************/		
		//  опции для назначения главным изобр. 
			var optionsIndexPhoto = { 
				target: "#DivRequestImg",
				beforeSubmit: valideIndexPhoto,
				url:'template.data.retention.php',
				success: afterIndex
			};
		//  запуск аякса для редактирования
			$('#submitIndexPhoto').bind("click", function(){
				$('#FormListImg').ajaxSubmit(optionsIndexPhoto); 
				return false;
			});
/***************************************************/						  

/***************************************************/				
		//  опции для удаления пункта
			var optionsDellPhoto = { 
				target: "#DivRequestImg",
				beforeSubmit: valideDellPhoto
				//url:'template.event.hadler.php'
			};
		//  запуск аякса для удаления
			$('#submitDellPhoto').bind("click", function(){
			  	$('#FormListImg').ajaxSubmit(optionsDellPhoto); 
				return false;
		  	});
				$('#submitDellOk').bind("click", function(){
				  	$('#FormListImg').ajaxSubmit(optionsDellPhotoOk); 
					return false;
			  	});
				$('#submitDellOff').bind("click", function(){
				  	$('#divSubmitDell').hide();	 
					return false;
			  	});
	});

/************/		
	//	функция проверки выбран ли пункт для назначения главным изобр. 
	function valideIndexPhoto(formData, jqForm, options)
	{
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('ct_photo_id');
		if(ImPropId == -1) {
			$('#errOutputImage').show();
			$('#errOutputImage').text('Не выбрано изображение для назначения главным!');
			return false;
		}
		else return true; 
	}

/************/	
	//	функция проверки выбран ли пункт для удаления
	function valideDellPhoto(formData, jqForm, options)
	{
		var queryString = $.param(formData); 
		var ImPropId = queryString.search('ct_photo_id');
		if(ImPropId == -1) {
			$('#errOutputImage').show();
			$('#errOutputImage').text('Не выбрано изображение для удаления!');
			return false;
		} 
		else {
			$.prompt('Вы действительно хотите удалить изображеие?',{ callback: mycallbackformPhoto, buttons: { Ok: 'dell', Отмена: false  } });
			return false;
		}
	}
	//функция отменяет либо производит удаление позиции
	function mycallbackformPhoto(v,m,f){
		if(v == 'dell')
		{
			var optionsDellPhotoOk = { 
				target: "#DivRequestImg",
				success: afterDellImage,
				url:'template.dell.item.img.php'
			};
			$('#FormListImg').ajaxSubmit(optionsDellPhotoOk); 
			return true;
		} else return false;
	}

/************/

	function afterDellImage()
	{
		$('#DivRequestPhotoList').load('template.load.img.php?ct_id=<?php
		echo $_POST ['ct_id']?>');
		$('#errOutputImage').show();
		$('#errOutputImage').text('Изображение удалено!');
		return true;
	}
	
	
	function afterIndex()
	{
		$('#DivRequestPhotoList').load('template.load.img.php?ct_id=<?php
		echo $_POST ['ct_id']?>');
		$.prompt('Изминение сохранено.');
		return true;
	}
	
</script>

<div id="DivRequestImg"></div>
<div class="eventForm" style="margin-bottom:10px;">
	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить изображение" id="showAddImg"><span class="ui-icon ui-icon-plus"></span>добавить изображение</a> 
	<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить изображение" id="submitDellPhoto"><span class="ui-icon ui-icon-trash"></span>удалить изображение</a>
    <div class="clean"></div>
</div>

<div id='errOutputImage' class="errOutput"></div>

<form id="FormAddImgIm" action="" method="post" class="jqueryForm" style="display: none">
<fieldset>
<legend>Добавление изображения</legend>
<label>Изображение</label> <input type="file" name="images" id="images"/>
<br />
<label>Позиция</label> <input type="text" name="ct_photo_order" id="ct_photo_order"/>
<br />
<label>Уменьшать изображение</label> <input value="1" name="is_small"  id="is_small" type="checkbox" checked="checked" class="zpForm" /> 
<br />
<input type="hidden" name="ct_photo_type_id" value="4d05c24dc8477" /> 
<input type="hidden" name="ct_id" value="<?php echo $_POST ['ct_id']; ?>" /> 
	<input type="hidden" name="retention" value="add_img_gal" />
    <input id="submitImg" value="Добавить" name="Submit" onClick=""  class="d-filter-button-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="submit" /></fieldset>
</form>

<form id="FormListImg" action="" method="post">
<div id="DivRequestPhotoList"></div>
<input type="hidden" name="ct_id" value="<?php echo $_POST ['cp_id']; ?>" /> 
<input type="hidden" name="retention" value="ImIndexPhoto" />
</form>


