<?php
require_once '../utils/template.ajax/js.css.php';

$query = "DELETE FROM $tbl_catalog WHERE ct_id = '{$_POST[ct_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
$query = "DELETE FROM $tbl_ct_photos WHERE ct_id = '{$_POST[ct_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
?>
<script type="text/javascript">
	$.prompt('Элемент удален.');
</script>
