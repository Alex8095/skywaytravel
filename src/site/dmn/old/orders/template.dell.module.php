<?php
require_once '../utils/template.ajax/js.css.php';

try {
	$query = "DELETE FROM {$tbl_order} WHERE order_id = '{$_POST[order_id]}'";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
} catch ( ExceptionMySQL $exc ) {
	echo ExceptionFullGet::ExcMysqlN ( $exc );
	$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
}
?>
