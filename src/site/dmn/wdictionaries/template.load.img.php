<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
//require_once("../utils/security_mod.php");
require_once ("../../config/class.inc");
require_once ("../../dmn/utils/db_tables.inc");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

if (isset ( $_GET ['dict_id'] ))
	$ImgDictId = $_GET ['dict_id'];
if (isset ( $_POST ['dict_id'] ))
	$ImgDictId = $_POST ['dict_id'];

?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#submitDellImg').bind("click", function(){
		  valideDell(); 
		return false;
	  	});
	});	
	//	функция проверки выбран ли пункт для удаления
	function valideDell()
	{
		$.prompt('Вы действительно хотите удалить позицию?',{ callback: mycallbackform, buttons: { Ok: 'dell', Отмена: false  } });
		return false;
	}
	//функция отменяет либо производит удаление позиции
	function mycallbackform(v,m,f){
		if(v == 'dell')
		{
			//$("#loading").ajaxStart(function(){
  			//$(this).show();});
			$('#DivRequestImg').load('template.dell.item.img.php?dict_id=<?php
			echo $ImgDictId;
			?>');
			//$("#loading").ajaxComplete(function(){
  			//$(this).hide();});
		}
		else
			return false;
	}
	</script>

<div class="eventForm"><a href="#" title="удалить" id="submitDellImg"><img
	src="../utils/images/submit/submitDell.png" width="28" height="24" /></a>
</div>
<div id="d-filter">
	<?php
	echo "<img src=\"../../files/images/dict/{$ImgDictId}.png\">";
	?>
    </div>
