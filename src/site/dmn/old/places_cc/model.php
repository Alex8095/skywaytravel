<?php
class DMN_Places_CC extends Controller {
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "places_cc", "" );
		$Data->select_table ( "сc_id" );
		//
		$tListData = $this->Template ( "/dmn/places_cc/template/places_cc_list.phtml", array ('Data' => $Data->table ) );
		$tAction = $this->Template ( "/dmn/places_cc/template/places_cc_action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		$Data = new mysql_select ( "t_banners", "order by pos" );
		$Data->select_table ( "id" );
		return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	}
	public function getCountry($array) {
		//
		$Data = NULL;
		if (isset ( $array ["id"] )) {
			$Data = new mysql_select ( "places_cc" );
			$Data = $Data->select_table_id ( "where cc_id = {$array['id']}" );
			$CityData = new mysql_select ( "places_cc", "where parent_id = {$array['id']}" );
			$CityData->select_table ("cc_d" );
			//$citysData = $this->Template ( "/dmn/places_cc/template/citys_list.phtml", array ('Data' => $CityData->table ) );
		} else {
			$Data = new mysql_select ( "places_cc" );
			$Data = $Data->select_table_query ( "select max(cc_id) from places_cc" );
			$nextID = $Data [0] [0] + 1;
		}
		return $this->Template ( "/dmn/places_cc/template/places_cc_form.phtml", array ('data' => $Data, "nextID" => $nextID, "citysData" => $citysData ) );
	}
	public function getCitys($array) {
		$CityData = new mysql_select ( "places_cc", "where parent_id = {$array['id']} and cc_type='city'" );
		$CityData->select_table ( );
		return $citysData = $this->Template ( "/dmn/places_cc/template/citys_list.phtml", array ('Data' => $CityData->table ) );
	}
	
	public function save($array) {
		if ($array ['type_save'] == "new") {
			$sql = "insert into places_cc(cc_id, parent_id, cc_name, cc_type) values(" . ($array ["cc_id"] ? $array ["cc_id"] : 'NULL') . ", " . ($array ["parent_id"] ? $array ["parent_id"] : 'NULL') . ", '$array[cc_name]', '$array[cc_type]' )";
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['error'] = "error {$sql}";
				return $return;
			}
		} else {
			$arr_update = array ("cc_name" => "'{$array['cc_name']}'" );
			$Data = new mysql_select ( "places_cc" );
			$Data->update_table ( "WHERE cc_id = {$array['cc_id']}", $arr_update );
		}
		$return ['conf'] = "DMN_Places_CC";
		$return ['success'] = true;
		return $return;
	}
	public function deleteCity($array) {
		$sql = "delete from places_cc where cc_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		return $this->getCitys ( array ("id" => $array ["parent_id"] ) );
	}
	public function delete($array) {
		$sql = "delete from places_cc where cc_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$sql = "delete from places_cc where parent_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		return $this->getPage(array());
	}
}
?>