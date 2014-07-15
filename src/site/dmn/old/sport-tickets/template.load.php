<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
// Устанавливаем соединение с базой данных
require_once ("../../config/config.php");
// Подключаем SoftTime FrameWork
require_once ("../../config/class.inc");
require_once (DOC_ROOT. "/dmn/utils/cms.images.php");
require_once 'template/template.inc';
	
//объявляем класс словаря
$dictionaries = new dictionariesClass ( );
//формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
//формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$lang_id} ORDER BY dict_name" );
if ($_GET ['print'] == 'list_page') {
	# 	Получаем содержимое текущей страницы
	$cl_sel_pages = new mysql_select ( $tbl_catalog );
	$cl_sel_pages->select_table_query ( "select c.*, ci.ct_photo_id, ci.ct_photo_file_type, ci.is_main from {$tbl_catalog} c
										 left join {$tbl_ct_photos} ci on ci.ct_id = c.ct_id and ci.is_main = 1 and ci.lang_id = {$_COOKIE[lang_id]}
										 WHERE c.lang_id = {$_COOKIE[lang_id]}  and c.dict_id = '4d3c421816e39' ORDER BY c.pos" );
	# 	Получаем содержимое текущей страницы
	$catalogData = $cl_sel_pages->table;
	
	if (empty ( $catalogData ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );
	
	require_once ("template.print/print.list.pages.php");
}
?>
    	
        