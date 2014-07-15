<?php
require_once '../utils/template.ajax/js.css.php';

$query = "DELETE FROM $tbl_ct_photos WHERE im_photo_id = '{$_POST[im_photo_id]}'";
if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении IMAGE" );

/*if (file_exists ( "../../files/images/ct_photos/" . $_POST [im_photo_id] . "." . $ImPhotoFileType [im_file_type] ))
	@unlink ( "../../files/images/ct_photos/" . $_POST [im_photo_id] . "." . $ImPhotoFileType [im_file_type] );
if (file_exists ( "../../files/images/ct_photos/s_" . $_POST [im_photo_id] . "." . $ImPhotoFileType [im_file_type] ))
	@unlink ( "../../files/images/ct_photos/s_" . $_POST [im_photo_id] . "." . $ImPhotoFileType [im_file_type] );
*/
?>
