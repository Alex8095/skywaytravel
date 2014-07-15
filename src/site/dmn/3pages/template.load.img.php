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
require_once ("template/template.inc");

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries, "ORDER BY ld_name ASC" );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}", "ORDER BY dict_name ASC" );

if ($_GET ['cp_id']) {
	#выборка логотипов пользователя
	$cl_photo_class = new mysql_select ( $tbl_cp, "WHERE cp_id = '{$_GET['cp_id']}'", "" );
	$cl_photo_class->select_table ( "cp_photo_id" );
	
	if ($cl_photo_class->table) {
		#подстановка позиций в шаблон вывода логотипов 		
		$cl_Module = new ModuleSite ( $ModuleTemplate, array (), $dictionaries );
		$RetPhoto = $cl_Module->Handler_Template_Html ( 'photo_list_block', $cl_photo_class->table );
	} else {
		$RetPhoto = "<div class=\"errOutputShow\">Нет добавленных изображений!</div>";
	}
	echo $RetPhoto;
}
else die("no catalog position");
?>
 