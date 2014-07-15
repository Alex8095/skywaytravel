<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
//require_once("../utils/security_mod.php");
require_once ("../../config/class.inc");
require_once ("../../dmn/utils/db_tables.inc");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$fileDir = '../../files/images/dict/';
$ImgProp ['ImgW'] = 44;
$ImgProp ['ImgH'] = 44;

#	 PAGE
if ($_POST ['retention'] == 'edit_page') {
	#	
	$arr_update = array ("ld_code" => "'{$_POST[ld_code]}',", "ld_name" => "'{$_POST[ld_name]}',", "ld_descr" => "'{$_POST[ld_descr]}'" );
	
	#	
	$cl_page_update = new mysql_select ( $tbl_list_dictionaries );
	$cl_page_update->update_table ( "WHERE ld_id = '{$_POST[ld_id]}'", $arr_update );
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

#	add PAGE
if ($_POST ['retention'] == 'add_page') {
	$_POST ['ld_code'] = mysql_real_escape_string ( $_POST ['ld_code'] ? $_POST ['ld_code'] : substr ( translit ( $_POST [ld_name] ), 0, 12 ) );
	$_POST ['ld_parent'] = ($_POST ['ld_parent'] ? $_POST ['ld_parent'] : 'NULL');
	$query = "INSERT INTO $tbl_list_dictionaries
						 VALUES (NULL,
								 '{$_POST[ld_code]}',
								 '{$_POST[ld_name]}',
								 '{$_POST[ld_descr]}',
								 {$_POST[ld_parent]});";
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	
	$response ['success'] = "testststst";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'edit_position_page') {
	#	
	$arr_update = array ("ld_id" => "'{$_POST[ld_id]}',", "dict_code" => "'{$_POST[dict_code]}',", "dict_name" => "'{$_POST[dict_name]}',", "parent_id" => "'{$_POST[parent_id]}'" );
	
	#	
	$cl_page_update = new mysql_select ( $tbl_dictionaries );
	$cl_page_update->update_table ( "WHERE dict_id = '{$_POST[dict_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
	
	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );

}

if ($_POST ['retention'] == 'add_position_page') {
	//$_POST ['dict_code'] = mysql_escape_string ( $_POST ['dict_code'] ? $_POST ['dict_code'] : substr ( translit ( $_POST [dict_name] ), 0, 11 ) );
	//$_POST['dict_code'] = addslashes($_POST['dict_code']);
	$_POST ['dict_id'] = ($_POST ['dict_id'] ? $_POST ['dict_id'] : uniqid ());
	if ($_COOKIE ['lang_id'] == 1) {
		$lang_f = 2;
		$lang_t = 3;
	}
	if ($_COOKIE ['lang_id'] == 2) {
		$lang_f = 1;
		$lang_t = 3;
	}
	
	$query = "INSERT INTO $tbl_dictionaries
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '1',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}',
								 0,
								 NULL);";
	
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	
	$query = "INSERT INTO $tbl_dictionaries
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '2',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}',
								 0,
								 NULL);";
	
	if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	
	$response ['success'] = "testststst";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_img') {
	$extension = pathinfo ( $_FILES ['images'] ['name'] );
	$extension = $extension ['extension'];
	$fileName = strtolower ( $_POST ['dict_id'] . "." . $extension );
	
	if ($extension != 'png')
		return "ERROR!! NO PNG";
	if ($_FILES ['images'])
		if (copy ( $_FILES ['images'] ['tmp_name'], $fileDir . '' . $fileName )) {
			if (isset ( $_POST ['IsResize'] )) {
				// *** 1) Initialise / load image
				$resizeObj = new resize ( $fileDir . "" . $fileName );
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj->resizeImage ( $ImgProp ['ImgW'], $ImgProp ['ImgH'], 'crop' );
				// *** 3) Save image
				$resizeObj->saveImage ( $fileDir . '' . $fileName, 100 );
			}
			
			$arr_update = array ("dict_have_image" => "1" );
			$cl_page_update = new mysql_select ( $tbl_dictionaries );
			$cl_page_update->update_table ( "WHERE dict_id = '{$_POST[dict_id]}'", $arr_update );
			//echo "OK";
		}
}
/*$response['fieldErrors']['title'] = "Passwords do not match";
if(sizeof($response['fieldErrors']) == 0)
{
	$response['success'] = true;
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
} 
else
{
	
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
}*/
?>
