<?php
require_once '../utils/template.ajax/js.css.php';
$query = "DELETE FROM $tbl_content WHERE pc_id = '{$_POST[pc_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
	$('#DivRequest').load('template.load.php?print=list_pc');
</script>
