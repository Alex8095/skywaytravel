<?php
  error_reporting(E_ALL & ~E_NOTICE);

  // Обрабатываем исключения, возникающие при 
  // обращении к СУБД MySQL

  // Включаем заголовок страницы
  //require_once("../utils/top.php");

  echo "\nПроизошла исключительная ситуация (ExceptionMySQL) при обращении к СУБД MySQL.\n";
  echo "\n{$exc->getMySQLError()}\n".nl2br($exc->getSQLQuery())."\n";
  echo "\nОшибка в файле {$exc->getFile()} в строке {$exc->getLine()}.\n";

  // Включаем завершение страницы
  //require_once("../utils/bottom.php");
  exit();
?>