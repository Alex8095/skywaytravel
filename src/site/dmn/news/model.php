<?php
class DMN_News extends Controller {
	public $dictionaries;
	
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "news", "" );
		$Data->select_table_query ( "select n.*, ci.ct_photo_id, ci.ct_photo_file_type from news n 
									 left join ct_photos ci on ci.ct_id = n.news_id and ci.is_main = 1 and ci.lang_id={$_COOKIE['lang_id']}
								     where n.lang_id = {$_COOKIE[lang_id]} order by n.pos desc", "id" );
		//
		$tListData = $this->Template ( "/dmn/news/template/list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/news/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	//	public function getList($array) {
	//		$return = array ();
	//		$Data = new mysql_select ( "news", " where n.lang_id = {$_COOKIE[lang_id]} by n.news_date desc" );
	//		$Data->select_table ( "id" );
	//		return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	//	}
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
			$catalogProvider = new CatalogProvider ( 'catalog' );
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"], "ph_dicts_id" => "'4fba172ec899c', '4fba176e2cec2'" ) );
			$NewsImageData =$catalogProvider->resTable;
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"], "ph_dict_id" => "4fbb5273dc1e5" ) );
			$GalleryData =$catalogProvider->resTable;
		}
		return $this->Template ( "/dmn/news/template/news_form.phtml", array ('NewsData' => $NewsData, "newsTypeDict" => $newsTypeDict, "ImageData" => $NewsImageData, "GalleryData" => $GalleryData ) );
	}
	public function saveNews($array) {
		if ($array ['type_save'] == "new") {
			$newsId = uniqid ();
			$cl_sel_pages = new mysql_select ( 'news' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE type_id = '{$array[type_id]}' order by pos desc" );
			$array ["pos"] = $PosData ["pos"] + 1;
			$sql = "insert into news (lang_id, news_id, news_title, news_description, news_summary, news_date, hide, type_id, is_show_index, news_send, news_url, news_w_title, news_w_description, news_w_keywords, pos) 
					values(1, '$newsId', '" . mysql_real_escape_string($array[news_title]) . "', '" . mysql_real_escape_string($array[news_description]) . "', '" . mysql_real_escape_string($array[news_summary]) ."', NOW(), '" . ($array ['hide'] ? "show" : "hide") . "', '$array[type_id]', " . ($array ['hide'] ? "1" : "0") . ", 'new', '" . mysql_real_escape_string($array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] )) . "', '" . mysql_real_escape_string($array[news_w_title]) . "', '" . mysql_real_escape_string($array[news_w_description]) . "', '" . mysql_real_escape_string($array[news_w_keywords]) . "', " . ($array ['pos'] ? $array ['pos'] : "null") . "),
					(2, '$newsId', '" . mysql_real_escape_string($array[news_title]) . "', '" . mysql_real_escape_string($array[news_description]) . "', '" . mysql_real_escape_string($array[news_summary]). "', NOW(), '" . ($array ['hide'] ? "show" : "hide") . "', '$array[type_id]', " . ($array ['hide'] ? "1" : "0") . ", 'new', '" . mysql_real_escape_string($array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] )) . "', '" . mysql_real_escape_string($array[news_w_title]) . "', '" . mysql_real_escape_string($array[news_w_description]) . "', '" . mysql_real_escape_string($array[news_w_keywords]) . "', " . ($array ['pos'] ? $array ['pos'] : "null") . ")";
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['generalError'] = "error {$sql}";
				return $return;
			}
			$return ['callbackArgs'] ["newActionID"] = $newsId;
			$return ['success'] = true;
		} else {
			$arr_update = array ("hide" => "'" . ($array ['hide'] ? "show" : "hide") . "',", "is_show_index" => ($array ['is_show_index'] ? "1" : "0") . ",", "news_description" => "'" . mysql_real_escape_string($array ['news_description']) . "',", "news_summary" => "'" . mysql_real_escape_string($array ['news_summary']) . "',", "news_title" => "'" . $array ['news_title'] . "',", "news_url" => "'" . ($array ['news_url'] ? $array ['news_url'] : translitStrlover ( $array ['news_title'] )) . "',", "news_w_description" => "'" . $array ['news_w_description'] . "',", "news_w_keywords" => "'" . $array ['news_w_keywords'] . "',", "type_id" => "'" . $array ['type_id'] . "',", "news_w_title" => "'" . $array ['news_w_title'] . "',", "pos" => ($array ['pos'] ? $array ['pos'] : "null") );
			$Data = new mysql_select ( "news" );
			$Data->update_table ( "WHERE news_id = '{$array['news_id']}' and lang_id={$_COOKIE['lang_id']}", $arr_update );
			$return ['success'] = true;
		}
		return $return;
	}
	
	public function saveGoodsStores($array) {
		$sql = "delete from goods_stores where ga_id= {$array['ga_id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['generalError'] = "error {$sql}";
			return $return;
		}
		foreach ( $array ["gs_count"] as $key => $value ) {
			if (! empty ( $value )) {
				$sql = "insert into goods_stores(" . ($array ["gs_id"] [$key] == "" ? "" : "gs_id,") . " ga_id, dialer_id, gs_count, gs_name, gs_count_isset, gs_dealer_sc) values(" . ($array [gs_id] [$key] == "" ? "" : $array ["gs_id"] [$key] . ",") . "$array[ga_id], '{$array[dialer_id][$key]}', {$array[gs_count][$key]}, '{$array[gs_name][$key]}', {$array[gs_count][$key]}, '{$array[gs_dealer_sc][$key]}')";
				if (! mysql_query ( $sql )) {
					$return ['success'] = false;
					$return ['generalError'] = "error {$sql}";
					return $return;
				}
			}
		}
		$return ['callbackArgs'] ["newActionID"] = $array ['ga_id'];
		$return ['success'] = true;
		return $return;
	}
	
	public function getTickets($array) {
		$TicketsData = NULL;
		if ($array ["id"]) {
			$Data = new mysql_select ( "goods_action" );
			$GoodsActionData = $Data->select_table_id ( "where ga_id = {$array['id']}" );
			$GoodsStoresData = new mysql_select ( "", "" );
			$GoodsStoresData->select_table_query ( "select s.*, d.dict_name as dialer from goods_stores s left join dictionaries d on s.dialer_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]} where ga_id = {$array['id']} order by s.gs_id" );
			$SectorData = new mysql_select ( "sectors", "where p_id = {$GoodsActionData["places_id"]}" );
			$SectorData->select_table ( "" );
			$TicketsData = new mysql_select ( "goods_tickets", "where ga_id =  {$array['id']}" );
			$TicketsData->select_table ( "" );
			$TicketsData = $this->sortedTickets ( $TicketsData->table );
		}
		return $this->Template ( "/dmn/goods_action/template/ga_tickets_list.phtml", array ('Data' => $Data, 'SectorData' => $SectorData->table, 'GoodsStoresData' => $GoodsStoresData->table, 'GoodsActionData' => $GoodsActionData, "TicketsData" => $TicketsData ) );
	}
	private function sortedTickets($array) {
		if (! $array)
			return null;
		$ret = array ();
		foreach ( $array as $key => $value ) {
			$ret [$value ["sectors_id"]] [$value ["gs_id"]] = $value;
		}
		return $ret;
	}
	public function saveTickets($array) {
		$sql = "delete from goods_tickets where ga_id= {$array['ga_id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['generalError'] = "error {$sql}";
			return $return;
		}
		foreach ( $array ["price"] as $sector => $value ) {
			foreach ( $value as $store => $avalue ) {
				if (! empty ( $avalue )) {
					if (! empty ( $array ["ticket"] [$sector] [$store] )) {
						$sql = "insert into goods_tickets(" . ($array ["gt_id"] [$sector] [$store] == "" ? "" : "gt_id,") . " sectors_id, ga_id, dialer_id, gt_count, gt_price, gs_id, gt_count_isset) values(" . ($array ["gt_id"] [$sector] [$store] == "" ? "" : $array ["gt_id"] [$sector] [$store] . ",") . "{$sector}, {$array["ga_id"]}, '{$array[dialer_id][$sector] [$store]}', {$array[ticket][$sector] [$store]}, {$array[price][$sector] [$store]}, {$store}, " . ($array [gt_count_isset] [$sector] [$store] ? $array [gt_count_isset] [$sector] [$store] : $array [ticket] [$sector] [$store]) . ")";
						if (! mysql_query ( $sql )) {
							$return ['success'] = false;
							$return ['generalError'] = "error {$sql}";
							return $return;
						}
					}
				}
			}
		}
		
		$return ['success'] = true;
		return $return;
	}
	
	public function saveImage($array) {
		$ga_img = $this->saveFile ();
		$arr_update = array ("ga_img" => "'{$ga_img}'" );
		$Data = new mysql_select ( "goods_action" );
		$Data->update_table ( "WHERE ga_id = {$array['ga_id']}", $arr_update );
	}
	
	public function saveSectors($array) {
		if ($_FILES ["sectors_csv"]) {
			if (copy ( $_FILES ["sectors_csv"] ['tmp_name'], "sectors_csv.csv" )) {
				$sql = "delete from sectors where p_id= {$array['p_id']}";
				if (! mysql_query ( $sql )) {
					$return ['success'] = false;
					$return ['error'] = "error {$sql}";
					return $return;
				}
				$this->saveCVS ( $array ["p_id"] );
			}
		}
		$SectorData = new mysql_select ( "sectors", "where p_id = {$array['p_id']}" );
		$SectorData->select_table ();
		return $this->Template ( "/dmn/places/template/sectors_list.phtml", array ('data' => $SectorData->table ) );
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
	
	public function saveFile() {
		$fileName = "";
		if ($_FILES ["ga_img"]) {
			$fileDir = $_SERVER ['DOCUMENT_ROOT'] . '/files/images/ga/';
			$ImgPropBig ['ImgW'] = 250;
			$ImgPropBig ['ImgH'] = 250;
			$photoId = uniqid ();
			$extension = pathinfo ( $_FILES ['ga_img'] ['name'] );
			$extension = strtolower ( $extension ['extension'] );
			$fileName = strtolower ( $photoId . "." . $extension );
			if (copy ( $_FILES ['ga_img'] ['tmp_name'], $fileDir . '' . $fileName )) {
				// *** 1) Initialise / load image
				$resizeObj = new resize ( $fileDir . "" . $fileName );
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj->resizeImage ( $ImgPropBig ['ImgW'], $ImgPropBig ['ImgH'], 'crop' );
				// *** 3) Save image
				$resizeObj->saveImage ( $fileDir . "sm_" . $fileName, 100 );
			}
			echo "<img src=\"/files/images/ga/{$fileName}\" width=\"100\" />";
		}
		return $fileName;
	}
	
	public function saveCVS($p_id) {
		$csv_lines = file ( "sectors_csv.csv" );
		if (is_array ( $csv_lines )) {
			foreach ( $csv_lines as $key => $value ) {
				$return = explode ( ";", $value );
				$sql = "insert into sectors(s_code, s_qwantity, p_id) values('$return[0]', $return[1], {$p_id})";
				if (! mysql_query ( $sql )) {
					echo "error {$sql}";
				}
			}
		} else
			return "error csv file!";
		return $return;
	}
	public function getCatalogData() {
		//производим выборку
		$CatData = new mysql_select ( "catalog", "where lang_id = {$_COOKIE['lang_id']} and dict_id='4d3c421816e39'" );
		$CatData->select_table ( "ct_id" );
		return $CatData;
	}
	
	public function getDictionaris() {
		#объявляем класс словаря
		$this->dictionaries = new dictionariesClass ( );
		#формируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		#формируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}

}
?>