<?php
$f = new dateClass();
#	формирование таблици контенка
for($i = 0; $i < count ( $catalogData ); $i ++) {
	$img 	= '';
	$date 	= '';
	$tRclass = "";
	if ($i % 2 != 0)
		$tRclass = "class=random";
	if($catalogData[$i]['ct_photo_id']) 
		$img = "<img src=\"../../files/images/ct_photos/sm_{$catalogData[$i]['ct_photo_id']}.{$catalogData[$i]['ct_photo_file_type']}\" width=\"100\"/>";
			
	$hide 	= $CMSImagesNum[$catalogData[$i]['hide']];
	$date = $f-> GetPeapleDateView($catalogData[$i]['date']);
		
	$pagesReturn .= "<tr {$tRclass}>";
	$pagesReturn .= "<td><input type=\"radio\" value=\"{$catalogData[$i]['ct_id']}\" name=\"ct_id\"/></td>";
	$pagesReturn .= "<td>{$catalogData[$i]['ct_id']}</td>";
	$pagesReturn .= "<td>{$img}</td>";
	$pagesReturn .= "<td>{$catalogData[$i]['ct_name']}</td>";
	$pagesReturn .= "<td>{$catalogData[$i]['ct_title']}</td>";
	$pagesReturn .= "<td>{$date}</td>";
	$pagesReturn .= "<td>{$catalogData[$i]['pos']}</td>";
	$pagesReturn .= "<td>{$hide}</td>";
	$pagesReturn .= "<td>{$dictionaries->buld_table[$catalogData[$i]['dict_id']]['dict_name']}</td>";
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
		<td width=100>Изображение</td>
		<td>Название</td>
		<td>Заголовок</td>
		<td width=150>Дата добавления</td>
		<td width=80>Позиция</td>
		<td width=80>Активность</td>
		<td width=150>Тип</td>
	</tr>
		<?php
		echo $pagesReturn;
		?>
	</table>