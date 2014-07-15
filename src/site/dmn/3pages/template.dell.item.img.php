<?php
require_once '../utils/template.ajax/js.css.php';

$cl_photo_class = new mysql_select ( $tbl_cph );
$ImPhotoFileType = $cl_photo_class->select_table_id ( "WHERE cp_photo_id = '{$_POST[cp_photo_id]}'" );

$query = "DELETE FROM $tbl_cph WHERE cp_photo_id = '{$_POST[cp_photo_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении IMAGE" );

$arr_update = array ("cp_image" => "''" );
$cl_page_update = new mysql_select ( $tbl_cp );
$cl_page_update->update_table ( "WHERE cp_image = '{$_POST[cp_photo_id]}.{$ImPhotoFileType[cp_file_type]}'", $arr_update );

if (file_exists ( "../../files/images/cp/" . $_POST [cp_photo_id] . "." . $ImPhotoFileType [cp_file_type] ))
	@unlink ( "../../files/images/cp/" . $_POST [cp_photo_id] . "." . $ImPhotoFileType [cp_file_type] );
if (file_exists ( "../../files/images/cp/sm_" . $_POST [cp_photo_id] . "." . $ImPhotoFileType [cp_file_type] ))
	@unlink ( "../../files/images/cp/sm_" . $_POST [cp_photo_id] . "." . $ImPhotoFileType [cp_file_type] );

?>
<script type="text/javascript">
	$('#DivRequestImg').load('template.add/form.add.img.php?cp_id=<?php
	echo $_GET ['cp_id'];
	?>');
</script>
