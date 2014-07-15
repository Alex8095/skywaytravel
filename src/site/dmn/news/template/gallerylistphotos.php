<?php if ($Data) : ?>
<form>
	<table class="table-list" cellspacing="0" cellpadding="0" border="0">
		<tr class="headings">
			<td width=50>ID</td>
			<td width=100>Изображение</td>
			<td>Описание</td>
			<td width=150>Тип</td>
			<td width=50></td>
		</tr>
		<tbody>
			<?php foreach ( $Data as $key => $value ) : ?>
			<tr class="image-<?php echo $value["ct_photo_id"]?>">
				<td><?php echo $value["ct_photo_id"]?></td>
				<td><?php if($value["ct_photo_id"]):?><img width="100" src="../../files/images/<?php echo $folder;?>/<?php echo $value["ct_photo_id"]?>.<?php echo $value["ct_photo_file_type"]?>"/><?php endif;?></td>
				<td><input id="textbox-<?php echo $value["ct_photo_id"]; ?>" onchange="TChangeInputValue('DMN_Catalog', 'changeImageTitle', '<?php echo $value["ct_photo_id"]; ?>' );" size="60" name="ct_photo_title" value="<?php echo $value["ct_photo_title"]; ?>"/></td>
				<td><?php echo $value["dict_name"]; ?></td>
				<td width=150><a href="#" onclick="TDeleteImage('DMN_Catalog', 'deleteImage', '<?php echo $value["ct_photo_id"]?>')" title="Удалить">Удалить</a></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table> 
</form>
<?php else: ?>
<b>Ничего не найдено по Вашему запросу!</b>
<?php endif; ?>