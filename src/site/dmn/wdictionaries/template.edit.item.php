<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
<?php
require_once '../utils/template.ajax/js.css.php';
#	селектим таблицу страниц
$cl_sel_pages = new mysql_select ( $tbl_list_dictionaries, '', "ORDER BY ld_id" );
$cl_sel_pages->select_table ( "ld_id" );
#объявляем класс словаря


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

#	преобразуем флажки
$active_id = $cl_sel_pages->buld_table [$_POST ['ld_id']];

?>

<div id="d-overflow">
						<?php
						#	подключение формы для редактирования
						include_once ("template.edit/form.page.php");
						?>
			       </div>
