<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );

$ClModCel = new mysql_select ( );
$ClModCel->select_table_query ( "SELECT m.*  FROM modules m order by m_type", 'm_id' );
$mod_dct = $ClModCel->table;

$dictionaries->do_dictionaries ( 2 );
$temp_dct = $dictionaries->my_dct;

$ClTempCel = new mysql_select ( );
$ClTempCel->select_table_query ( "SELECT m.*  FROM {$tbl_temp} m order by temp_id", 'temp_id' );

$ActiveIdData = $ClTempCel->buld_table [$_POST ['temp_id']];

$ClTempModCel = new mysql_select ( );
$ClTempModCel->select_table_query ( "SELECT tm.*, m.m_name  FROM {$tbl_temp_module} tm 
	  										left join {$tbl_modules} m on tm.m_id = m.m_id where tm.temp_id = {$_POST['temp_id']}", 'tm_id' );

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

function PrintTempMod($Data) {
	$return = '';
	for($i = 0; $i < count ( $Data ); $i ++) {
		$return .= "<label class='zpFormLabel'>Название модуля</label><input class='zpFormRequired' value=\"{$Data[$i]['m_name']}\" disabled size=\"50\" name=\"\" type=\"text\"><br>
	  		<label class=\"zpFormLabel\">Подключать</label><input value=\"{$Data[$i]['tm_id']}\" name=\"{$Data[$i]['tm_id']}[{$Data[$i]['m_id']}]\" checked=\"checked\" type=\"checkbox\" class=\"zpForm\"/><br><br>";
	}
	if ($Data)
		return "<fieldset class=\"zpForm\"><legend>Подключенные модули</legend>" . $return . "</fieldset>";
	else
		return;
}

?>
<script type="text/javascript">
$(function() {
  $("#tabs").tabs();
});
</script>

<div id="d-overflow">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Данные шаблона</a></li>
	<li><a href="#tabs-2">Возможный модули</a></li>
</ul>
<div id="tabs-1">
      <?php
						#	подключение формы для редактирования
						include_once "template.edit/form.temp.php";
						?>
    </div>
<div id="tabs-2">
      <?php
						include_once "template.edit/form.temp.mod.php";
						?>
    </div>
</div>
</div>
