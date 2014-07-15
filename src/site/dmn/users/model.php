<?php
class DMN_Users extends Controller {
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "users_site", "order by user_regdate desc" );
		$Data->select_table ( "user_id" );
		//
		$tListData = $this->Template ( "/dmn/users/template/users_list.phtml", array ('Data' => $Data->table ) );
		//$tAction = $this->Template ( "/dmn/places/template/places_action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		$Data = new mysql_select ( "t_banners", "order by pos" );
		$Data->select_table ( "id" );
		return $this->Template ( "/banner/list_banners.phtml", array ('Data' => $Data->table ) );
	}
	public function getUser($array) {
		//
		$Data = NULL;
		if (isset ( $array ["id"] )) {
			$Data = new mysql_select ( "users_site" );
			$Data = $Data->select_table_id ( "where user_id = {$array['id']}" );
			$PData = new mysql_select("t_packets");
			$PData -> select_table_query("select up.*, p.p_name from users_packets up left join t_packets p on up.packet_id = p.p_id where up.user_id = {$array['id']}");
		}
		return $this->Template ( "/dmn/users/template/user_form.phtml", array ('Data' => $Data, "PData" => $PData->table ) );
	}
	public function save($array) {
		$arr_update = array ("p_name" => "'{$array['p_name']}',", "p_country" => $array ['p_country'] . ",", "p_city" => $array ['p_city'] . ",", "p_count_place" => $array ['p_count_place'] );
		$Data = new mysql_select ( "places" );
		$Data->update_table ( "WHERE p_id = {$array['p_id']}", $arr_update );
		$return ['conf'] = "DMN_Users";
		$return ['success'] = true;
		return $return;
	}
	public function delete($array) {
		$sql = "delete from users_site where user_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "DMN_Users";
		$return ['success'] = true;
		return $this->getPage ( array () );
	}
}
?>