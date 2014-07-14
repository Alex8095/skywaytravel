<?php
// error_reporting(E_ALL & ~E_NOTICE);
// error_reporting(E_ALL);
// Если константа DEBUG определена, работает отладочный вариант,
// в частности выводится подробные сообщения об исключительных ситуациях, связанных с MySQL и ООП
// define("DEBUG", 1);
// сейчас выставлен сервер локальной машины

/*
 * $dblocation = 'localhost'; $dbname = "shop_alex"; $dbuser = "alexts"; $dbpasswd = "alex843887";
 */
//$dblocation = 'localhost';
$dblocation = 'localhost';
$dbname = "alfabrok";
$dbuser = "u_alfabrok";
$dbpasswd = "jb1qli0O";

// Устанавливаем соединение с базой данных
$dbcnx = mysql_connect ( $dblocation, $dbuser, $dbpasswd );
if (! $dbcnx)
	exit ( "<P>На сайте выполняються технические работы!</P>" );
	// В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.
	// Выбираем базу данных
if (! @mysql_select_db ( $dbname, $dbcnx ))
	exit ( "<P>На сайте выполняються технические работы!</P>" );
@mysql_query ( 'set NAMES utf8' );
@mysql_query ( 'SET sql_mode=STRICT_ALL_TABLES' );

if (! function_exists ( 'get_magic_quotes_gpc' )) {
	function get_magic_quotes_gpc() {
		return false;
	}
}
?>