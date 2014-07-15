<?php
#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = $_COOKIE[lang_id] AND sd_id={$_COOKIE[sd_id]}" );

#	задаем айди значение справочника новостей
$dictionaries->do_dictionaries ( 19 );
#	my_list_dct - сам словарь
$cartype_lst = $dictionaries->my_list_dct;
#	перечень значение словаря новостей
$new_dct_arr = $dictionaries->my_dct;
#	родитель, ребенок формирование массива
$new_dct_value = $dictionaries->BuildArrayParentChild ( $new_dct_arr );

#	
// $_GET['dict'] = $new_dct_arr[0]['dict_id'];


$PrintCatalog = new catalogClass ( $new_dct_arr, $dictionaries->buld_table, 'dict_name', 'dict_id', 'parent_id', '/production' );
$PrintCatalog->get_arr_formation ( true );
$Formation ['query_position'] = $PrintCatalog->get_select ( 'dict_id' );
$Formation ['catalog_menu'] = $PrintCatalog->get_tree_view_menu ();
$Formation ['catalog_menu'] = "<ul id=\"navigation\">{$Formation[catalog_menu]}</ul>";

echo $Formation ['catalog_menu'];
?>
<script type="text/javascript">
$(document).ready(function(){
	// ---- TREE -----
	$("#navigation").treeview({
	  persist: "location",
	  collapsed: true,
	  unique: false,
	  activelink: "<?php
			echo $_SERVER ['REQUEST_URI'];
			?>"
	});
});
</script>