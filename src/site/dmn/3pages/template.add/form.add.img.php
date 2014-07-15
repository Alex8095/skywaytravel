<?php
if (empty ( $_POST ['cp_id'] ))
	$_POST ['cp_id'] = $_GET ['cp_id'];
?>

<script type="text/javascript">
$(document).ready(function(){
	 var optionstest = { 
			target: "#outputs",
			beforeSubmit: validesEdit,
			url:'template.date.retention.php'
		  };
		  
	
	var new_position = <?php
			if (isset ( $_GET ['new_position'] ))
				echo "true";
			else
				echo "false";
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
			$('#errOutputImage').show();
			$('#errOutputImage').text('Изображения товара добавлено.');
			$('#DivRequestImg').load('template.load.img.php?cp_id=<?php
			echo $_POST ['cp_id'];
			?>');
		}

		function sucessFormAddImage() {
			$('#errOutputImage').show();
			$('#errOutputImage').text('Изображения товара добавлено.');
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

<div id='DivRequestImgDone'></div>

<form id="FormAddImg" class="jqueryForm" action="" enctype="multipart/form-data"  method="post">

<div id='errOutputImage' class="errOutput"></div>

<fieldset>
<legend>Добавление изображения</legend>
<label>Изображение</label> 

<input type="file" name="images" id="images"/>
<input type="hidden" name="cp_id" value="<?php echo $_POST ['cp_id']; ?>" /> 
<input type="hidden" name="retention" value="add_img" /> 
<input id="submitImg" value="Добавить" class="d-filter-button-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" name="Submit" onClick="" type="submit"/></fieldset>
</form>

