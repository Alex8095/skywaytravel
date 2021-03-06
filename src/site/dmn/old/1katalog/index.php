<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
require_once (DOC_ROOT . "/dmn/utils/db_tables.inc");

// Подключаем блок авторизации
require_once ("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.inc");

$title = 'Управление блоком &laquo;Каталог&raquo;';

// Включаем заголовок страницы
require_once ("../utils/top.php");

try {
	
	?>
<form id="myForm" action="" method="post">

<div class="eventForm">

<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="добавить пункт &laquo;Каталогa&raquo;" id="submitAdd"><span class="ui-icon ui-icon-plus"></span>добавить пункт</a> 
<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="редактировать пункт &laquo;Каталогa&raquo;" id="submitEdit"><span class="ui-icon ui-icon-pencil"></span>редактировать пункт</a> 
<a href="#" class="ui-state-default ui-corner-all bottom-padding" title="удалить пункт &laquo;Каталогa&raquo;" id="submitDell"><span class="ui-icon ui-icon-trash"></span>удалить пункт</a></div>
<!--	Подгрузка списка позиций таблицы с помощью аякс запроса-->
<div id="DivRequest"></div>
<!-- AJAX-ответ от сервера заменит этот текст. -->
<div id="output"></div>
</form>


<script type="text/javascript">
$(document).ready(function(){
	//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#DivRequest').load('template.load.php?print=list_page');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
	//	подгрузка дополнительных пунктов подменю в гланое меню	 
	//	$("#service").append('<a href="index.packet.php">Модули сайтов</a>');
	// ---- Форма -----
	//	опции для добавления нового пункта
		  var optionsAdd = { 
			target: "#output",
			url:'template.add.item.php'
		  };
	//  опции для редактирования пункта
		  var optionsEdit = { 
			target: "#output",
			beforeSubmit: valideEdit,
			url:'template.edit.item.php'
		  };
	//  опции для удаления пункта
		  var optionsDell = { 
			target: "#output",
			beforeSubmit: valideDell
			//url:'template.event.hadler.php'
		  };
		  // $('#myForm').ajaxSubmit(optionsAdd); 
	//  запуск аякса для добавления   
		$('#submitAdd').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsAdd); 
		return false;
		});
	//  запуск аякса для редактирования
		$('#submitEdit').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsEdit); 
		return false;
		});
	//  запуск аякса для удаления
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
	// ---- Форма -----
});

//	функция проверки выбран ли пункт для редактирования
function valideEdit(formData, jqForm, options)
{
	var queryString = $.param(formData);
	if(queryString.search("ct_id") == 0) {
		return true;
	}
	else {
		$.prompt('Не выбран пункт для редактирования!');
		return false; 
	}
}
//	функция проверки выбран ли пункт для удаления
function valideDell(formData, jqForm, options)
{
	var queryString = $.param(formData);
	if(queryString.search("ct_id") == 0) {
		
		$.prompt('Вы действительно хотите удалить позицию?',{ callback: mycallbackform, buttons: { Ok: 'dell', Отмена: false  } });
		return false;
	}
	else	{
		$.prompt('Не выбран пункт для удаления!');
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
			//success: showResponse,
			url:'template.dell.item.php'
		  };
		  
		$('#myForm').ajaxSubmit(optionsDellOk); 
		//	подгрузка аяксом списка страниц,(таблица)
		$('#DivRequest').load('template.load.php?print=list_page');
		return true;
	}
	else
		return false;
}
</script>

<?php } catch ( ExceptionMySQL $exc ) {
	require ("../utils/exception_mysql.php");
}

// Включаем завершение страницы
require_once ("../utils/bottom.php");
