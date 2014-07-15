<?php
class DMN_Places extends Controller {
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "places", "" );
		$Data->select_table_query ( "select p.*, c.cc_name as country, i.cc_name as city from places p left join places_cc c on p.p_country = c.cc_id left join places_cc i on p.p_city = i.cc_id " );
		//
		$tListData = $this->Template ( "/dmn/places/template/places_list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/places/template/places_action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		$Data = new mysql_select ( "t_banners", "order by pos" );
		$Data->select_table ( "id" );
		return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	}
	public function getPlace($array) {
		//
		$Data = NULL;
		if (isset ( $array ["id"] )) {
			$Data = new mysql_select ( "places" );
			$Data = $Data->select_table_id ( "where p_id = {$array['id']}" );
			$SectorData = new mysql_select ( "sectors" );
			$SectorData->select_table ( "where p_id = {$array['id']}" );
			$SectorData = $this->Template ( "/dmn/places/template/sectors_list.phtml", array ('data' => $SectorData->table ) );
		} else {
			$Data = new mysql_select ( "places" );
			$Data = $Data->select_table_query ( "select max(p_id) from places" );
			$nextID = $Data [0] [0] + 1;
		}
		//
		$CountryData = new mysql_select ( "places_cc", "where cc_type= 'country'" );
		$CountryData->select_table ( "сc_id" );
		$CityData = new mysql_select ( "places_cc", "where cc_type= 'city'" );
		$CityData->select_table ( "сc_id" );
		return $this->Template ( "/dmn/places/template/places_form.phtml", array ('data' => $Data, "nextID" => $nextID, "SectorData" => $SectorData, "CountryData" => $CountryData->table, "CityData" => $CityData->table ) );
	}
	public function save($array) {
		if ($array ['type_save'] == "new") {
			$sql = "insert into places(p_id, p_name, p_img, p_country, p_city, p_count_place) values($array[p_id], '$array[p_name]', '$array[p_img]', $array[p_country], $array[p_city], $array[p_count_place] )";
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['error'] = "error {$sql}";
				return $return;
			}
		} else {
			$arr_update = array ("p_name" => "'{$array['p_name']}',", "p_country" => $array ['p_country'] . ",", "p_city" => $array ['p_city'] . ",", "p_count_place" => $array ['p_count_place'] );
			$Data = new mysql_select ( "places" );
			$Data->update_table ( "WHERE p_id = {$array['p_id']}", $arr_update );
		}
		$return ['conf'] = "DMN_Places";
		$return ['success'] = true;
		return $return;
	}
	public function saveImage($array) {
		$p_img = $this->saveFile ();
		$arr_update = array ("p_img" => "'{$p_img}'" );
		$Data = new mysql_select ( "places" );
		$Data->update_table ( "WHERE p_id = {$array['p_id']}", $arr_update );
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
		$SectorData->select_table (  );
		return $this->Template ( "/dmn/places/template/sectors_list.phtml", array ('data' => $SectorData->table ) );
	}
	public function delete($array) {
		$sql = "delete from places where p_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$sql = "delete from sectors where p_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "DMN_Places";
		$return ['success'] = true;
		return $this->getPage(array());
	}
	public function saveFile() {
		$fileName = "";
		if ($_FILES ["p_img"]) {
			$fileDir = $_SERVER ['DOCUMENT_ROOT'] . '/files/images/places/';
			$ImgPropBig ['ImgW'] = 250;
			$ImgPropBig ['ImgH'] = 250;
			$photoId = uniqid ();
			$extension = pathinfo ( $_FILES ['p_img'] ['name'] );
			$extension = strtolower ( $extension ['extension'] );
			$fileName = strtolower ( $photoId . "." . $extension );
			if (copy ( $_FILES ['p_img'] ['tmp_name'], $fileDir . '' . $fileName )) {
				// *** 1) Initialise / load image
				$resizeObj = new resize ( $fileDir . "" . $fileName );
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj->resizeImage ( $ImgPropBig ['ImgW'], $ImgPropBig ['ImgH'], 'crop' );
				// *** 3) Save image
				$resizeObj->saveImage ( $fileDir . "sm_" . $fileName, 100 );
			}
			echo "<img src=\"/files/images/places/{$fileName}\" width=\"100\" />";
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
}
?>