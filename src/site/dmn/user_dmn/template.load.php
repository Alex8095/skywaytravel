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
require_once (DOC_ROOT . "/dmn/utils/cms.images.php");

define ( 'SLASH', '../../' );

# 	Получаем содержимое текущей страницы
$cl_sel_pages = new mysql_select ( "system_accounts", "", "ORDER BY id_account" );
$cl_sel_pages->select_table ( "news_id" );
# 	Получаем содержимое текущей страницы
$page = $cl_sel_pages->table;

#объявляем класс словаря
$dictionaries = new dictionariesClass ();
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE["lang_id"]}" );

if ($_GET ['print'] == 'list_page')
	require_once ("template.print/print.list.pages.php");

?>
    	
        