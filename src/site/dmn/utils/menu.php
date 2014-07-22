<?php
error_reporting(E_ALL & ~E_NOTICE);
// Анализируем содержимое каталога системы
// администрирования для формирования меню
// Открываем каталог /dmn
$otherMenuItems = "";
$dir = opendir("..");
$rolesAdmin = explode(",", $_COOKIE["roles"]);
// В цикле проходимся по всем файлам и
// подкаталогам
while (($file = readdir($dir)) !== false) {
	// Обрабатываем только подкаталоги,
	// игнорируя файлы
	if(is_dir("../$file")) {
		// Исключаем текущий ".", родительский ".."
		// каталоги, а также каталог utils
		if($file != "." && $file != ".." && $file != "utils"  && $file != ".svn" && $file != "firstPage" && $file != "enterDmn") {
			// Ищем в каталоге файл с описанием
			// блока .htdir
			if(file_exists("../$file/.htdir")) {
				// Файл .htdir существует -
				// читаем название блока и его
				// описание
				list($block_name, $block_rools, $block_action, $block_type) = file("../$file/.htdir");
			
				// Отмечаем текущий пункт другим стилем
				if(strpos($_SERVER['PHP_SELF'], $file) !== false)
					$style =  "menu-link-a";
				else
					$style = "menu-link-na";
				$block_action = trim ($block_action);
				$cssClassElement = str_replace("TShowPage('", "", $block_action);
				$cssClassElement = substr($cssClassElement, 0, strpos($cssClassElement, "'"));
				$menu_item =  sprintf("<div class=\"menu-item\"><a id=\"main-menu-item-%s\" title=\"%s\" href=\"%s\" class=\"%s element-%s\" onclick=\"%s\">%s</a><div id=\"%s\"></div></div>", 
									  $file, 
									  $block_name, 
									  ($block_action == "false" ? "../" . $file : "#"),
									  $style, 
									  $cssClassElement,
									  ($block_action == "false" ? "" : $block_action ), 
									  $block_name, 
									  $file);
				
				if($block_type)
					echo $menu_item;
				else 
					$otherMenuItems .= $menu_item;
			}
			else {
				// Файл .htdir не существует -
				// в качестве его названия
				// выступает имя подкаталога
				$block_name        = "$file";
				$block_description = "";
			}
		}
	}
}

if(!empty($otherMenuItems)) {
	echo "<div class=\"other-menu-item\"><span class=\"text\">Другое</span><div class=\"list\">{$otherMenuItems}</div></div>";
}

// Закрываем каталог
closedir($dir);
?>