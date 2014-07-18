<?php
class DMN_Tours extends Controller {
	public $dictionaries;
	
	/* SPECIAL CODE */
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "news", "" );
		$Data->select_table_query ( "select n.*, ci.ct_photo_id, ci.ct_photo_file_type from news n 
									 left join ct_photos ci on ci.ct_id = n.news_id and ci.is_main = 1 and ci.lang_id={$_COOKIE['lang_id']}
								     where n.lang_id = {$_COOKIE[lang_id]} order by n.pos desc", "id" );
		//
		$tListData = $this->Template ( "/dmn/tours/template/list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/tours/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData,"tAction" => $tAction ) );
	}
	// public function getList($array) {
	// $return = array ();
	// $Data = new mysql_select ( "news", " where n.lang_id = {$_COOKIE[lang_id]} by n.news_date desc" );
	// $Data->select_table ( "id" );
	// return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	// }
	public function getNews($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 12 );
		$newsTypeDict = $this->dictionaries->my_dct;
		
		//
		$NewsData = NULL;
		$NewsImageData = NULL;
		if (isset ( $array ["id"] )) {
			$Data = new mysql_select ( "news" );
			$NewsData = $Data->select_table_id ( "where news_id = '{$array['id']}' and lang_id={$_COOKIE['lang_id']}" );
			$catalogProvider = new catalogProviderClass ( 'catalog' );
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"],"ph_dicts_id" => "'4fba172ec899c', '4fba176e2cec2'" ) );
			$NewsImageData = $catalogProvider->resTable;
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"],"ph_dict_id" => "4fbb5273dc1e5" ) );
			$GalleryData = $catalogProvider->resTable;
		}
		return $this->Template ( "/dmn/news/template/news_form.phtml", array ('NewsData' => $NewsData,"newsTypeDict" => $newsTypeDict,"ImageData" => $NewsImageData,"GalleryData" => $GalleryData ) );
	}

	public function saveNews($array) {
		if ($array ['type_save'] == "new") {
			$newsId = uniqid ();
			$cl_sel_pages = new mysql_select ( 'news' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE type_id = '{$array[type_id]}' order by pos desc" );
			$array ["pos"] = $PosData ["pos"] + 1;
			$sql = "insert into news (lang_id, news_id, news_title, news_description, news_summary, news_date, hide, type_id, is_show_index, news_send, news_url, news_w_title, news_w_description, news_w_keywords, pos) 
					values(1, '$newsId', '" . mysql_real_escape_string ( $array [news_title] ) . "', '" . mysql_real_escape_string ( $array [news_description] ) . "', '" . mysql_real_escape_string ( $array [news_summary] ) . "', NOW(), '" . ($array ['hide'] ? "show" : "hide") . "', '$array[type_id]', " . ($array ['hide'] ? "1" : "0") . ", 'new', '" . mysql_real_escape_string ( $array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] ) ) . "', '" . mysql_real_escape_string ( $array [news_w_title] ) . "', '" . mysql_real_escape_string ( $array [news_w_description] ) . "', '" . mysql_real_escape_string ( $array [news_w_keywords] ) . "', " . ($array ['pos'] ? $array ['pos'] : "null") . "),
					(2, '$newsId', '" . mysql_real_escape_string ( $array [news_title] ) . "', '" . mysql_real_escape_string ( $array [news_description] ) . "', '" . mysql_real_escape_string ( $array [news_summary] ) . "', NOW(), '" . ($array ['hide'] ? "show" : "hide") . "', '$array[type_id]', " . ($array ['hide'] ? "1" : "0") . ", 'new', '" . mysql_real_escape_string ( $array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] ) ) . "', '" . mysql_real_escape_string ( $array [news_w_title] ) . "', '" . mysql_real_escape_string ( $array [news_w_description] ) . "', '" . mysql_real_escape_string ( $array [news_w_keywords] ) . "', " . ($array ['pos'] ? $array ['pos'] : "null") . ")";
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['generalError'] = "error {$sql}";
				return $return;
			}
			$return ['callbackArgs'] ["newActionID"] = $newsId;
			$return ['success'] = true;
		} else {
			$arr_update = array (
					"hide" => "'" . ($array ['hide'] ? "show" : "hide") . "',",
					"is_show_index" => ($array ['is_show_index'] ? "1" : "0") . ",",
					"news_description" => "'" . mysql_real_escape_string ( $array ['news_description'] ) . "',",
					"news_summary" => "'" . mysql_real_escape_string ( $array ['news_summary'] ) . "',",
					"news_title" => "'" . $array ['news_title'] . "',",
					"news_url" => "'" . ($array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] )) . "',",
					"news_w_description" => "'" . $array ['news_w_description'] . "',",
					"news_w_keywords" => "'" . $array ['news_w_keywords'] . "',",
					"type_id" => "'" . $array ['type_id'] . "',",
					"news_w_title" => "'" . $array ['news_w_title'] . "',",
					"pos" => ($array ['pos'] ? $array ['pos'] : "null") );
			$Data = new mysql_select ( "news" );
			$Data->update_table ( "WHERE news_id = '{$array['news_id']}' and lang_id={$_COOKIE['lang_id']}", $arr_update );
			$return ['success'] = true;
		}
		return $return;
	}

	public function saveImage($array) {
		$ga_img = $this->saveFile ();
		$arr_update = array ("ga_img" => "'{$ga_img}'" );
		$Data = new mysql_select ( "goods_action" );
		$Data->update_table ( "WHERE ga_id = {$array['ga_id']}", $arr_update );
	}

	public function delete($array) {
		$sql = "delete from news where news_id= '{$array['id']}'";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		return $this->getPage ( array () );
	}

	public function getCatalogData() {
		// производим выборку
		$CatData = new mysql_select ( "catalog", "where lang_id = {$_COOKIE['lang_id']} and dict_id='4d3c421816e39'" );
		$CatData->select_table ( "ct_id" );
		return $CatData;
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