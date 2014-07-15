<?php
require_once '../utils/template.ajax/js.css.php';
try {
	$query = "DELETE FROM {$tbl_temp} WHERE temp_id = '{$_POST[temp_id]}'";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении" );
} catch ( ExceptionMySQL $exc ) {
	echo ExceptionFullGet::ExcMysqlN ( $exc );
	$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
}
?>
