<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
//require_once("../utils/security_mod.php");
require_once ("../../config/class.inc");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

$log = new Logger ( DOC_ROOT . '/files/logs/site/' );

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

if ($_POST ['retention'] == 'add_module') {
	try {
		$_POST ['parent_id'] = ($_POST ['parent_id'] ? $_POST ['parent_id'] : 'NULL');
		
		$query = "INSERT INTO modules 
						VALUES (NULL,
								 '{$_POST[m_name]}',
								 '{$_POST[m_type]}',
								 {$_POST[parent_id]},
								 '{$_POST[m_s_name]}');";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR add modules position" );
		
		$response ['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST ['retention'] == 'edit_module') {
	$_POST ['parent_id'] = ($_POST ['parent_id'] ? $_POST ['parent_id'] : 'NULL');
	
	$arr_update = array ("m_name" => "'{$_POST[m_name]}',", "m_type" => "'{$_POST[m_type]}',", "m_s_name" => "'{$_POST[m_s_name]}',", "parent_id" => "{$_POST[parent_id]}" );
	
	$cl_page_update = new mysql_select ( $tbl_modules );
	$cl_page_update->update_table ( "WHERE m_id = '{$_POST[m_id]}'", $arr_update );
	
	$response ['success'] = "true";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}
?>
