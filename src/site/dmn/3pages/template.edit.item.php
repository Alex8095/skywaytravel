<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->
<?php
$ZpFormInc = 'formEdit.js';
require_once '../utils/template.ajax/js.css.php';
#	селектим таблицу страниц
$cl_sel_pages = new mysql_select ( $tbl_content );
$active_id = $cl_sel_pages->select_table_id ( "WHERE lang_id = $_COOKIE[lang_id] AND pc_id='{$_POST[pc_id]}'" );
?>
<script type="text/javascript">
//	page dialog hide
function hide_ajax_div()
{
	 $('#dialog-page-body').hide();
	 $('#d-dialog').hide();
}
</script>
<div id="dialog-page-body"></div>

<div id="d-dialog">
<div id="d-dialog-in">
<table class="t-dialog">
      <tr>
        <td class="td-dialog-close"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;"> <span class="ui-dialog-title" id="ui-dialog-title-outputWindows" unselectable="on" style="-moz-user-select: none;">Редактирование контента</span> <a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button" unselectable="on" onclick="hide_ajax_div();" style="-moz-user-select: none;"> <span class="ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span></a></div></td>
      </tr>
	<tr>
		<td class="td-dialog-form">
		<div id="d-overflow">
		<?php
			#	подключение формы для редактирования
			include_once ("template.edit/form.page.php");
		?>
		</div>
		</td>
	</tr>
</table>
</div>
</div>
<!-- РЕДАКТИРОВАНИЕ ПОЗИЦИИ -->