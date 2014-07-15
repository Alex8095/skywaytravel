<?php
require_once '../utils/template.ajax/js.css.php';

$query = "DELETE FROM {$tbl_brands_shops} WHERE bs_id = {$_POST[bs_id]}";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
?>
