<?php
class DMN_Catalog extends Controller {
	public $dictionaries;

	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "news", "" );
		$Data->select_table_query ( "select n.* from news n
								     where n.lang_id = {$_COOKIE[lang_id]} order by n.news_date desc", "id" );
		//
		$tListData = $this->Template ( "/dmn/news/template/list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/news/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData,"tAction" => $tAction ) );
	}

	public function save($array) {
		$provider = new catalogProviderClass ( 'catalog' );
		if ($array ['type_save'] == "new") {
			$ct_id = $provider->InsertNewCatalogItem ( $array );
			$return ['callbackArgs'] ["newActionID"] = $ct_id;
			$return ['success'] = true;
		} else {
			$_POST ['ct_url'] = strtolower ( $_POST ['ct_url'] ? $_POST ['ct_url'] : translitStrlover ( ($_POST ['ct_name'] ? $_POST ['ct_name'] : $_POST ['ct_title']) ) );
			$_POST ['hide'] = ($_POST ['hide'] ? $_POST ['hide'] : 'NULL');
			$arr_update = array (
					"parent_id" => "'{$_POST[parent_id]}',",
					"ct_name" => "'" . mysql_real_escape_string ( $_POST [ct_name] ) . "',",
					"ct_url" => "'" . mysql_real_escape_string ( $_POST [ct_url] ) . "',",
					"ct_w_title" => "'" . mysql_real_escape_string ( $_POST [ct_w_title] ) . "',",
					"ct_w_keywords" => "'" . mysql_real_escape_string ( $_POST [ct_w_keywords] ) . "',",
					"ct_w_description" => "'" . mysql_real_escape_string ( $_POST [ct_w_description] ) . "',",
					"ct_title" => "'" . mysql_real_escape_string ( $_POST [ct_title] ) . "',",
					"ct_description" => "'" . mysql_real_escape_string ( $_POST [ct_description] ) . "',",
					"ct_text" => "'" . mysql_real_escape_string ( $_POST [ct_text] ) . "',",
					"dict_id" => "'{$_POST[dict_id]}',",
					"hide" => "{$_POST[hide]},",
					"pos" => "{$_POST[pos]}" );
			$Data = new mysql_select ( "catalog" );
			$Data->update_table ( "WHERE ct_id = '{$array['ct_id']}' and lang_id = {$_COOKIE['lang_id']}", $arr_update );
			$return ['success'] = true;
		}
		return $return;
	}

	public function saveOneImage($array) {
		$image = $this->saveFile ( "ct_photos", $array ['is_small'] == ("false" ? false : true) );
		$provider = new catalogProviderClass ( 'catalog' );
		$array ['ct_photo_id'] = $image ['ct_photo_id'];
		$array ['ct_photo_file_type'] = $image ['ct_photo_file_type'];
		$provider->deleteImageForType ( $array ['ct_id'], $array ['ct_photo_type_id'] );
		if ($array ['ct_photo_id'])
			$provider->insertImage ( $array );
		$folder = ($array ['folder'] ? $array ['folder'] : "ct_photos");
		echo "<img src=\"/files/images/{$folder}/{$array['ct_photo_id']}.{$array['ct_photo_file_type']}\" width=\"100\" />";
	}

	public function saveGalleryOneImage($array) {
		
		// print_r($array);
		$image = $this->saveFile ( ($array ['folder'] ? $array ['folder'] : "ct_photos"), $array ['is_small'] == ("false" ? false : true) );
		$provider = new catalogProviderClass ( 'catalog' );
		$array ['ct_photo_id'] = $image ['ct_photo_id'];
		$array ['ct_photo_file_type'] = $image ['ct_photo_file_type'];
		$provider->deleteImageForType ( $array ['ct_id'], $array ['ct_photo_type_id'] );
		if ($array ['ct_photo_id'])
			$provider->insertImage ( $array );
		$folder = ($array ['folder'] ? $array ['folder'] : "ct_photos");
		$this->callback($array);
		echo $this->getGallery ( $array );
	}

	public function callback($array) {
		if ($array ["callback"] && $array ["ct_photo_type_id"] == "4d05c24dc8477") {
			$array ["callback"] = str_replace ( "'", '"', $array ["callback"] );
			$callback = json_decode ( $array ["callback"] );
			$className = $callback->nameClass;
			$nameMethod = $callback->nameMethod;
			$object = new $className ();
			$params = array ("ct_id" => $array ["ct_id"],"image" => sprintf ( "%s.%s", $array ['ct_photo_id'], $array ['ct_photo_file_type'] ) );
			call_user_func_array ( array ($object,$nameMethod ), $params );
		}
	}

	public function saveGalleryImage($array) {
		$image = $this->saveFile ( ($array ['folder'] ? $array ['folder'] : "ct_photos"), $array ['is_small'] == ("false" ? false : true) );
		$provider = new catalogProviderClass ( 'catalog' );
		$array ['ct_photo_id'] = $image ['ct_photo_id'];
		$array ['ct_photo_file_type'] = $image ['ct_photo_file_type'];
		if ($array ['ct_photo_id'])
			$provider->insertImage ( $array );
		$this->callback($array);
		$folder = ($array ['folder'] ? $array ['folder'] : "ct_photos");
		echo $this->getGallery ( $array );
	}

	public function getGallery($array) {
		if (! $this->dictionaries)
			$this->getDictionaris ();
		$provider = new catalogProviderClass ( 'catalog' );
		$provider->GetCatalogItemImages ( array ("ct_id" => $array ["ct_id"] ) );
		return Controller::Template ( "/dmn/catalog/template/listphotos.phtml", array ('Data' => $provider->resTable,'folder' => ($array ['folder'] ? $array ['folder'] : "ct_photos") ) );
	}

	public function saveImage($array) {
		// ct_photo_type_id
		$ga_img = $this->saveFile ();
		$arr_update = array ("ga_img" => "'{$ga_img}'" );
		$Data = new mysql_select ( "goods_action" );
		$Data->update_table ( "WHERE ga_id = {$array['ga_id']}", $arr_update );
	}

	public function delete($array) {
		mysql_query ( "delete from shop_info where ct_id= '{$array['id']}'" );
		mysql_query ( "delete from catalog where ct_id= '{$array['id']}'" );
		mysql_query ( "delete from ct_photos where ct_id= '{$array['id']}'" );
		$return ['conf'] = "DMN_Catalog";
		$return ['success'] = true;
		return $return;
	}

	public function saveGalleryImages($array) {
		$i = 0;
		foreach ( $_FILES as $key => $value ) {
			if (! empty ( $value ['name'] )) {
				$_FILES ["image"] = $value;
				// echo "<pre>";
				// print_r($array);
				// echo "</pre>";
				$image = $this->saveFile ( ($array ['folder'] ? $array ['folder'] : "ct_photos"), $array ['is_small'] == false, true );
				$provider = new catalogProviderClass ( 'catalog' );
				$array ['ct_photo_id'] = $image ['ct_photo_id'];
				$array ['ct_photo_file_type'] = $image ['ct_photo_file_type'];
				if ($array ['ct_photo_id']) {
					$array ['ct_photo_title'] = ($i == 0 ? $array ['ct_photos_en'] : $array [sprintf ( 'ct_photos_en-%s', $i )]);
					$provider->insertImageLang ( $array, 1 );
					$array ['ct_photo_title'] = ($i == 0 ? $array ['ct_photos_ru'] : $array [sprintf ( 'ct_photos_ru-%s', $i )]);
					$provider->insertImageLang ( $array, 2 );
					$provider->insertImageLang ( $array, 3 );
				}
			}
			$i = $i + 1;
		}
		$provider = new catalogProviderClass ( 'catalog' );
		$provider->GetCatalogItemImages ( array ("ct_id" => $array ["ct_id"],"ph_dict_id" => $array ['ct_photo_type_id'] ) );
		echo Controller::Template ( "/dmn/news/template/gallerylistphotos.php", array ('Data' => $provider->resTable,'folder' => ($array ['folder'] ? $array ['folder'] : "ct_photos") ) );
	}

	public function changeImageTitle($array) {
		$arr_update = array ('ct_photo_title' => "'{$array['field_value']}'" );
		$Data = new mysql_select ( "ct_photos" );
		$Data->update_table ( "WHERE ct_photo_id = '{$array['field_id']}' and lang_id = {$_COOKIE['lang_id']}", $arr_update );
		$return ['success'] = true;
		return $return;
	}

	public function saveFile($folder = "ct_photos", $is_small = true, $is_big_small = false) {
		$fileName = "";
		if ($_FILES ["image"]) {
			$fileDir = $_SERVER ['DOCUMENT_ROOT'] . '/files/images/' . $folder . '/';
			$ImgPropBig ['ImgW'] = 250;
			$ImgPropBig ['ImgH'] = 250;
			$ImgPropBigSmall ['ImgW'] = 800;
			$ImgPropBigSmall ['ImgH'] = 600;
			$photoId = uniqid ();
			$extension = pathinfo ( $_FILES ['image'] ['name'] );
			$extension = strtolower ( $extension ['extension'] );
			$fileName = strtolower ( $photoId . "." . $extension );
			if (copy ( $_FILES ['image'] ['tmp_name'], $fileDir . '' . $fileName )) {
				if ($is_small) {
					// *** 1) Initialise / load image
					$resizeObj = new resize ( $fileDir . "" . $fileName );
					// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj->resizeImage ( $ImgPropBig ['ImgW'], $ImgPropBig ['ImgH'], ($is_big_small ? 'auto' : 'crop') );
					// *** 3) Save image
					$resizeObj->saveImage ( $fileDir . "sm_" . $fileName, 100 );
				} else
					copy ( $_FILES ['image'] ['tmp_name'], $fileDir . 'sm_' . $fileName );
				if ($is_big_small) {
					// *** 1) Initialise / load image
					$resizeObj = new resize ( $fileDir . "" . $fileName );
					// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					$resizeObj->resizeImage ( $ImgPropBigSmall ['ImgW'], $ImgPropBigSmall ['ImgH'], 'auto' );
					// *** 3) Save image
					$resizeObj->saveImage ( $fileDir . $fileName, 100 );
				}
			}
		}
		return array ('ct_photo_id' => $photoId,'ct_photo_file_type' => $extension );
	}

	public function deleteImage($array) {
		$provider = new catalogProviderClass ( 'catalog' );
		$provider->deleteImage ( $array ["id"] );
		
		$return ['success'] = true;
		return $return;
	}

	public function getDictionaris() {
		// бъявляем класс словаря
		$this->dictionaries = new dictionariesClass ();
		// ормируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		// ормируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}

}
?>