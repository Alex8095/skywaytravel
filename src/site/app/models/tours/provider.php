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
		$query = $this->getQuery ( $param );
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

	public function getTourDates($param) {
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

	public function getTourImages($param) {
		$res = null;
		$query = "";
		if ($param ["tour_id"]) {
			$query .= " and t.ct_id = {$param[tour_id]}";
		}
		$this->mysql->select_table_query ( "select t.* from ct_photos t WHERE 1= 1 {$query}", $this->id );
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
		if ($param ['type_save'] == "new") {
			$sql = sprintf ( "INSERT INTO `tours`(`name`, `type_id`, `type_inner_id`, `days`, `price_from`, `date_start`, `is_show`, `is_hot`, `description`, `summary`, `title`, `web_title`, `web_description`, `web_keywords`, `url`, `date_add`, `stars`, `img`) 
											VALUES ('%s','%s','%s',%s,'%s','%s',%s,%s,'%s','%s','%s','%s','%s','%s','%s', NOW(), %s,'%s')",
					 mysql_real_escape_string ( $param ["name"] ), 
					mysql_real_escape_string ( $param ["type_id"] ), 
					mysql_real_escape_string ( $param ["type_inner_id"] ), 
					$param ["days"], $param ["price_from"], $param ["date_start"], ($array ['is_show'] ? "1" : "0"), ($array ['is_hot'] ? "1" : "0"), mysql_real_escape_string ( $param ["description"] ), mysql_real_escape_string ( $param ["summary"] ), mysql_real_escape_string ( $param ["title"] ), mysql_real_escape_string ( $param ["web_title"] ), mysql_real_escape_string ( $param ["web_description"] ), mysql_real_escape_string ( $param ["web_summary"] ), mysql_real_escape_string ( $param ['url'] ? $param ['url'] : translitStrlover ( $array ['name'] ) ), $param ["stars"], $param ["img"] );
			
			if (! mysql_query ( $sql )) {
				$return ['success'] = false;
				$return ['generalError'] = "error {$sql}";
				return $return;
			}
			$return ['callbackArgs'] ["newActionID"] = mysql_insert_id ();
			$return ['success'] = true;
		} else {
			$arr_update = array (
					"stars" => ($param ['stars'] ? $param ['stars'] : "NULL") . ",",
					"days" => ($param ['days'] ? $param ['days'] : "NULL") . ",",
					"price_from" => "'" . mysql_real_escape_string ( $param ['price_from'] ) . "',",
					"date_start" => ($param ['date_start'] ?  "'" .  $param ['date_start'] . "'" : "NULL") . ",",
					"is_show" => ($param ['is_show'] ? "1" : "") . ",",
					"is_hot" => ($param ['is_hot'] ? "1" : "0") . ",",
					"description" => "'" . mysql_real_escape_string ( $param ['description'] ) . "',",
					"summary" => "'" . mysql_real_escape_string ( $param ['summary'] ) . "',",
					"name" => "'" . $param ['name'] . "',",
					"url" => "'" . ($param ['url'] ? $param ['url'] : translitStrlover ( $param ['name'] )) . "',",
					"web_description" => "'" . $param ['web_description'] . "',",
					"web_keywords" => "'" . $param ['web_keywords'] . "',",
					"web_title" => "'" . $param ['web_title'] . "',",
					"type_id" => "'" . $param ['type_id'] . "',",
					"type_inner_id" => "'" . $param ['type_inner_id'] . "',",
					"img" => "'" . $param ['img'] . "'" );
			$Data = new mysql_select ( $this->table );
			$Data->update_table ( "WHERE tour_id = {$param['tour_id']}", $arr_update );
			$return ['success'] = true;
			$return ['callbackArgs'] ["newActionID"] = $param ['tour_id'];
		}
		return $return;
	}

	public function saveTourMainImage($param) {
		$arrUpdate = array ("img" => "'" . $param ['img'] . "'" );
		$Data = new mysql_select ( $this->table );
		$Data->update_table ( "WHERE tour_id = {$param['tour_id']}", $arrUpdate );
		$return ['success'] = true;
		$return ['callbackArgs'] ["newActionID"] = $param ['tour_id'];
		return $return;
	}

	public function saveTourPrice($param) {
		$return ['success'] = true;
		$sql = sprintf ( "INSERT INTO `tour_prices`(`tours_tour_id`, `tour_prices`, `type_id`) VALUES (%s,%s,%s)", $param ["tour_id"], "'" . $param ["price"] . "'", "'" . $param ["type_id"] . "'" );
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['generalError'] = "error {$sql}";
		}
		return $return;
	}

	public function saveTourCountry($param) {
		$return ['success'] = true;
		$sql = sprintf ( "INSERT INTO `tour_countrys`(`tours_tour_id`, `country_id`) VALUES (%s, %s)", $param ["tours_tour_id"], "'" . $param ["country_id"] . "'" );
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['generalError'] = "error {$sql}";
		}
		return $return;
	}

	public function saveTourDate($param) {
		$return ['success'] = true;
		$sql = sprintf ( "INSERT INTO `tours_dates`(`tours_tour_id`, `date`) VALUES (%s,%s)", $param ["tour_id"], "'" . $param ["date"] . "'" );
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['generalError'] = "error {$sql}";
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
		return $return;
	}

	public function deleteTourPrice($param) {
		$return ['success'] = true;
		$query = "";
		if ($param ["tour_prices_id"])
			$query = sprintf ( " %s tour_prices_id = %s", ($query ? " and " : ""), $param ["tour_prices_id"] );
		if ($param ["tours_tour_id"])
			$query = sprintf ( " %s tours_tour_id = %s", ($query ? " and " : ""), $param ["tours_tour_id"] );
		if (empty ( $query )) {
			$return ['success'] = false;
			$return ['error'] = "enpty query";
			return $return;
		}
		$sql = "delete from tour_prices where {$query}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
	}

	public function deleteTourCountry($param) {
		$return ['success'] = true;
		$query = "";
		if ($param ["tour_countrys_id"])
			$query = sprintf ( " %s tour_countrys_id = %s", ($query ? " and " : ""), $param ["tour_countrys_id"] );
		if ($param ["tours_tour_id"])
			$query = sprintf ( " %s tours_tour_id = %s", ($query ? " and " : ""), $param ["tours_tour_id"] );
		if (empty ( $query )) {
			$return ['success'] = false;
			$return ['error'] = "enpty query";
			return $return;
		}
		$sql = "delete from tour_countrys where {$query}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
	}

	public function deleteTourDate($param) {
		$return ['success'] = true;
		$query = "";
		if ($param ["tours_date_id"])
			$query = sprintf ( " %s tours_date_id = %s", ($query ? " and " : ""), $param ["tours_date_id"] );
		if ($param ["tours_tour_id"])
			$query = sprintf ( " %s tours_tour_id = %s", ($query ? " and " : ""), $param ["tours_tour_id"] );
		if (empty ( $query )) {
			$return ['success'] = false;
			$return ['error'] = "enpty query";
			return $return;
		}
		$sql = "delete from tours_dates where {$query}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
	}

}

// SELECT r.name,
// GROUP_CONCAT(a.name SEPARATOR ',')
// FROM RESOURCES r
// JOIN APPLICATIONSRESOURCES ar ON ar.resource_id = r.id
// JOIN APPLICATIONS a ON a.id = ar.app_id
// GROUP BY r.name