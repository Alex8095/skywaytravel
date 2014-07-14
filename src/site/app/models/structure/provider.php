<?php
class structureProviderClass extends providerClass {
	public function getItem($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where page_id='%s'", $id ) );
		}
		return $ret;
	}
	public function getItemParam($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['dict_id'] ))
			$query .= " and dict_id='{$param ["dict_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and hide = '{$param ['hide']}'";
		if (! empty ( $param['controller'] ))
			$query .= " and controller = '{$param ["controller"]}'";
		if (! empty ( $param['action'] ))
			$query .= " and action = '{$param ["action"]}'";
		if (! empty ( $param['p_type'] ))
			$query .= " and p_type = '{$param ["p_type"]}'";
		$res = $this->mysql->select_table_id ( "WHERE lang_id = {$_COOKIE['lang_id']} {$query} ORDER BY pos" );
		return $res;
	}
	public function getList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['dict_id'] ))
			$query .= " and p.dict_id='{$param ["dict_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and p.hide = '{$param ['hide']}'";
		if (! empty ( $param['menu_show'] ))
			$query .= " and p.menu_show = '{$param ["menu_show"]}'";
		if (isset ( $param['parent_in'] ))
			$query .= " and p.parent_in = {$param ["parent_in"]}";
		if (isset ( $param['parent_id'] ))
			$query .= " and p.parent_id = '{$param ["parent_id"]}'";
		if (! empty ( $param['p_type'] ))
			$query .= " and p_type = '{$param ["p_type"]}'";
		$this->mysql->select_table_query ( "select p.* from {$this->table} p
										    WHERE p.lang_id = {$_COOKIE['lang_id']} {$query} ORDER BY pos", $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
	public function editItem($id, $param) {
	}
	public function deleteItem($id) {
	}
	public function deleteItemParam($param) {
	}
}