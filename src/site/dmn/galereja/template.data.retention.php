<?php
define ( 'DOC_ROOT', $_SERVER ['DOCUMENT_ROOT'] );
require_once ("../../config/config.php");
//require_once("../utils/security_mod.php");
require_once ("../../config/class.inc");
require_once ("../../dmn/utils/db_tables.inc");
// require_once("../utils/template.ajax/JSON.php");
require_once '../utils/functions/f.encodestring.php';

$log = new LoggerClass ( DOC_ROOT . '/files/logs/site/' );

$json_converter = new Services_JSON ( );
$response = array ();
$response ['success'] = false;
$response ['fieldErrors'] = array ();

$fileDir = '../../files/images/ct_photos/';
$ImgPropLogo ['ImgW'] = 250;
$ImgPropLogo ['ImgH'] = 250;
$ImgProp ['ImgW'] = 250;
$ImgProp ['ImgH'] = 250;

$ImgPropBig ['ImgW'] = 800;
$ImgPropBig ['ImgH'] = 600;

#
if ($_POST ['retention'] == 'edit_cat') {
	try {
		$_POST ['ct_title'] = mysql_escape_string ( $_POST ['ct_title'] );
		$_POST ['ct_url'] = ($_POST ['ct_url'] ? $_POST ['ct_url'] : translitStrlover($_POST ['ct_title']));
		$_POST ['hide'] = ($_POST ['hide'] ? $_POST ['hide'] : 'NULL');
		$arr_update = array ("parent_id" => "'{$_POST[parent_id]}',", "ct_name" => "'{$_POST[ct_name]}',", "ct_url" => "'{$_POST[ct_url]}',", "ct_w_keywords" => "'{$_POST[ct_w_keywords]}',", "ct_w_description" => "'{$_POST[ct_w_description]}',", "ct_title" => "'{$_POST[ct_title]}',", "ct_text" => "'{$_POST[ct_text]}',", "dict_id" => "'{$_POST[dict_id]}',", "hide" => "{$_POST[hide]},", "pos" => "{$_POST[pos]}" );
		$cl_page_update = new mysql_select ( $tbl_catalog );
		$cl_page_update->update_table ( "WHERE ct_id = '{$_POST[ct_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );
		$response ['success'] = true;
		//print_r($arr_update);

		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

#
if ($_POST ['retention'] == 'add_cat') {
	try {
		$_POST ['ct_id'] = ($_POST ['ct_id'] ? $_POST ['ct_id'] : uniqid ());
		$_POST ['hide'] = ($_POST ['hide'] ? $_POST ['hide'] : 'NULL');

		$_POST['ct_url'] = translitStrlover($_POST['ct_name']);

		$cl_sel_pages = new mysql_select ( $tbl_catalog );
		$ParentData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and ct_id ='{$_POST[parent_id]}'" );

		if(empty($_POST["pos"])) {
			$cl_sel_pages = new mysql_select ( $tbl_catalog );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and dict_id ='{$_POST[dict_id]}' and parent_id ='{$_POST[parent_id]}' order by pos desc" );
			 $_POST["pos"] = $PosData["pos"] + 1;
		}
		
		

		$level = $ParentData["ct_level"] + 1;
		$_POST['ct_id'] = $_POST['ct_id'] ? uniqid() : uniqid();
		
		$query = "INSERT INTO
		{$tbl_catalog}
						SET
							ct_id 			= '{$_POST['ct_id']}',
							parent_id  		= '{$_POST['parent_id']}',
							hide  			= {$_POST['hide']},
							ct_name			= '{$_POST['ct_name']}',
							ct_title		= '{$_POST['ct_title']}',
							dict_id			= '{$_POST['dict_id']}',
							ct_url			= '{$_POST['ct_url']}',
							lang_id			= 1,
							ct_level		= {$level},
							date			= NOW(),
							pos				= {$_POST['pos']},
							ct_text			= '{$_POST['ct_text']}',
							ct_w_title		= '{$_POST['ct_w_title']}',
							ct_w_keywords	= '{$_POST['ct_w_keywords']}',
							ct_w_description	= '{$_POST['ct_w_description']}';";
		if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		$query = "INSERT INTO
		{$tbl_catalog}
						SET
							ct_id 			= '{$_POST['ct_id']}',
							parent_id  		= '{$_POST['parent_id']}',
							hide  			= {$_POST['hide']},
							ct_name			= '{$_POST['ct_name']}',
							ct_title		= '{$_POST['ct_title']}',
							dict_id			= '{$_POST['dict_id']}',
							ct_url			= '{$_POST['ct_url']}',
							lang_id			= 2,
							ct_level		= {$level},
							date			= NOW(),
							pos				= {$_POST['pos']},
							ct_text			= '{$_POST['ct_text']}',
							ct_w_title		= '{$_POST['ct_w_title']}',
							ct_w_keywords	= '{$_POST['ct_w_keywords']}',
							ct_w_description	= '{$_POST['ct_w_description']}';";
			
		if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		$query = "INSERT INTO
		{$tbl_catalog}
						SET
							ct_id 			= '{$_POST['ct_id']}',
							parent_id  		= '{$_POST['parent_id']}',
							hide  			= {$_POST['hide']},
							ct_name			= '{$_POST['ct_name']}',
							ct_title		= '{$_POST['ct_title']}',
							dict_id			= '{$_POST['dict_id']}',
							ct_url			= '{$_POST['ct_url']}',
							lang_id			= 3,
							ct_level		= {$level},
							date			= NOW(),
							pos				= {$_POST['pos']},
							ct_text			= '{$_POST['ct_text']}',
							ct_w_title		= '{$_POST['ct_w_title']}',
							ct_w_keywords	= '{$_POST['ct_w_keywords']}',
							ct_w_description	= '{$_POST['ct_w_description']}';";
			
		if (! mysql_query ( $query ))
		throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		$response ['success'] = "testststst";
		header ( 'Content-type: text/plain' );
		echo $json_converter->encode ( $response );
	} catch ( ExceptionMySQL $exc ) {
		echo ExceptionFullGet::ExcMysqlN ( $exc );
		$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
	}
}

if ($_POST ['retention'] == 'edit_position_page') {
	#
	$arr_update = array ("ld_id" => "'{$_POST[ld_id]}',", "dict_code" => "'{$_POST[dict_code]}',", "dict_name" => "'{$_POST[dict_name]}',", "parent_id" => "'{$_POST[parent_id]}'" );

	#
	$cl_page_update = new mysql_select ( $tbl_dictionaries );
	$cl_page_update->update_table ( "WHERE dict_id = '{$_POST[dict_id]}' AND lang_id = {$_COOKIE[lang_id]}", $arr_update );

	$response ['success'] = true;
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );

}

if ($_POST ['retention'] == 'add_position_page') {
	$_POST ['dict_code'] = mysql_escape_string ( $_POST ['dict_code'] ? $_POST ['dict_code'] : substr ( translit ( $_POST [dict_name] ), 0, 11 ) );
	//$_POST['dict_code'] = addslashes($_POST['dict_code']);
	$_POST ['dict_id'] = ($_POST ['dict_id'] ? $_POST ['dict_id'] : uniqid ());
	if ($_COOKIE ['lang_id'] == 1) {
		$lang_f = 2;
		$lang_t = 3;
	}
	if ($_COOKIE ['lang_id'] == 2) {
		$lang_f = 1;
		$lang_t = 3;
	}

	$query = "INSERT INTO $tbl_dictionaries
						 VALUES ('{$_POST[dict_id]}',
								 '{$_POST[ld_id]}',
								 '{$_COOKIE[lang_id]}',
								 '{$_POST[dict_code]}',
								 '{$_POST[dict_name]}',
								 '{$_POST[parent_id]}',
								 0);";

	if (! mysql_query ( $query ))
	throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );

	$response ['success'] = "testststst";
	header ( 'Content-type: text/plain' );
	echo $json_converter->encode ( $response );
}

if ($_POST ['retention'] == 'add_img') {
	$photoId = uniqid ();
	$extension = pathinfo ( $_FILES ['images'] ['name'] );
	$extension = strtolower($extension ['extension']);
	$fileName = strtolower ( $photoId . "." . $extension );
	$is_main = 'NULL';
	if ($_POST ['new_position'])
	$is_main = 1;
	if ($_FILES ['images']) {
		if (copy ( $_FILES ['images'] ['tmp_name'], $fileDir . '' . $fileName )) {
//			// *** 1) Initialise / load image
//			$resizeObj = new resize ( $fileDir . "" . $fileName );
//			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
//			$resizeObj->resizeImage ( $ImgPropLogo ['ImgW'], $ImgPropLogo ['ImgH'], 'crop' );
//			// *** 3) Save image
//			$resizeObj->saveImage ( $fileDir . 'sm_' . $fileName, 100 );
//			// *** 1) Initialise / load image
//			$resizeObj = new resize ( $fileDir . "" . $fileName );
//			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
//			$resizeObj->resizeImage ( $ImgPropBig ['ImgW'], $ImgPropBig ['ImgH'], 'crop' );
//			// *** 3) Save image
//			$resizeObj->saveImage ( $fileDir . $fileName, 100 );
			//
			$cl_cat_ph_sel = new mysql_select ( $tbl_ct_photos );
			$pos = $cl_cat_ph_sel->select_table_id ( "where ct_id = '{$_POST['ct_id']}' order by ct_photo_order desc limit 1" );
			$_POST ['ct_photo_order'] = ($_POST ['ct_photo_order'] ? $_POST ['ct_photo_order'] : $pos ['ct_photo_order'] + 1);
		}
		//
		try {
			$query = "INSERT INTO
			{$tbl_ct_photos}
							SET
								ct_photo_id 			= '{$photoId}',
								ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
								ct_id 					= '{$_POST[ct_id]}',
								ct_photo_order			= {$_POST['ct_photo_order']},
								ct_photo_file_type		= '{$extension}',
								is_main					= {$is_main},
								lang_id					= 1";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
			$query = "INSERT INTO
			{$tbl_ct_photos}
							SET
								ct_photo_id 			= '{$photoId}',
								ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
								ct_id 					= '{$_POST[ct_id]}',
								ct_photo_order			= {$_POST['ct_photo_order']},
								ct_photo_file_type		= '{$extension}',
								is_main					= {$is_main},
								lang_id					= 2;";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
			$query = "INSERT INTO
			{$tbl_ct_photos}
							SET
								ct_photo_id 			= '{$photoId}',
								ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
								ct_id 					= '{$_POST[ct_id]}',
								ct_photo_order			= {$_POST['ct_photo_order']},
								ct_photo_file_type		= '{$extension}',
								is_main					= {$is_main},
								lang_id					= 3;";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
		}
		catch ( ExceptionMySQL $exc ) {
			echo ExceptionFullGet::ExcMysqlN ( $exc );
			//$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
		}
	} else
	die ( 'no file copy' );
	exit ();
}

if ($_POST ['retention'] == 'add_img_gal') {
	$photoId = uniqid ();
	$extension = pathinfo ( $_FILES ['images'] ['name'] );
	$extension = strtolower($extension ['extension']);
	$fileName = strtolower ( $photoId . "." . $extension );
	//если есть файл копируем
	if ($_FILES ['images'])
	if (copy ( $_FILES ['images'] ['tmp_name'], $fileDir . '' . $fileName )) {
		//если не указана позиция, получаем
		if (empty ( $_POST ['ct_photo_order'] )) {
			$cl_cat_ph_sel = new mysql_select ( $tbl_ct_photos );
			$pos = $cl_cat_ph_sel->select_table_id ( "where ct_id = '{$_POST['ct_id']}' order by ct_photo_order desc" );
			$_POST ['ct_photo_order'] = $pos ['ct_photo_order'] + 1;
		}
		//в зависимости от типа изобр. делаем настройки
		$is_main = 'NULL';
		if ($_POST ['ct_photo_type_id'] == '4d05c24dc8477') {
			$ImgProp ['ImgW'] = $ImgPropLogo ['ImgW'];
			$ImgProp ['ImgH'] = $ImgPropLogo ['ImgH'];
			$is_main = 1;
			$_POST ['ct_photo_order'] = 'NULL';
			//
			try {
				$query = "DELETE FROM {$tbl_ct_photos} WHERE ct_id = '{$_POST[ct_id]}' and is_main = 1";
				if (! mysql_query ( $query ))
				throw new ExceptionMySQL ( mysql_error (), $query, "Ошибка при удалении img" );
			} catch ( ExceptionMySQL $exc ) {
				echo ExceptionFullGet::ExcMysqlN ( $exc );
				//$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
			}
				
		}
			
		//если вклчено уменшение делаем
		if (isset ( $_POST ['is_small'] )) {
			// *** 1) Initialise / load image
			$resizeObj = new resizeImageClass ( $fileDir . "" . $fileName );
			// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
			$resizeObj->resizeImage ( $ImgPropLogo ['ImgW'], $ImgPropLogo ['ImgH'], 'crop' );
			// *** 3) Save image
			$resizeObj->saveImage ( $fileDir . 'sm_' . $fileName, 100 );
			//
		} else {
			copy ( $_FILES ['images'] ['tmp_name'], $fileDir . 'sm_' . $fileName );
		}
			
//		// *** 1) Initialise / load image
//		$resizeObj = new resize ( $fileDir . "" . $fileName );
//		// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
//		$resizeObj->resizeImage ( $ImgPropBig ['ImgW'], $ImgPropBig ['ImgH'], 'crop' );
//		// *** 3) Save image
//		$resizeObj->saveImage ( $fileDir . $fileName, 100 );
			
		//записываем в БД
		try {
			$query = "INSERT INTO
			{$tbl_ct_photos}
								SET
									ct_photo_id 			= '{$photoId}',
									ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
									ct_id 					= '{$_POST[ct_id]}',
									ct_photo_order			= {$_POST['ct_photo_order']},
									ct_photo_file_type		= '{$extension}',
									is_main					= {$is_main},
									lang_id					= 1";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
			$query = "INSERT INTO
			{$tbl_ct_photos}
								SET
									ct_photo_id 			= '{$photoId}',
									ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
									ct_id 					= '{$_POST[ct_id]}',
									ct_photo_order			= {$_POST['ct_photo_order']},
									ct_photo_file_type		= '{$extension}',
									is_main					= {$is_main},
									lang_id					= 2;";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
			$query = "INSERT INTO
			{$tbl_ct_photos}
								SET
									ct_photo_id 			= '{$photoId}',
									ct_photo_type_id  		= '{$_POST[ct_photo_type_id]}',
									ct_id 					= '{$_POST[ct_id]}',
									ct_photo_order			= {$_POST['ct_photo_order']},
									ct_photo_file_type		= '{$extension}',
									is_main					= {$is_main},
									lang_id					= 3;";
			if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT CP PHOTO" );
		} catch ( ExceptionMySQL $exc ) {
			echo ExceptionFullGet::ExcMysqlN ( $exc );
			//$log->writeln ( ExceptionFullGet::ExcMysqlN ( $exc ) );
		}
	}
	exit ();
}
?>
