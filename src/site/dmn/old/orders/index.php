<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
require_once (DOC_ROOT . "/dmn/utils/db_tables.inc");

// Подключаем блок авторизации
//require_once("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.inc");
define ( 'SLASH', '../../' );

$title = 'Управление блоком &#8220;Заказы&#8221;';
$helpInfo = "";

// Включаем заголовок страницы
require_once ("../utils/top.php");

try {
	#объявляем класс словаря
	$dictionaries = new dictionariesClass ( );
	#формируем массив имени словарей
	$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
	#формируем массив значений словарей
	$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );
	
	#задаем айди значение справочника меню
	$dictionaries->do_dictionaries ( 20 );
	#перечень значение словаря новостей
	$status_order_dct = $dictionaries->my_dct;
	
	#	родитель, ребенок формирование массива
	$PArrMenu = $dictionaries->BuildArrayParentChild ( $PMenu );
	
	function printFormSelection($arr, $sel = 'NULL', $name_id = 'ld_id', $echo_id = 'ld_name') {
		$str = NULL;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$selecteOption = NULL;
			if ($sel)
				if ($sel == $arr [$i] [$name_id])
					$selecteOption = "selected=\"selected\"";
			$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
		}
		return $str;
	}
?>
<!-- AJAX-ответ от сервера заменит этот текст. -->

<div id="outputWindows">
<div id="output"></div>
</div>

<div id="d-filter">
<h3>Filter page</h3>
<form action="index.php" method="get">
<ul>
	<li><label>Status order</label><br />
	<select class="d-filter-select" name="status_id">
		<option value="">no selected</option>
    	<?php echo printFormSelection ( $status_order_dct, ($_GET ['status_id'] ? $_GET ['status_id'] : "4cff74fe92f10"), 'dict_id', 'dict_name' );?>
     </select></li>
</ul>
	<input type="submit" class="d-filter-button-search ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="Search"></form>
</div>

<form id="myForm" action="" method="post">
	<div class="eventForm"><a href="#" class="ui-state-default ui-corner-all bottom-padding" title="edit/view order" id="submitEdit"><span class="ui-icon ui-icon-pencil"></span>edit/view order</a> <a href="#" class="ui-state-default ui-corner-all bottom-padding" title="delete order" id="submitDell"><span class="ui-icon ui-icon-trash"></span>delete order</a>
    <div class="clean"></div>
</div>

<!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
<div id="DivRequest"></div>
</form>
<script type="text/javascript">
$(document).ready(function(){
//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#DivRequest').load('template.load.php?print=print_order&status_id=<?php echo $_GET['status_id'];?>');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
});

$(document).ready(function(){
//	всплывающее окно
	$("#outputWindows").dialog({
		autoOpen: false,
		minWidth: 800,
		modal: true
	});
		
//  запуск аякса для редактирования
		  var optionsEdit = { 
			target: "#output",
			beforeSubmit: valideEdit,
			success: showWindowsEdit,
			url:'template.edit.order.php'
		  	};
		$('#submitEdit').bind("click", function(){
			$('#myForm').ajaxSubmit(optionsEdit); 
			return false;
			});

//  запуск аякса для удаления
		var optionsDell = { 
			target: "#output",
			beforeSubmit: valideDell,
			//url:'template.event.hadler.php'
			};
		$('#submitDell').bind("click", function(){
		  	$('#myForm').ajaxSubmit(optionsDell); 
			return false;
	  		});
		$('#submitDellOk').bind("click", function(){
		  	$('#myForm').ajaxSubmit(optionsDellOk); 
			return false;
		  	});
		$('#submitDellOff').bind("click", function(){
			$('#divSubmitDell').hide();	 
			return false;
		  	});
});

function showWindowsEdit() {
	$('#outputWindows').dialog({ title: 'Редактирование заказа' });
	$('#outputWindows').dialog('open');
	return true;
}
	
//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString.search("order_id") != 0) 
	{	$.prompt('Не выбран пункт для редактирования!');
		return false;
	}
	return true; 
}
//	функция проверки выбран ли пункт для удаления
function valideDell(formData, jqForm, options)
{
	var queryString = $.param(formData); 
	if(queryString.search("order_id") != 0) 
	{
		$.prompt('Не выбран пункт для удаления!');
		return false;
	}
	else
	{
		$.prompt('Вы действительно хотите удалить позицию?',{ callback: mycallbackform, buttons: { Ok: 'dell', Отмена: false  } });
		return false;
	}
}
//функция отменяет либо производит удаление позиции
function mycallbackform(v,m,f){
	if(v == 'dell')
	{
		//  опции для удаления пункта
		  var optionsDellOk = { 
			target: "#output",
			success: showDellResponse,
			url:'template.dell.module.php'
		  };
		  
		$('#myForm').ajaxSubmit(optionsDellOk); 
		//	подгрузка аяксом списка страниц,(таблица)
		return true;
	}
	else
		return false;
}

function showDellResponse() {
	$('#DivRequest').load('template.load.php?print=print_order&status_id=<?php echo $_GET['status_id'];?>');
	$.prompt('Заказ удален!');
	return;
}
</script>
<?php
} catch ( ExceptionMySQL $exc ) {
	require "../utils/exception/exception_mysql.php";
}

// Включаем завершение страницы
require_once ("../utils/bottom.php");
?>
