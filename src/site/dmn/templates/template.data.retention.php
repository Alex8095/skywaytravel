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

if ($_POST ['retention'] == 'add_temp') {
	try {
		$_POST ['parent_id'] = ($_POST ['parent_id'] ? $_POST ['parent_id'] : 'NULL');
		
		$query = "INSERT INTO {$tbl_temp}
						VALUES (NULL,
								 '{$_POST[temp_name]}',
								 '{$_POST[temp_type]}',
								 {$_POST[parent_id]},
								 '{$_POST[temp_s_name]}',
								 '{$_POST[temp_s_code]}');";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR add temp position" );
		
		$response ['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST ['retention'] == 'edit_temp') {
	$_POST ['parent_id'] = ($_POST ['parent_id'] ? $_POST ['parent_id'] : 'NULL');
	
	$arr_update = array ("temp_name" => "'{$_POST[temp_name]}',", "temp_type" => "'{$_POST[temp_type]}',", "temp_s_name" => "'{$_POST[temp_s_name]}',", "temp_s_code" => "'{$_POST[temp_s_code]}',", "parent_id" => "{$_POST[parent_id]}" );
	
	$cl_page_update = new mysql_select ( $tbl_temp );
	$cl_page_update->update_table ( "WHERE temp_id = '{$_POST[temp_id]}'", $arr_update );
	
	$response ['success'] = "true";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'edit_temp_modules') {
	try {
		//  			echo "<pre>";
		//  			print_r($_POST);
		//  			echo "</pre>";
		

		$query = "DELETE FROM {$tbl_temp_module} WHERE temp_id = {$_POST[temp_id]}";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR DELL POS TEMP MOD" );
		
		foreach ( $_POST as $key => $value ) {
			if ($key != 'im_id' and $key != 'retention' and $key != 'temp_id') {
				$pm_id = 'NULL';
				$m_id = $value;
				if (number_format ( $key )) {
					foreach ( $value as $pm_id => $m_id ) {
					}
					$value = $pm_id;
					$pm_id = $m_id;
				}
				
				if (! empty ( $value )) {
					$query = "INSERT INTO {$tbl_temp_module} (`tm_id`, `temp_id`, `m_id`) VALUES
												({$pm_id}, {$_POST[temp_id]}, {$value})
												ON DUPLICATE KEY UPDATE m_id = {$value};";
					if (! mysql_query ( $query ))
						throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE TEMPLATE MODULE" );
				}
			}
		}
		
		$response ['success'] = "true";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}
?>
