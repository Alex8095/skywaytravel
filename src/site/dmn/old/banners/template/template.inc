<?php
$ModuleTemplate ['photo_list_block_header'] = "<table class=\"table-list\"><tr class=\"headings\"><td></td><td>Изображение</td><td>Тип</td><td>Позиция</td></tr>";
$ModuleTemplate ['photo_list_block_bottom'] = "</table>";
$ModuleTemplate ['photo_list_block'] = "<tr><td width=\"10\"><input type=\"radio\" value=\"#ct_photo_id#\" name=\"ct_photo_id\"/></td><td class=\"TdListLogoALignCenter\"><img width=\"80\" src=\"../../files/images/ct_photos/#ct_photo_id#.#ct_photo_file_type#\" alt=\"\" title=\"\"></td><td>#dict_name#</td><td>#ct_photo_order#</td></tr>";

$ModuleTemplate ['photo_ban_list_block_header'] = "<table class=\"table-list\"><tr class=\"headings\"><td></td><td>Изображение</td><td>Тип</td><td>Позиция</td></tr>";
$ModuleTemplate ['photo_ban_list_block_bottom'] = "</table>";
$ModuleTemplate ['photo_ban_list_block'] = "<tr><td width=\"10\"><input type=\"radio\" value=\"#ct_photo_id#\" name=\"ct_photo_id\"/></td><td class=\"TdListLogoALignCenter\"><img width=\"80\" src=\"../../files/images/banners/#ct_photo_id#.#ct_photo_file_type#\" alt=\"\" title=\"\"></td><td>#dict_name#</td><td>#ct_photo_order#</td></tr>";


$ModuleTemplate ['bs_list_block_header'] = "<table class=\"table-list\"><tr class=\"headings\"><td></td><td>Название магазина</td><td>Адрес</td></tr>";
$ModuleTemplate ['bs_list_block_bottom'] = "</table>";
$ModuleTemplate ['bs_list_block'] = "<tr><td width=\"10\"><input type=\"radio\" value=\"#bs_id#\" name=\"bs_id\"/></td><td class=\"TdListLogoALignCenter\">#ct_name#</td><td>#ct_adress#</td></tr>";

?>