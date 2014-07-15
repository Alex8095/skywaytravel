<?php 
class TPacketCode extends Controller {
	/*	SPECIAL CODE	*/
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select("t_packets", "");
		$Data -> select_table("p_id");
		//
		$tListData = $this->Template ( "/dmn/packets/template/list_packets.phtml", array ('Data' => $Data->table) );
		$tAction = $this->Template ( "/dmn/packets/template/action_packets.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		$Data = new mysql_select("t_packets", "");
		$Data -> select_table("p_id");
		return $this->Template ( "/dmn/packets/template/list_packets.phtml", array ('Data' => $Data->table) );
	}
	public function getPacket($array) {
		$Data = NULL;
		if(isset($array["id"])) {
			$Data = new mysql_select("t_packets");
			$Data = $Data -> select_table_id("where p_id = {$array['id']}" );
		}
		return $this->Template ( "/dmn/packets/template/form_packet.phtml", array ('Data' => $Data ) );
	}
	public function save($array) {
		if(empty($array['p_id'])) {
			$sql = "insert into t_packets(p_name) values('$array[p_name]')";
			if (! mysql_query ( $sql )) {
				$return['success'] = false;
				$return['error'] = "error {$sql}";
				return $return;
			}
		}
		else {
			$arr_update = array ("p_name" => "'{$array['p_name']}'" );
			$Data = new mysql_select ( "t_packets" );
			$Data->update_table ( "WHERE p_id = {$array['p_id']}", $arr_update );
		}
		$return['conf'] = "TPacketCode";
		$return['success'] = true;
		return $return;
	}
	public function delete($array) {
		$sql = "delete from t_packets where p_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return['success'] = false;
			$return['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "TPacketCode";
		$return ['success'] = true;
		return $this->getPage(array());
	}
}
?>