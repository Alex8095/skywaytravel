<?php
error_reporting ( E_ALL & ~ E_NOTICE );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );

// Устанавливаем соединение с базой данных
require_once (DOC_ROOT . "/config/config.php");
require_once (DOC_ROOT . "/dmn/utils/db_tables.inc");

// Подключаем SoftTime FrameWork
require_once (DOC_ROOT . "/config/class.inc");
require_once '../utils/admin.panel.access/admin.panel.access.php';
  
  	$json_converter = new Services_JSON();
  	$response = array();
  	$response['success'] = false;
  	$response['fieldErrors'] = array();
	
  	$AdminAccess = new admin_panel_acess();
	$AdminAccess->enter_admin_panel($_POST);
	$response = $AdminAccess->errorRequery;

	header('Content-type: text/plain');
	echo $json_converter->encode($response);
?>