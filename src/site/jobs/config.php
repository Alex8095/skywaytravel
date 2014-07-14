<?php
/*
 * @copy Copyright 2013 @version 2.1 @author Alex Prophet <webroom.in.ua>
 */
@set_time_limit ( 0 );
@ini_set ( 'memory_limit', '256M' );
@ini_set ( 'allow_url_fopen', '1' );
// ini_set ( 'max_execution_time', 1200 );

// отображение ошибок
error_reporting ( E_ALL & ~ E_NOTICE & ~ E_WARNING );
ini_set ( "display_errors", 1 );

// опредение времени
function getmicrotime() {
	list ( $usec, $sec ) = explode ( " ", microtime () );
	return (( float ) $usec + ( float ) $sec);
}
$time_start = getmicrotime ();

// константы
define ( 'SLASH', '/' );
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] . "/" );

// define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
define ( 'DEBUG', 1 );
session_start ();

include DOC_ROOT . '/config/class.inc'; // подключение классов
include DOC_ROOT . '/config/config.php'; // поключение конфига
include DOC_ROOT . '/config/models.inc'; // поключение моделей
include DOC_ROOT . '/config/providers.inc'; // поключение провайдеров
include DOC_ROOT . '/config/controllers.inc'; // поключение контроллеров
