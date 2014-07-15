<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
<?php
require_once '../utils/template.ajax/js.css.php';
?>
<?php

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}" );
#
$cl_sel_pages = new mysql_select ( $tbl_catalog, "WHERE lang_id = {$lang_id} ", "ORDER BY dict_id ASC" );
$cl_sel_pages->select_table ( "ct_id" );

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
$cp_id = uniqid();
#	функция формирует списов возможный родителей, справочник меню
function sel_parent_standart($arr, $sel = 'NULL', $name_id = 'sc_id', $echo_id = 'menu_words') {
	$str = NULL;
	for($i = 0; $i < count ( $arr ); $i ++) {
		$selecteOption = NULL;
		if ($sel) {
			if ($sel == $arr [$i] [$name_id])
				$selecteOption = "selected=\"selected\"";
		}
		
		$str .= "<option {$selecteOption} value=\"{$arr[$i][$name_id]}\">{$arr[$i][$echo_id]}</option>";
	
	}
	return $str;
}
?>
<?php

$cp_id = uniqid ();
?>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div() {
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
$(function() {
	$("#tabs").tabs();
});
function myOnFunctionAddImg()
{
	var outputDiv = document.getElementById("errOutput");
	
	if(outputDiv != null){
		outputDiv.innerHTML = '';//clear error message if any
		outputDiv.style.display = "none";
	}
	
	$('#errOutput').text('');
	$('#errOutput').show();
	$("#errOutput").append('Добавление товара выполнено успешно.');
	$('#DivRequest').load('template.load.php?<?php echo ($_POST['requery_id'] ? $_POST['requery_id']: 'print=list_good');?>');

	$('#DivRequestImg').load('template.add/form.add.img.php?cp_id=<?php echo $cp_id;?>&new_position=true');
}
</script>
<div id="dialog-page-body"></div>
<div id="d-dialog">
  <div id="d-dialog-in">
    <table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;"> <span class="ui-dialog-title" id="ui-dialog-title-outputWindows" unselectable="on" style="-moz-user-select: none;">Добавление товара</span> <a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button" unselectable="on" onclick="hide_ajax_div();" style="-moz-user-select: none;"> <span class="ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span></a></div></td>
      </tr>
      <tr>
        <td class="td-dialog-form"><div id="d-overflow">
            <div id="tabs">
              <ul>
                <li><a href="#tabs-1">Описание товара</a></li>
              </ul>
              <div id="tabs-1">
                <div id="DivRequestImg"></div>
                <?php
									#	подключение формы для редактирования
									include_once ("template.add/form.page.php");
									?>
              </div>
            </div>
          </div>
          <div></div></td>
      </tr>
    </table>
  </div>
</div>
<!-- ДОБАВЛЕНИЕ ПОЗИЦИИ -->
