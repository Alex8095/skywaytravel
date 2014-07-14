<?php
class dictionariesController extends aControllerClass {
	public function getdictvaluelist($param) {
		$data["success"] = true;
		$query = "where 1 = 1 and hide = 1";
		if (! empty ( $param["term"] ))
			$query .= " and dict_name LIKE '%" . $param["term"] . "%'";
		if (! empty ( $param["ld_id"] ))
			$query .= " and ld_id = {$param["ld_id"]}";
		if (! empty ( $param["ld_ids"] ))
			$query .= " and ld_id in ({$param["ld_ids"]})";
		
		$provider = new mysql_select ();
		$sql = sprintf ( "select * from dictionaries %s order by  dict_name asc %s", $query, (! empty ( $param["limit"] ) ? sprintf ( " limit %s", $param["limit"] ) : "") );
		$provider->select_table_query ( $sql );
		$ret = array();
		if ($provider->table) {
			foreach ( $provider->table as $key => $value ) {
				$ret[] = array(
						"id" => $value["dict_id"],
						"label" => $value["dict_name"]);
			}
		}
		return $this->getJson ( $ret );
	}
	public function getdictyvaluelist($param) {
		$data["success"] = true;
		$query = "where 1 = 1 and hide = 1";
		if (! empty ( $param["term"] ))
			$query .= " and dict_name LIKE '%" . $param["term"] . "%'";
		if (! empty ( $param["ld_id"] ))
			$query .= " and ld_id = {$param["ld_id"]}";
		if (! empty ( $param["ld_ids"] ))
			$query .= " and ld_id in ({$param["ld_ids"]})";
		
		$provider = new mysql_select ();
		$sql = sprintf ( "select * from dictionaries %s order by  dict_name asc %s", $query, (! empty ( $param["limit"] ) ? sprintf ( " limit %s", $param["limit"] ) : "") );
		$provider->select_table_query ( $sql );
		$ret = array();
		$accessoryArray = array(
				'11' => 'getaccessoryregion',
				'12' => 'getaccessorycity',
				'13' => 'getaccessoryarea',
				'14' => 'getaccessorystreet',
				'15' => 'getaccessoryarray',
				'20' => 'getaccessorymetro',
				'24' => 'getaccessoryrregion');
		if ($provider->table) {
			foreach ( $provider->table as $key => $value ) {
				$ret[] = array(
						"id" => $value["dict_id"],
						"label" => $value["dict_name"],
						"accessory" => $this->$accessoryArray[$value['ld_id']] ( $value ),
						"dict" => $value);
			}
		}
		return $this->getJson ( $ret );
	}
	private function getaccessoryregion($value) {
		return sprintf ( "%s_0", $value["dict_id"] );
	}
	private function getaccessoryrregion($value) {
		return sprintf ( "%s_1", $value["dict_id"] );
	}
	private function getaccessorycity($value) {
		return sprintf ( "%s_2", $value["dict_id"] );
	}
	private function getaccessoryarea($value) {
		return sprintf ( "%s_3", $value["dict_id"] );
	}
	private function getaccessoryarray($value) {
		return sprintf ( "%s_4", $value["dict_id"] );
	}
	private function getaccessorymetro($value) {
		return sprintf ( "m_4c400e6ac4be0" );
	}
	private function getaccessorystreet($value) {
		return sprintf ( "%s", $value["dict_name"] );
	}
}