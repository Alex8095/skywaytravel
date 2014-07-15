<?php
require_once '../utils/template.ajax/js.css.php';

$query = "DELETE FROM ct_photos WHERE ct_photo_id = '{$_POST[ct_photo_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
?>
