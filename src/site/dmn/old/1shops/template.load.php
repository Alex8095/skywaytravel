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
	$cl_sel_pages->select_table_query ( "select c.*, ci.ct_photo_id, ci.ct_photo_file_type, ci.is_main, b.ct_name as brand_name, d.dict_name
										 from {$tbl_catalog} c
										 left join shop_info s on c.ct_id = s.ct_id
										 left join {$tbl_catalog} b on s.brand_id = b.ct_id and b.lang_id = {$_COOKIE[lang_id]}
										 left join {$tbl_dictionaries} d on s.city_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]}
										 left join {$tbl_ct_photos} ci on ci.ct_id = c.ct_id and ci.ct_photo_type_id = '4fb2c2c75e2f5' and ci.lang_id = {$_COOKIE[lang_id]}
										 WHERE c.lang_id = {$_COOKIE[lang_id]}  and c.dict_id = '4fb0f701c0e1f' ORDER BY c.pos", "ct_id" );
	# 	Получаем содержимое текущей страницы
	$catalogData = $cl_sel_pages->table;

	if (empty ( $catalogData ))
		die ( "<br><b>По Вашему запросу ничего не найдено!</b>" );

	$CH = new catalogClass( $cl_sel_pages->table, $cl_sel_pages->buld_table, 'ct_name', 'ct_id', 'parent_id');
	$CH -> get_arr_formation('1000000000000');
	require_once ("template.print/print.list.pages.php");
}
?>
    	
        