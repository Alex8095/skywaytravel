<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
#задаем айди значение справочника меню
$dictionaries->do_dictionaries ( 2 );
#перечень значение словаря новостей
$temp_dct = $dictionaries->my_dct;

$ClTempCel = new mysql_select ( );
$ClTempCel->select_table_query ( "SELECT m.*  FROM {$tbl_temp} m order by temp_id", 'temp_id' );

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
include_once ("template.add/form.temp.php");
?>
</div>
