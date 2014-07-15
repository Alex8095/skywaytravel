<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
//require_once("../utils/security_mod.php");
require_once ("../../config/class.inc");
require_once ("../../dmn/utils/db_tables.inc");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

$log = new LoggerClass ( DOC_ROOT . '/files/logs/site/' );

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

if ($_POST ['retention'] == 'edit_order') {
	$arr_update = array ("status_id" => "'{$_POST['status_id']}', ",
						 "user_adress" => "'{$_POST['user_adress']}',", 
						 "date_status" => "NOW()" );
	
	$cl_page_update = new mysql_select ( $tbl_order);
	$cl_page_update->update_table ( "WHERE order_id = {$_POST['order_id']}", $arr_update );
	
	$response ['success'] = "true";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}
?>
