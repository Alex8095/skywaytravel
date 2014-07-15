<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
<?php
require_once '../utils/template.ajax/js.css.php';
?>
<?php

#	селектим таблицу страниц
$cl_sel_pages = new mysql_select ( $tbl_list_dictionaries, "", "" );
$cl_sel_pages->select_table ( "ld_id" );
#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
# 	Получаем содержимое текущей страницы
$cl_sel_position = new mysql_select ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id]", "ORDER BY dict_id ASC" );
$cl_sel_position->select_table ( "dict_id" );

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

?>
<div id="d-overflow">
									<?php
									#	подключение формы для редактирования
									include_once ("template.add/form.page.position.php");
									?>
			            </div>
