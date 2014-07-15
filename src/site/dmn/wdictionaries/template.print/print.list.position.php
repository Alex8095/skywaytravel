<?php
#объявляем класс словаря
$dictionaries = new dictionariesClass ( );
#формируем массив имени словарей
$dct_list = $dictionaries->buid_dictionaries_list ( $tbl_list_dictionaries );
#формируем массив значений словарей
$dct = $dictionaries->buid_dictionaries ( $tbl_dictionaries, "WHERE lang_id = {$lang_id} ORDER BY dict_name" );

#	формирование таблици контенка
for($i = 0; $i < count ( $TablePosition ); $i ++) {
	$menuWords = $TablePosition [$i] [dict_name];
	$ldName = $cl_sel_pages->buld_table [$TablePosition [$i] [ld_id]] [ld_name];
	$parentId = $dictionaries->buld_table [$TablePosition [$i] [parent_id]] ['dict_name'];
	$code = $TablePosition [$i] [dict_code];
	$hideShow = $TablePosition [$i] [hide];
	
	$tRclass = "";
	if ($i % 2 != 0)
		$tRclass = "class=random";
	
	$pagesReturn .= "<tr {$tRclass}>";
	$pagesReturn .= "<td><input type=\"radio\" value=\"{$TablePosition[$i][dict_id]}\" name=\"dict_id\"/></td>";
	$pagesReturn .= "<td>{$TablePosition[$i][dict_id]}</td>";
	$pagesReturn .= "<td>{$menuWords}</td>";
	$pagesReturn .= "<td>{$code}</td>";
	$pagesReturn .= "<td>{$parentId}</td>";
	$pagesReturn .= "<td>{$ldName}</td>";
	$pagesReturn .= "</tr>";
}
	$pagesReturn .=	"<input value=\"".substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI']))."\" name=\"requery_id\" type=\"hidden\" >";

?>
<script type="text/javascript">
 DD_roundies.addRule('#d-dialog-in', '10px', true);
 DD_roundies.addRule('.t-dialog', '10px', true);
</script>

<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10></td>
		<td width=50>ID</td>
		<td>Название</td>
		<td width=100>Код</td>
		<td width=30>Родитель</td>
		<td width=160>Cловарь</td>
	</tr>
		<?php
		if ($TablePosition)
			echo $pagesReturn;
		?>
	</table>
<?php
if (! $TablePosition)
	echo "Нет позиций";
?>
		