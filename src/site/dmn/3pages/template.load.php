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

#	объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]" );

if ($_GET ['print'] == 'list_pc') {
	if(!empty($_GET['pc_type']))
		$where = "and c.pc_type = '{$_GET['pc_type']}'";
	$selPageContentData = new mysql_select ( );
	$selPageContentData->select_table_query ( "select c.*, d.dict_name, p.p_w_menu from {$tbl_content} c
												left join {$tbl_sturture} p on c.page_id = p.page_id and p.lang_id = $_COOKIE[lang_id] 
												left join {$tbl_dictionaries} d on d.dict_id = c.pc_type and d.lang_id = {$_COOKIE[lang_id]}
												where c.lang_id = {$_COOKIE[lang_id]} {$where}", "pc_id" );
	
	if (empty ( $selPageContentData->table ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
		require_once "template.print/print.list.pc.php";	
	}
	
if (empty ($_GET ['print'] ))
		die ( "<br><b>no print!</b>" );	
?>

 