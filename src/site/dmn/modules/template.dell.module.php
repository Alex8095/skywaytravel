<?php
require_once '../utils/template.ajax/js.css.php';
try {
	$query = "DELETE FROM {$tbl_modules} WHERE m_id = '{$_POST[m_id]}'";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении каталога" );
} catch ( ExceptionMySQL $exc ) {
	echo ExceptionFullGet::ExcMysqlN ( $exc );
	$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
}
?>
