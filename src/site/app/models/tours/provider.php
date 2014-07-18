<?php
class tourProviderClass extends providerClass {

	public function getItem($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where tour_id ='%s'", $id ) );
		}
		return $ret;
	}

	public function getItemByParam($param) {
		$ret = "";
		$query = "";
		if ($param ["tour_id"])
			$query .= " and tour_id = {$param[id]}";
		if ($param ["url"])
			$query .= " and url = '{$param[url]}'";
		if ($param ["type_id"])
			$query .= " and type_id = '{$param[type_id]}'";
		if ($param ["type_inner_id"])
			$query .= " and type_inner_id = '{$param[type_inner_id]}'";
		if ($param ["days"])
			$query .= " and days = {$param[days]}";
		if ($param ["days_from"])
			$query .= " and days > {$param[days_from]}";
		if ($param ["days_to"])
			$query .= " and days > {$param[days_to]}";
		if ($param ["price"])
			$query .= " and price_from = '{$param[price]}'";
		if ($param ["price_from"])
			$query .= " and price_from > '{$param[price_from]}'";
		if ($param ["price_to"])
			$query .= " and price_from < '{$param[price_to]}'";
		if ($param ["is_show"])
			$query .= " and is_show = {$param[is_show]}";
		if ($param ["is_hot"])
			$query .= " and is_hot = {$param[is_hot]}";
		$ret = $this->mysql->select_table_id ( sprintf ( "where 1 = 1 %s limit 1", $query ) );
		return $ret;
	}

	public function getList($param) {
		$res = null;
		$query = $this->getQuery ();
		$cuontryQuery = "";
		if ($param ["country_id"]) {
			$cuntryQuery = " left join tour_countrys c on t.tour_id = c.tours_tour_id and c.country_id = '{$param[country_id]}'";
		}
		$this->mysql->select_table_query ( "select t.* from {$this->table} t
											{$cuontryQuery}	
										    WHERE 1= 1 {$query}", $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array ("resTable" => $this->list,"resBuildTable" => $this->listBuild );
		} else
			return $res;
	}

	public function getListPager($param, $page_id = 1, $query = "") {
		if (empty ( $query ))
			$query = $this->getQuery ( $param );
		$obj = new pager_mysql_right ( $this->table . " t", ($query ? "where" . $query : ""), sprintf ( "order by %s %s", $this->orderby, $this->ordersort ), $this->limit, 5, $this->pagerlink, $this->pagerparamafter );
		$this->list = $obj->get_page ( sprintf ( "select t.* from %s t %s order by %s %s", $this->table, ($query ? "where" . $query : ""), $this->orderby, $this->ordersort ) );
		$this->pager = $obj;
	}

	public function getTourCountrys($param) {
		$res = null;
		$query = "";
		if ($param ["tour_id"]) {
			$query .= " and t.tours_tour_id = {$param[tour_id]}";
		}
		$this->mysql->select_table_query ( "select t.* from tour_countrys t
											WHERE 1= 1 {$query} order by t.pos ", $this->id );
		if (! empty ( $this->mysql->table )) {
			return array ("resTable" => $this->mysql->table,"resBuildTable" => $this->mysql->table );
		} else
			return $res;
	}

	public function getTourPrices($param) {
		$res = null;
		$query = "";
		if ($param ["tour_id"]) {
			$query .= " and t.tours_tour_id = {$param[tour_id]}";
		}
		$this->mysql->select_table_query ( "select t.* from tour_prices t
				WHERE 1= 1 {$query}", $this->id );
		if (! empty ( $this->mysql->table )) {
			return array ("resTable" => $this->mysql->table,"resBuildTable" => $this->mysql->table );
		} else
			return $res;
	}

	public function getToursDates($param) {
		$res = null;
		$query = "";
		if ($param ["tour_id"]) {
			$query .= " and t.tours_tour_id = {$param[tour_id]}";
		}
		$this->mysql->select_table_query ( "select t.* from tours_dates t
				WHERE 1= 1 {$query}", $this->id );
		if (! empty ( $this->mysql->table )) {
			return array ("resTable" => $this->mysql->table,"resBuildTable" => $this->mysql->table );
		} else
			return $res;
	}

	private function getQuery($param) {
		$query = "";
		if ($param ["url"])
			$query .= ($query == "" ? "" : " and ") . " t.url = '{$param[url]}'";
		if ($param ["stars"])
			$query .= ($query == "" ? "" : " and ") . " t.stars = {$param[stars]}";
		if ($param ["type_id"])
			$query .= ($query == "" ? "" : " and ") . " t.type_id = '{$param[type_id]}'";
		if ($param ["type_inner_id"])
			$query .= ($query == "" ? "" : " and ") . " t.type_inner_id = '{$param[type_inner_id]}'";
		if ($param ["days"])
			$query .= ($query == "" ? "" : " and ") . " t.days = {$param[days]}";
		if ($param ["days_from"])
			$query .= ($query == "" ? "" : " and ") . " t.days > {$param[days_from]}";
		if ($param ["days_to"])
			$query .= ($query == "" ? "" : " and ") . " t.days > {$param[days_to]}";
		if ($param ["price"])
			$query .= ($query == "" ? "" : " and ") . " t.price_from = '{$param[price]}'";
		if ($param ["price_from"])
			$query .= ($query == "" ? "" : " and ") . " t.price_from > '{$param[price_from]}'";
		if ($param ["price_to"])
			$query .= ($query == "" ? "" : " and ") . " t.price_from < '{$param[price_to]}'";
		if ($param ["is_show"])
			$query .= ($query == "" ? "" : " and ") . " t.is_show = {$param[is_show]}";
		if ($param ["is_hot"])
			$query .= ($query == "" ? "" : " and ") . " t.is_hot = {$param[is_hot]}";
		return $query;
	}

	public function saveItem($param) {
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

	public function deleteItem($id) {
		$return ['success'] = true;
		$sql = "delete from tours where tour_id= {$id}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$sql = "delete from tour_prices where tours_tour_id= {$id}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$sql = "delete from tour_countrys where tours_tour_id= {$id}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		return $return;
	}

}

// SELECT r.name,
// GROUP_CONCAT(a.name SEPARATOR ',')
// FROM RESOURCES r
// JOIN APPLICATIONSRESOURCES ar ON ar.resource_id = r.id
// JOIN APPLICATIONS a ON a.id = ar.app_id
// GROUP BY r.name