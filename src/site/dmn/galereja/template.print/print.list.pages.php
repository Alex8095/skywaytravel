<?php
$f = new dateClass();

//echo "<pre>";
//print_r($cl_sel_pages->buld_table);
//echo "</pre>";
//$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]][];
	
#	формирование таблици контенка
for($i = 0; $i < count ( $CH ->ArrFormation ); $i ++) {
	$img 	= '';
	$date 	= '';
	$tRclass = "";
	if ($i % 2 != 0)
		$tRclass = "class=random";
	if($cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_photo_id']) 
		$img = "<img src=\"../../files/images/ct_photos/sm_{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_photo_id']}.{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_photo_file_type']}\" width=\"100\"/>";
			
	$hide 	= $CMSImagesNum[$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['hide']];
	$date = $f-> GetPeapleDateView($cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['date']);
		
	$pagesReturn .= "<tr {$tRclass}>";
	$pagesReturn .= "<td><input type=\"radio\" style=\"margin-left:".($CH ->ArrFormation[$i][2]*10)."px\" value=\"{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_id']}\" name=\"ct_id\"/></td>";
	$pagesReturn .= "<td><span style=\"margin-left:".($CH ->ArrFormation[$i][2]*10)."px\">{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_id']}</span></td>";
	$pagesReturn .= "<td>{$img}</td>";
	$pagesReturn .= "<td>{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_name']}</td>";
	$pagesReturn .= "<td>{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['ct_title']}</td>";
	$pagesReturn .= "<td>{$date}</td>";
	$pagesReturn .= "<td>{$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['pos']}</td>";
	$pagesReturn .= "<td>{$hide}</td>";
	$pagesReturn .= "<td>{$dictionaries->buld_table[$cl_sel_pages->buld_table[$CH ->ArrFormation[$i][0]]['dict_id']]['dict_name']}</td>";
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
	<?php foreach ($catalogData as $key => $value):?>
		<tr class="">
			<td width=10><input type="radio" value="<?php echo $value["ct_id"]?>" name="ct_id"/></td>
			<td width=50><?php echo $value["ct_id"]?></td>
			<td width=100><?php if($value["ct_photo_id"]): ?><img src="../../files/images/ct_photos/sm_<?php echo $value["ct_photo_id"]?>.<?php echo $value["ct_photo_file_type"]?>" width="100"/><?php endif;?></td>
			<td><?php echo $value["ct_name"]?></td>
			<td><?php echo $value["ct_title"]?></td>
			<td width=150><?php echo date("d.m.Y", strtotime($value["date"]))?></td>
			<td width=80><?php echo $value["pos"]?></td>
			<td width=80><?php echo ($value["hide"] ? "Да": "Нет"); ?></td>
			<td width=150><?php echo $dictionaries->buld_table[$value["ct_id"]]['dict_name']?></td>
		</tr>
	<?php endforeach;?>
</table>