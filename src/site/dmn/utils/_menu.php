<a title="" href="../orders" class="menu-link-na">﻿Orders</a>
<div id="orders"></div>
<a title="" href="../sport-tickets" class="menu-link-na">﻿Catalog (sport tickets)</a>
<div id="sport-tickets"></div>
<a href="#" onclick="TShowPage('DMN_GoodsAction', 'getPage')" title="Actions">Actions</a>
<a href="#" onclick="TShowPage('DMN_Places', 'getPage')" title="Places">Places</a>
<a href="#" onclick="TShowPage('DMN_Places_CC', 'getPage')" title="Places Country/City">Places Country/City</a> 
<div class="clear" style="height: 10px;"></div>
<a href="#" onclick="TShowPage('DMN_Users', 'getPage')" title="Actions">Users</a>
<a href="#" onclick="TShowPage('TPacketCode', 'getPage')" title="Actions">Packets</a>
<a href="#" onclick="TShowPage('TSpecialCode', 'getPage')" title="Special Codes">Special Codes</a>
<div class="clear" style="height: 10px;"></div>
<a title="" href="../banners" class="menu-link-na">﻿Banners</a>
<div id="banners"></div>
<a title="" href="../3pages" class="menu-link-na">Контент страниц</a>
<div id="3pages"></div>
<div class="clear" style="height: 10px;"></div>
<a title="" href="../wdictionaries" class="menu-link-na">Справочники</a>
<div id="wdictionaries"></div>
<a title="" href="../templates" class="menu-link-na">Шаблоны</a>
<div id="templates"></div>
<a title="" href="../modules" class="menu-link-na">Модули</a>
<div id="modules"></div>
<a title="" href="../ptm" class="menu-link-na">Страницы (Конструктор) </a>
<div id="ptm"></div>
<div class="clear" style="height: 10px;"></div>
<a title="" href="../user_dmn" class="menu-link-na">Администраторы</a>
<div id="user_dmn"></div>
<?php
//error_reporting ( E_ALL & ~ E_NOTICE );

//  // Анализируем содержимое каталога системы
//  // администрирования для формирования меню
//
//  // Открываем каталог /dmn
//  $dir = opendir("..");
//  // В цикле проходимся по всем файлам и
//  // подкаталогам
//  while (($file = readdir($dir)) !== false)
//  {
//    // Обрабатываем только подкаталоги, 
//    // игнорируя файлы
//    if(is_dir("../$file"))
//    {
//      // Исключаем текущий ".", родительский ".."
//      // каталоги, а также каталог utils
//      if($file != "." && $file != ".." && $file != "utils"  && $file != ".svn")
//      {
//        // Ищем в каталоге файл с описанием
//        // блока .htdir
//        if(file_exists("../$file/.htdir"))
//        {
//          // Файл .htdir существует - 
//          // читаем название блока и его
//          // описание
//          list($block_name, 
//               $block_description) = file("../$file/.htdir");
//        }
//        else
//        {
//          // Файл .htdir не существует -
//          // в качестве его названия 
//          // выступает имя подкаталога
//          $block_name        = "$file";
//          $block_description = "";
//        }
//
//        // Отмечаем текущий пункт другим стилем
//        if(strpos($_SERVER['PHP_SELF'], $file) !== false) 
//        {
//          $style =  "class=\"menu-link-a\"";
//        }
//        else $style = "class=\"menu-link-na\"";
//
//		if ($block_name != "enterDmn")
//		{
//			// Формируем пункт меню
//			echo "<a $style href='../$file'  title='$block_description'>$block_name</a><div id='{$file}'></div>";
//		}
//		}
//    }
//  }
//  // Закрываем каталог
//  closedir($dir);
?>