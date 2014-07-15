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
 
  $title = 'Управление блоком &#8220;Админнистраторы сайта&#8221;.';
  $pageinfo = '<p class=help>Здесь можно добавлять,радактировать и удалять &#8220;Администраторов сайта&#8221;.</p>';
 
  // Включаем заголовок страницы
  require_once("../utils/top.php");

  try
  {
	
	?>
<!-- AJAX-ответ от сервера заменит этот текст. -->
<div id="outputWindows">
	<div id="output"></div>
</div>
<div id="DivRequest"> <h4 style="margin:0 0 0 30px; padding:30px 0 0 0;">Добро пожаловать в панель управления сайта.</h4></div>

<script type="text/javascript">
$(document).ready(function(){
	$("#loading").hide();
	$("#accordion").accordion();

});
</script>

<div id="accordion">
  	<h3><a href="#">Бренды</a></h3>
  	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/W7t1sfjL4s0" frameborder="0" allowfullscreen></iframe></div>
  	<h3><a href="#">Магазины</a></h3>
  	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/QrsXiBJoKMc" frameborder="0" allowfullscreen></iframe></div>
  	<h3><a href="#">Новости</a></h3>
	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/L0zm8GhNTGQ" frameborder="0" allowfullscreen></iframe></div>
    <h3><a href="#">Управление страницами</a></h3>
	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/LTp13HqD1wM" frameborder="0" allowfullscreen></iframe></div>
   	<h3><a href="#">Управление контентом</a></h3>
	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/nMC3PLiOp5E" frameborder="0" allowfullscreen></iframe></div>
   	<h3><a href="#">Города (справочники)</a></h3>
	<div><iframe width="420" height="315" src="http://www.youtube.com/embed/nZjDIlLWxK8" frameborder="0" allowfullscreen></iframe></div>
</div>



	<?php
  }
  catch(ExceptionMySQL $exc)
  {
    require("../utils/exception_mysql.php"); 
  }

  // Включаем завершение страницы
  require_once("../utils/bottom.php");
?>