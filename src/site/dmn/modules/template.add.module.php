<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
#задаем айди значение справочника меню
$dictionaries->do_dictionaries ( 1 );
#перечень значение словаря новостей
$mod_dct = $dictionaries->my_dct;

$ClModCel = new mysql_select ( );
$ClModCel->select_table_query ( "SELECT m.*  FROM modules m order by m_type" );

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
include_once ("template.add/form.modyle.php");
?>
</div>
