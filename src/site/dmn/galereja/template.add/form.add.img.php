<?php
if (empty ( $_POST ['ct_id'] ))
	$_POST ['ct_id'] = $_GET ['ct_id'];
?>

<script type="text/javascript">
$(document).ready(function(){
	var new_position = <?php
			if (isset ( $_GET ['new_position'] ))
				echo "true;";
			else
				echo "false;";
			?>;

	  if(new_position) {
			var optionsFormAddImage = { 
				target: "#DivRequestImgDone",
				url:'template.data.retention.php',
				success: sucessFormAddImage,
				beforeSubmit: valideFormAddImage
			};	
	  }
	  else {
		  var optionsFormAddImage = { 
				target: "#DivRequestImgDone",
				url:'template.data.retention.php',
				success: sucessFormAddImageList,
				beforeSubmit: valideFormAddImage
			  };					   
	  }
	
	 //  запуск аякса для добавления   
		$('#submitImg').bind("click", function(){
			$('#FormAddImg').ajaxSubmit(optionsFormAddImage); 
			return false;
		});
});
		function sucessFormAddImageList () {
			//$('#errOutputImage').hide();
			$('#errOutputGood').show();
			$('#errOutputGood').text('Изображение добавлено.');
			$('#DivRequestImg').load('template.load.img.php?ct_id=<?php echo $_POST ['ct_id'];
			?>');
		}

		function sucessFormAddImage() {
			$('#errOutputImage').hide();
			$('#errOutputGood').show();
			$('#errOutputGood').text('Изображение добавлено.');
			$('#DivRequest').load('template.load.php?print=list_page');
			return true;
		}
		
		function valideFormAddImage(formData, jqForm, options) {
			var value = $("#images").val();
			var queryString = $.param(formData); 
			if(value == '') {
				$('#errOutputImage').show();
				$('#errOutputImage').text('Прикрепите пожалуйста файл для зарузки.');
				return false;
			}
			else 
				return true;
		}
</script>

<div id='errOutputGood' class="errOutputGood"></div>

<div id='DivRequestImgDone'></div>

<form id="FormAddImg" class="jqueryForm" action="" enctype="multipart/form-data"  method="post">

<div id='errOutputImage' class="errOutput"></div>

<fieldset>
<legend>Добавление изображения</legend>
<label>Изображение</label> 
<input type="file" name="images" id="images"/>
<input type="hidden" name="ct_id" value="<?php echo $_POST ['ct_id']; ?>" /> 
<input type="hidden" name="retention" value="add_img" /> 
<input type="hidden" name="ct_photo_type_id" value="4d05c24dc8477" /> 

<input type="hidden" name="new_position" value="<?php echo ($_GET ['new_position'] ? $_GET ['new_position'] : false);?>" /> 
<input id="submitImg" value="Добавить" class="d-filter-button-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="Submit" onClick="" type="submit"/></fieldset>
</form>

