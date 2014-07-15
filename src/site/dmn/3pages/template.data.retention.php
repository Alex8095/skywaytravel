<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
require_once (DOC_ROOT . "/dmn/utils/db_tables.inc");

// Подключаем блок авторизации
require_once ("../utils/security_mod.php");
// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.inc");

/*echo "<pre>";
 print_r($_POST);
 echo "</pre>";

 echo "<pre>";
 print_r($_GET);
 echo "</pre>";

 echo "<pre>";
 print_r($_FILES);
 echo "</pre>";*/

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$fileDir = '../../files/images/cp/';

$hide = "NULL";
if ($_POST ['hide'])
$hide = 1;

if ($_POST ['retention'] == 'edit_page') {

	$arr_update = array ("pc_text" => "'{$_POST[pc_text]}'" );

	$cl_page_update = new mysql_select ( $tbl_content );
	$cl_page_update->update_table ( "WHERE pc_id = '{$_POST[pc_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );

	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_page') {
	$_POST['pc_id'] = uniqid();
	$query = "INSERT INTO
								{$tbl_content}
							SET
								pc_id 			= '{$_POST['pc_id']}',
								page_id  		= '{$_POST['page_id']}',
								pc_type  		= '{$_POST['pc_type']}',
								lang_id			= #lang_id#,
								pc_text 		= '{$_POST['pc_text']}';";
	if (! mysql_query ( str_replace ( "#lang_id#", 1, $query ) ))
	throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	if (! mysql_query ( str_replace ( "#lang_id#", 2, $query ) ))
	throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	if (! mysql_query ( str_replace ( "#lang_id#", 3, $query ) ))
	throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}