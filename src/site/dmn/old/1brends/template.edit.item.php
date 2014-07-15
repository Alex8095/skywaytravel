<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
<?php
require_once '../utils/template.ajax/js.css.php';
require_once 'template/template.inc';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
#задаем айди значение справочника меню
$dictionaries->do_dictionaries ( 19 );
#перечень значение словаря новостей
$cat_dict = $dictionaries->my_dct;

#задаем айди значение справочника меню
$dictionaries->do_dictionaries ( 21 );
#перечень значение словаря новостей
$ct_photo_dct = $dictionaries->my_dct;

$cl_sel_pages = new mysql_select ( $tbl_catalog );
$cl_sel_pages->select_table_query ( "select * from {$tbl_catalog} c
									 WHERE c.lang_id = {$_COOKIE[lang_id]} and dict_id IN ('4d3c421816e39', '')" );
$pageCatalogParent = $cl_sel_pages->table;

$cl_sel_pages = new mysql_select ( $tbl_catalog, "WHERE lang_id = {$_COOKIE[lang_id]} ", "ORDER BY dict_id ASC" );
$cl_sel_pages->select_table ( "ct_id" );

$active_id = $cl_sel_pages->buld_table [$_POST ['ct_id']];
//
$ShopsData = new mysql_select ( );
$ShopsData->select_table_query ( "select c.* from {$tbl_catalog} c
								  WHERE c.lang_id = {$_COOKIE['lang_id']} and c.dict_id = '4d3c421816e39'", "ct_id" );


 #	функция формирует списов возможный родителей, справочник меню
function printListShop($arr) {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$str .= "<option value=\"{$arr[$i]['ct_id']}\">{$arr[$i]['ct_name']} / {$arr[$i]['ct_adress']}</option>";
	}
	return $str;
}
								  
#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
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


$hide = '';
if ($active_id ['hide'])
	$hide = "checked=\"checked\"";
	
#	преобразуем флажки
$active_id = $cl_sel_pages->buld_table [$_POST ['ct_id']];
?>
<script type="text/javascript">
//page dialog hide
function hide_ajax_div() {
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
	$("#tabs").tabs();
});
</script>
<div id="dialog-page-body"></div>
<div id="d-dialog">
<div id="d-dialog-in">
<table class="t-dialog">
	<tr>
		<td class="td-dialog-close">
		<div
			class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"
			unselectable="on" style="-moz-user-select: none;"><span
			class="ui-dialog-title" id="ui-dialog-title-outputWindows"
			unselectable="on" style="-moz-user-select: none;">Редактирование
		пункта</span> <a href="#"
			class="ui-dialog-titlebar-close ui-corner-all" role="button"
			unselectable="on" onclick="hide_ajax_div();"
			style="-moz-user-select: none;"> <span
			class="ui-icon ui-icon-closethick" unselectable="on"
			style="-moz-user-select: none;">close</span></a></div>
		</td>
	</tr>
	<tr>
		<td class="td-dialog-form">
		<div id="d-overflow">
		<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Описание пункта</a></li>
			<li><a href="#tabs-2">Фотогалерея</a></li>
		</ul>
		<div id="tabs-1">
							<?php
							#	подключение формы для редактирования
							include_once ("template.edit/form.page.php");
							?>
						</div>
		<div id="tabs-2">
						<?php
						include_once ("template.print/print.photo.php");
						?>
						</div>
		</div>
		
		</td>
	</tr>
</table>
</div>
</div>
