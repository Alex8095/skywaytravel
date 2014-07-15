<?php
require_once '../utils/template.ajax/js.css.php';

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );

$ClModCel = new mysql_select ( );
$ClModCel->select_table_query ( "SELECT m.*  FROM modules m order by m.m_name", 'm_id' );
$mod_dct = $ClModCel->table;
$ClModHad = new catalogClass ( $ClModCel->table, $ClModCel->buld_table, 'm_name', 'm_id', 'parent_id' );
$ClModHad->get_arr_formation ();

$ClTempCel = new mysql_select ( );
$ClTempCel->select_table_query ( "SELECT t.*, d.dict_name  FROM {$tbl_temp} t 
								  left join {$tbl_dictionaries} d on t.temp_type= d.dict_id and d.lang_id = {$_COOKIE[lang_id]}
								  order by t.temp_name", 'temp_id' );
$temp_dct = $ClTempCel->table;
$ClTempHad = new catalogClass ( $ClTempCel->table, $ClTempCel->buld_table, 'temp_name', 'temp_id', 'parent_id' );
$ClTempHad->get_arr_formation ();


$ClPTMCel = new mysql_select ( );
$ClPTMCel->select_table_query ( "SELECT ptm.*, t.temp_name FROM {$tbl_ptm} ptm  
								  left join {$tbl_temp} t on ptm.temp_id = t.temp_id 
								  where ptm.page_id = '{$_POST['page_id']}'
								  order by ptm.pt_id ", 'pt_id' );
$ClPTMHad = new catalogClass ( $ClPTMCel->table, $ClPTMCel->buld_table, 'temp_name', 'pt_id', 'parent_id' );
$ClPTMHad->get_arr_formation ();

$ClPTMCelMax = new mysql_select ( );
$ClPTMCelMax->select_table_query ( "SELECT MAX(pt_id) FROM {$tbl_ptm}", 'pt_id' );
$MaxPTId = $ClPTMCelMax->table[0][0] + 1;
$mainTempId = $MaxPTId + 100;
/*if(count($ClPTMCel->table) > 0) {
	echo $mainTempId = $ClPTMCel->table[0]["pt_id"];
	echo ".".$MaxPTId = $MaxPTId + 1;
}*/
#	функция формирует списов возможный родителей, справочник меню
function sel_parent_id($arr, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = "<option value=\"\">-- no selected --</option>";
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	}
	return $str;
}

function sel_parent_catalog($arr, $data, $sel = 'NULL', $name_id = 'pc_id', $echo_id = 'menu_words') {
	$str = "<option value=\"\">-- no selected --</option>";
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel)
			if ($sel == $data[$arr[$i][0]] [$name_id])
				$selecteOption = "selected=\"selected\"";
		$str .= "<option {$selecteOption} value=\"{$data[$arr[$i][0]][$name_id]}\" style=\"padding-left:" . $arr[$i][2]*5 . "px\">{$data[$arr[$i][0]][$echo_id]}</option>";
	}
	return $str;
}

//echo "<pre>";
//print_r($ClPTMHad->ArrFormation);
//echo "</pre>";
function buildPageStructure($data, $sortedData, $parent_id) {
	global $ClTempHad;
	global $ClTempCel;
	global $ClModHad;
	global $ClModCel;
	
	$ret = "";
	foreach ($sortedData as $key => $value) {
		if($value[1] == $parent_id) {
			$ret .= '<div class="ptm" style="" id="block-id-'.$data[$value[0]]["pt_id"].'" rel="1">
						<fieldset class="">
							<legend>Добавление шаблона, модуль</legend>
							<a href="javascript:addNewTemplate('.$data[$value[0]]["pt_id"].');">Add</a> <a href="javascript:dellNewTemplate('.$data[$value[0]]["pt_id"].');">Dell</a>
							<div class="clear"></div>
							<label class=\'zpFormLabel\'>Шаблон</label>
							<select name="temp_id-'.$data[$value[0]]["pt_id"].'" class="zpForm">'. sel_parent_catalog ( $ClTempHad->ArrFormation, $ClTempCel->buld_table, $data[$value[0]]["temp_id"], 'temp_id', 'temp_name' ) .'</select>
							<br>
							<label class=\'zpFormLabel\'>Модуль</label>
							<select name="mod_id-'.$data[$value[0]]["pt_id"].'" class="zpForm">' . sel_parent_catalog ( $ClModHad->ArrFormation, $ClModCel->buld_table, $data[$value[0]]["mod_id"], 'm_id', 'm_name' ). '</select>
							<br>
							<label class=\'zpFormLabel\'>Значение</label>
							<input class=\'zpForm\' value="'.$data[$value[0]]["pt_val"].'" size="50" name="pt_val-'.$data[$value[0]]["pt_id"].'" type="text">
							<br>
							<label class=\'zpFormLabel\'>Позиция</label>
							<input class=\'zpForm\' value="'.$data[$value[0]]["pos"].'" size="50" name="pos-'.$data[$value[0]]["pt_id"].'">
							<br>
							<label class=\'zpFormLabel\'>Позиция в шаблоне</label>
							<input class=\'zpForm\' value="'.$data[$value[0]]["pos_temp_id"].'" size="50" name="pos_temp_id-'.$data[$value[0]]["pt_id"].'" type="text">
							<br>
							<label class="zpFormLabel">Кешировать</label>
						  	<input value="1" name="pt_is_cache-'.$data[$value[0]]["pt_id"].'" type="checkbox" class="zpForm"/>
						  	<input class=\'zpForm\' value="'.$data[$value[0]]["parent_id"].'" size="50" name="parent_id-'.$data[$value[0]]["pt_id"].'" type="hidden">
						  	<input class=\'zpForm\' value="'.$data[$value[0]]["pt_id"].'" size="50" name="pt_id-'.$data[$value[0]]["pt_id"].'" type="hidden">
						  	<div class="clear"></div>
						  	<div class="inner-'.$data[$value[0]]["pt_id"].'">' . buildPageStructure($data, $sortedData, $value[0]) . '</div>
						</fieldset>	
					</div>';
		}
	}
	return $ret;
}

?>
<script type="text/javascript">
function hide_ajax_div() {
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
</script>
<script type="text/javascript">
$(function() {
  $("#tabs").tabs();
});
</script>
<div id="dialog-page-body"></div>
<div id="d-dialog">
  <div id="d-dialog-in">
    <table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;"> <span class="ui-dialog-title" id="ui-dialog-title-outputWindows" unselectable="on" style="-moz-user-select: none;">Добавление пункта &laquo;Каталога&raquo;</span> <a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button" unselectable="on" onclick="hide_ajax_div();" style="-moz-user-select: none;"> <span class="ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span></a></div></td>
      </tr>
      <tr>
        <td class="td-dialog-form">
<div id="d-overflow">
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Структура страницы</a></li>
</ul>
<div id="tabs-1">
    <?php
		#	подключение формы для редактирования
		include_once "template.edit/form.page.structure.php";
	?>
    </div>
</div>
</div>
		</td>
      </tr>
    </table>
  </div>
</div>

