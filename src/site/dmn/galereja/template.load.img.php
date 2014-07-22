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
require_once ("template/template.inc");

#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries, "ORDER BY ld_name ASC" );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$_COOKIE[lang_id]}", "ORDER BY dict_name ASC" );
if ($_GET ['ct_id']) {
	$cl_photo_class = new mysql_select ( $tbl_ct_photos);
	$cl_photo_class->select_table_query ( "select ct.* , d.dict_name from {$tbl_ct_photos}  ct
										   left join {$tbl_dictionaries} d on d.dict_id  = ct.ct_photo_type_id 
										   where ct.ct_id = '{$_GET ['ct_id']}' and ct.lang_id = {$_COOKIE[lang_id]} and d.lang_id = {$_COOKIE[lang_id]}
										   order by ct.ct_photo_order" );
}
else die("no catalog position");
?>
 
<?php if($cl_photo_class->table):?>
	<table class="table-list">
	<tr class="headings">
		<td></td>
		<td>Изображение</td>
		<td>Тип</td>
		<td>Позиция</td>
	</tr>
		<?php foreach ($cl_photo_class->table as $key => $value):?>
		<tr>
			<td width="10"><input type="radio" value="<?php echo $value["ct_photo_id"]?>" name="ct_photo_id"/></td>
			<td class="TdListLogoALignCenter"><img width="80" src="../../files/images/ct_photos/<?php echo $value["ct_photo_id"]?>.<?php echo $value["ct_photo_file_type"]?>" width="100" alt="" title=""></td>
			<td><?php echo $value["dict_name"]?></td>
			<td><?php echo $value["ct_photo_order"]?></td>
		</tr>
		<?php endforeach;?>
	</table>
<?php endif;?>