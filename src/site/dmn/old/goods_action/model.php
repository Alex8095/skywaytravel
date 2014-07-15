<?php
class DMN_GoodsAction extends Controller {
	public $dictionaries;
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "goods_action", "" );
		$Data->select_table_query ( "select ga.*, c.ct_name, p.p_name as place, co.cc_name as country, ci.cc_name as city from goods_action ga left join places p on ga.places_id = p.p_id left join places_cc co on p.p_country = co.cc_id left join places_cc ci on p.p_city = ci.cc_id left join catalog c on ga.catalog_id = c.ct_id and lang_id = {$_COOKIE[lang_id]} order by ga.ga_date desc" );
		//
		$tListData = $this->Template ( "/dmn/goods_action/template/goods_action_list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/goods_action/template/goods_action_action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		$Data = new mysql_select ( "t_banners", "order by pos" );
		$Data->select_table ( "id" );
		return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	}
	public function getGoodsAction($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 30 );
		$catalogData = $this->getCatalogData ();
		$dealerDataDict = $this->dictionaries->my_dct;
		$placesData = new mysql_select ( "places" );
		$placesData->select_table ( "p_id" );
		
		//
		$GoodsActionData = NULL;
		$GoodsStoresDataBuild = NULL;
		if (isset ( $array ["id"] )) {
			$Data = new mysql_select ( "goods_action" );
			$GoodsActionData = $Data->select_table_id ( "where ga_id = {$array['id']}" );
			$GSData = new mysql_select ( "goods_stores", "where ga_id = {$array['id']}" );
			$GSData->select_table ( "dialer_id" );
			$GoodsStoresDataBuild = $GSData->buld_table;
		}
		$TicketsData = $this->getTickets ( $array );
		return $this->Template ( "/dmn/goods_action/template/goods_action_form.phtml", array ('GoodsActionData' => $GoodsActionData, "placesData" => $placesData->table, "dealerDataDict" => $dealerDataDict, "catalogData" => $catalogData->table, "GoodsStoresDataBuild" => $GoodsStoresDataBuild, "TicketsData" => $TicketsData ) );
	}
	public function saveGoodsAction($array) {
		if ($array ['type_save'] == "new") {
			$sql = "insert into goods_action(places_id, catalog_id, ga_price, ga_date, ga_time, ga_name, ga_desc, ga_text, ga_w_title, ga_w_description, ga_w_keywords, hide) values($array[places_id], '$array[catalog_id]', '$array[ga_price]', '$array[ga_date]', '$array[ga_time]', '$array[ga_name]', '$array[ga_desc]', '$array[ga_text]', '$array[ga_w_title]', '$array[ga_w_description]', '$array[ga_w_keywords]', ". ($array ['hide'] ? "1" : "0"). ")";
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['generalError'] = "error {$sql}";
				return $return;
			}
			$Data = new mysql_select ( "goods_action" );
			$Data = $Data->select_table_query ( "select ga_id from goods_action where places_id = {$array[places_id]} and ga_name = '{$array[ga_name]}' and catalog_id = '{$array[catalog_id]}' and ga_date = '{$array[ga_date]}' and ga_time = '{$array[ga_time]}' order by ga_id desc" );
			$return ['callbackArgs'] ["newActionID"] = $Data [0] [0];
			$return ['success'] = true;
		} else {
			$arr_update = array ("catalog_id" => "'" . $array ['catalog_id'] . "',", "ga_price" => $array ['ga_price'] . ",", "ga_date" => "'" . $array ['ga_date'] . "',", "ga_time" => "'" . $array ['ga_time'] . "',", "ga_name" => "'" . $array ['ga_name'] . "',", "ga_desc" => "'" . $array ['ga_desc'] . "',", "ga_text" => "'" . $array ['ga_text'] . "',", "ga_w_description" => "'" . $array ['ga_w_description'] . "',", "ga_w_title" => "'" . $array ['ga_w_title'] . "',", "ga_w_keywords" => "'" . $array ['ga_w_keywords'] . "',", "hide" =>  ($array ['hide'] ? "1" : "0") );
			$Data = new mysql_select ( "goods_action" );
			$Data->update_table ( "WHERE ga_id = {$array['ga_id']}", $arr_update );
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
						$sql = "insert into goods_tickets(" . ($array ["gt_id"] [$sector] [$store] == "" ? "" : "gt_id,") . " sectors_id, ga_id, dialer_id, gt_count, gt_price, gs_id, gt_count_isset) values(" . ($array ["gt_id"] [$sector] [$store] == "" ? "" : $array ["gt_id"] [$sector] [$store] . ",") . "{$sector}, {$array["ga_id"]}, '{$array[dialer_id][$sector] [$store]}', {$array[ticket][$sector] [$store]}, {$array[price][$sector] [$store]}, {$store}, " . ($array[gt_count_isset][$sector] [$store] ? $array[gt_count_isset][$sector] [$store] : $array[ticket][$sector] [$store]) . ")";
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
		$sql = "delete from goods_action where ga_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "DMN_Places";
		$return ['success'] = true;
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