<?php
/*
 * i.im_id, i.im_catalog_id, i.im_type_id, i.im_array_id, i.im_region_id, i.im_a_region_id, i.im_city_id, i.im_area_id, i.im_adress_id, i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.im_sale_id, i.hide, i.pos, i.im_is_hot, i.im_is_sale, i.im_is_rent, i.im_date_add, i.im_code_input, i.im_adress_flat, i.im_title, i.im_geopos, i.im_code, i.im_is_special, i.web_title, i.web_keywords, i.web_description
 */
class immovablesProviderClass extends providerClass {
	public function getList($param) {
		$res = null;
		$query = "";
		$limit = (! empty ( $param['limit'] ) ? " limit " . $param['limit'] : "");
		$query = $this->buildStandartImmovablesQuery ( $param );
		$this->mysql->select_table_query ( "select i.* from {$this->table} i 
										    {$query} order by im_id desc" . $limit, "im_id" );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
	public function getListHotPrice($param) {
		$res = null;
		$query = "";
		$limit = (! empty ( $param['limit'] ) ? " limit " . $param['limit'] : "");
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and i.im_catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and i.hide = '{$param ['hide']}'";
		$query .= (empty ( $param["is_hot"] ) ? " and i.im_prace < i.im_prace_old" : " and i.im_is_hot = 1");
		
		$this->mysql->select_table_query ( "select i.* from {$this->table} i 
										    WHERE 1=1 {$query} order by rand() " . $limit, $this->id );
		$this->list = $this->mysql->table;
		$this->listBuild = $this->mysql->buld_table;
		if (! empty ( $this->mysql->table )) {
			return array(
					"resTable" => $this->list,
					"resBuildTable" => $this->listBuild);
		} else
			return $res;
	}
	public function buildStandartImmovablesQuery($param) {
		$param["im_praceb"] = str_replace ( ",", "", $param["im_praceb"] );
		$param["im_pracee"] = str_replace ( ",", "", $param["im_pracee"] );
		$param["im_spaceb"] = str_replace ( ",", "", $param["im_spaceb"] );
		$param["im_spacee"] = str_replace ( ",", "", $param["im_spacee"] );
		
		$query = "where 1=1";
		if (! empty ( $param['im_ids'] ))
			$query .= " and i.im_id IN {$param ["im_ids"]}";
		if (! empty ( $param['im_codes'] ))
			$query .= " and i.im_code IN {$param ["im_codes"]}";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and i.im_catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['hide'] ))
			$query .= " and i.hide='{$param ["hide"]}'";
		if (! empty ( $param['im_is_sale'] ))
			$query .= " and i.im_is_sale={$param ["im_is_sale"]}";
		if (! empty ( $param['im_is_rent'] ))
			$query .= " and i.im_is_rent={$param ["im_is_rent"]}";
		if (! empty ( $param['im_area_id'] ))
			$query .= " and i.im_area_id='{$param ["im_area_id"]}'";
		if (! empty ( $param['im_space'] ))
			$query .= " and i.im_space='{$param ["im_space"]}'";
		if (! empty ( $param['im_space_like'] ))
			$query .= sprintf ( " and i.im_space < %s AND i.im_space > %s", $param['im_space_like'] * 1.25, $param['im_space_like'] * 0.75 );
		if (! empty ( $param['im_prace_like'] ))
			$query .= sprintf ( " and i.im_prace < %s AND i.im_prace > %s", $param['im_prace_like'] * 1.25, $param['im_prace_like'] * 0.75 );
		if (! empty ( $param['im_prace_manth_like'] ))
			$query .= sprintf ( " and i.im_prace_manth < %s AND i.im_prace_manth > %s", $param['im_prace_manth_like'] * 1.25, $param['im_prace_manth_like'] * 0.75 );
		if (! empty ( $param['im_praceb'] ))
			$query .= " and i.im_prace >= {$param ["im_praceb"]}";
		if (! empty ( $param['im_pracee'] ))
			$query .= " and i.im_prace <= {$param ["im_pracee"]}";
		if (! empty ( $param['im_spaceb'] ))
			$query .= " and i.im_space >= {$param ["im_spaceb"]}";
		if (! empty ( $param['im_spacee'] ))
			$query .= " and i.im_space <= {$param ["im_spacee"]}";
		if (! empty ( $param['im_date_add'] ))
			$query .= " and i.im_date_add <= '{$param ["im_date_add"]}'";
		if (! empty ( $param['im_date_add_b'] ))
			$query .= " and i.im_date_add >= '{$param ["im_date_add_b"]}'";
		if (! empty ( $param['im_date_add_e'] ))
			$query .= " and i.im_date_add <= '{$param ["im_date_add_e"]}'";
		
		if (! empty ( $param['im_geopos_not_null'] ))
			$query .= " and i.im_geopos != ''";
		if (! empty ( $param['im_geopos_es'] ))
			$query .= " and m.im_geopos_e >= {$param['im_geopos_es']}";
		if (! empty ( $param['im_geopos_ee'] ))
			$query .= " and m.im_geopos_e <= {$param['im_geopos_ee']}";
		if (! empty ( $param['im_geopos_ns'] ))
			$query .= " and m.im_geopos_n >= {$param['im_geopos_ns']}";
		if (! empty ( $param['im_geopos_ne'] ))
			$query .= " and m.im_geopos_n <= {$param['im_geopos_ne']}";
		return $query;
	}
	public function getListPager($param, $page_id = 1, $query = "") {
		if (empty ( $query ))
			$query = $this->buildStandartImmovablesQuery ( $param );
		$obj = new pager_mysql_right ( $this->table . " i", $query, sprintf ( "order by %s %s", $this->orderby, $this->ordersort ), $this->limit, 5, $this->pagerlink, $this->pagerparamafter );
		$this->list = $obj->get_page ( "select i.im_id, i.im_catalog_id, i.im_type_id, i.im_array_id, i.im_region_id, i.im_a_region_id, i.im_city_id, i.im_area_id, i.im_adress_id, i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.im_sale_id, i.hide, i.pos, i.im_is_hot, i.im_is_sale, i.im_is_rent, i.im_date_add, i.im_code_input, i.im_adress_flat, i.im_title, i.im_geopos, i.im_code, i.im_is_special, i.web_title, i.web_keywords, i.web_description, 
				count(p.im_photo_id) as photos 
				from immovables i 
				LEFT JOIN immovables_photos p ON i.im_id = p.im_id " . $query . " group by i.im_id " . sprintf ( " order by %s %s", $this->orderby, $this->ordersort ) );
		// echo sprintf ( " order by %s %s", $this->orderby, $this->ordersort );
		// devLogs::_printr($this->list);
		$this->pager = $obj;
	}
	public function getListPagerMap($param, $page_id = 1, $query = "") {
		if (empty ( $query ))
			$query = $this->buildStandartImmovablesQuery ( $param );
		$obj = new pager_mysql_right ( $this->table . " i", $query, sprintf ( "order by %s %s", $this->orderby, $this->ordersort ), $this->limit, 5, $this->pagerlink, $this->pagerparamafter );
		$this->list = $obj->get_page ( "select i.im_id, i.im_catalog_id, i.im_type_id, i.im_array_id, i.im_region_id, i.im_a_region_id, i.im_city_id, i.im_area_id, i.im_adress_id, i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.im_sale_id, i.hide, i.pos, i.im_is_hot, i.im_is_sale, i.im_is_rent, i.im_date_add, i.im_code_input, i.im_adress_flat, i.im_title, i.im_geopos, i.im_code, i.im_is_special, i.web_title, i.web_keywords, i.web_description,
				m.*
				from immovables i
				LEFT JOIN immovables_map m ON i.im_id = m.im_id " . $query . " group by i.im_id " . sprintf ( " order by %s %s", $this->orderby, $this->ordersort ), " LEFT JOIN immovables_map m ON i.im_id = m.im_id " );
		
		$this->pager = $obj;
	}
	public function getItem($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_query_id ( "select i.im_id, i.im_catalog_id, i.im_type_id, i.im_array_id, i.im_region_id, i.im_a_region_id, i.im_city_id, i.im_area_id, i.im_adress_id, i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.im_sale_id, i.hide, i.pos, i.im_is_hot, i.im_is_sale, i.im_is_rent, i.im_date_add, i.im_code_input, i.im_adress_flat, i.im_title, i.im_geopos, i.im_code, i.im_is_special, i.web_title, i.web_keywords, i.web_description from immovables i " . sprintf ( " where i.im_id=%s and hide='show'", $id ) );
			// $ret = $this->mysql->select_table_id ( sprintf ( "where im_id=%s", $id ) );
		}
		if ($ret)
			$this->updateCountViews ( $id );
		return $ret;
	}
	public function getItemNoHide($id) {
		$ret = "";
		if ($id) {
			$ret = $this->mysql->select_table_query_id ( "select i.im_id, i.im_catalog_id, i.im_type_id, i.im_array_id, i.im_region_id, i.im_a_region_id, i.im_city_id, i.im_area_id, i.im_adress_id, i.im_adress_house, i.im_prace, i.im_prace_old, i.im_prace_sq, i.im_prace_day, i.im_prace_manth, i.im_photo, i.im_space, i.im_space_value_id, i.im_sale_id, i.hide, i.pos, i.im_is_hot, i.im_is_sale, i.im_is_rent, i.im_date_add, i.im_code_input, i.im_adress_flat, i.im_title, i.im_geopos, i.im_code, i.im_is_special, i.web_title, i.web_keywords, i.web_description from immovables i " . sprintf ( " where i.im_id=%s", $id ) );
			// $ret = $this->mysql->select_table_id ( sprintf ( "where im_id=%s", $id ) );
		}
		return $ret;
	}
	public function getItemByCode($code) {
		$ret = "";
		if ($code) {
			$ret = $this->mysql->select_table_id ( sprintf ( "where im_code='%s'", $code ) );
		}
		return $ret;
	}
	public function getImagesList($id, $dict_id) {
		$this->mysql->select_table_query ( "SELECT p.*, CONCAT(p.im_photo_id, '.', p.im_file_type) as im_photo_name, i.im_photo as im_main_photo FROM `immovables_photos` p
											left join immovables i on p.im_id = i.im_id
											WHERE p.im_id = {$id} AND p.im_photo_type = '{$dict_id}' 
											ORDER BY p.im_photo_order", "im_photo_id" );
		return $this->mysql->table;
	}
	public function getItemSummary($id) {
		$this->mysql->name_table_select = "immovables_summary";
		return $this->mysql->select_table_id ( "v WHERE v.im_id = {$id} and lang_id='4c5d58cd3898c'" );
	}
	public function getVideo($id) {
		$this->mysql->name_table_select = "immovables_videos";
		return $this->mysql->select_table_id ( "v WHERE v.im_id = {$id}" );
	}
	public function getPropertiesList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and l.catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['im_id'] ))
			$query .= " and i.im_id='{$param["im_id"]}'";
		if (! empty ( $param['is_prop_rent'] ))
			$query .= " and l.is_prop_rent=true";
		if (! empty ( $param['is_prop_sale'] ))
			$query .= " and l.is_prop_sale=true";
		if (! empty ( $param['im_ids'] ))
			$query .= " and i.im_id in ({$param ['im_ids']})";
		$this->mysql->name_table_select = "im_properties_list";
		$this->mysql->where_table_select = "l left join im_properties_info i ON l.im_prop_id = i.im_prop_id WHERE l.lang_id = {$_COOKIE['lang_id']} AND i.lang_id = {$_COOKIE['lang_id']} AND hide='show' " . $query;
		$this->mysql->order_table_select = "ORDER BY im_prop_name ASC";
		$this->mysql->select_table ( "im_prop_id" );
		if (! empty ( $this->mysql->table )) {
			return array(
					"list" => $this->mysql->table,
					"listBuild" => $this->mysql->buld_table);
		} else
			return $res;
	}
	public function getPropertiesOnlyGroupList($param) {
		$res = null;
		$this->mysql->select_table_query ( "select a.*,
											f.im_prop_id as flat_im_prop_id, f.prop_have_image as flat_prop_have_image,
											c.im_prop_id as commercial_im_prop_id, c.prop_have_image as commercial_prop_have_image,
											h.im_prop_id as home_im_prop_id, h.prop_have_image as home_prop_have_image,
											l.im_prop_id as land_im_prop_id, l.prop_have_image as land_prop_have_image
											from im_properties_list a
											left join im_properties_list f on a.im_prop_name = f.im_prop_name and f.catalog_id = '4c3ec3ec5e9b5'
											left join im_properties_list c on a.im_prop_name = c.im_prop_name and c.catalog_id = '4c3ec3ec5e9b7'
											left join im_properties_list h on a.im_prop_name = h.im_prop_name and h.catalog_id = '4c3ec51d537c0'
											left join im_properties_list l on a.im_prop_name = l.im_prop_name and l.catalog_id = '4c3ec51d537c3'
											group by a.im_prop_name
											order by a.im_prop_name", "im_prop_id" );
		if (! empty ( $this->mysql->table )) {
			return array(
					"list" => $this->mysql->table,
					"listBuild" => $this->mysql->buld_table);
		} else
			return $res;
	}
	public function getPropertiesOnlyList($param) {
		$res = null;
		$query = "";
		if (! empty ( $param['im_catalog_id'] ))
			$query .= " and l.catalog_id='{$param ["im_catalog_id"]}'";
		if (! empty ( $param['is_prop_rent'] ))
			$query .= " and l.is_prop_rent=true";
		if (! empty ( $param['is_prop_sale'] ))
			$query .= " and l.is_prop_sale=true";
		
		$this->mysql->name_table_select = "im_properties_list";
		$this->mysql->where_table_select = "l WHERE l.lang_id = {$_COOKIE['lang_id']} AND hide='show' " . $query;
		$this->mysql->order_table_select = "ORDER BY im_prop_name ASC";
		$this->mysql->select_table ( "im_prop_id" );
		
		if (! empty ( $this->mysql->table )) {
			return array(
					"list" => $this->mysql->table,
					"listBuild" => $this->mysql->buld_table);
		} else
			return $res;
	}
	private function updateCountViews($id) {
		$query = "INSERT INTO immovables_stat (`im_id`, `wiev_count`) VALUES ({$id}, 1) ON DUPLICATE KEY UPDATE wiev_count = wiev_count + 1;";
		if (! mysql_query ( $query ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE immovables_stat" );
		return;
	}
	public function saveItem($param) {
		$return['success'] = false;
		foreach ( $param as $key => $value ) {
			$param[$key] = (! empty ( $value ) ? $value : "null");
		}
		$param['im_prace_sq'] = round ( $param['im_prace'] / $param['im_space'] );
		$param['im_is_sale'] = ($param['im_is_sale'] ? "1" : "null");
		$param['im_is_rent'] = ($param['im_is_rent'] ? "1" : "null");
		
		if ($param['im_id'] != null) {
			$sql = "INSERT INTO `immovables`(`im_sale_id`, `im_catalog_id`,  `im_array_id`, `im_region_id`, `im_a_region_id`, `im_city_id`, `im_area_id`, `im_adress_id`, 
					`im_adress_house`, `im_prace`, `im_prace_old`, `im_prace_sq`, `im_prace_day`, `im_prace_manth`, `im_space`, `im_space_value_id`, `hide`, 
					`im_is_sale`, `im_is_rent`, `im_date_add`, `im_adress_flat`, `im_title`, 
					`user_tel`, `im_is_special`) VALUES ('', '{$param['im_catalog_id']}','{$param['im_array_id']}','{$param['im_region_id']}','{$param['im_a_region_id']}',
					 '{$param['im_city_id']}','{$param['im_area_id']}','{$param['im_adress_id']}','{$param['im_adress_house']}',
					{$param['im_prace']},{$param['im_prace']},{$param['im_prace_sq']},{$param['im_prace_day']},{$param['im_prace_manth']},{$param['im_space']},'{$param['im_space_value_id']}','hide',
					{$param['im_is_sale']},{$param['im_is_rent']},NOW(),'{$param['im_adress_flat']}','{$param['im_title']}','{$param['tel']}',{$param['im_is_special']})";
			
			if (! mysql_query ( $sql )) {
				echo $return['generalError'] = "error {$sql}";
				return $return;
			}
			$return["id"] = mysql_insert_id ();
			$return['success'] = true;
		} else {
			// $arr_update = array(
			// "hide" => "'" . ($array['hide'] ? "show" : "hide") . "',",
			// "is_show_index" => ($array['is_show_index'] ? "1" : "0") . ",",
			// "news_description" => "'" . mysql_real_escape_string ( $array['news_description'] ) . "',",
			// "news_summary" => "'" . mysql_real_escape_string ( $array['news_summary'] ) . "',",
			// "news_title" => "'" . $array['news_title'] . "',",
			// "news_url" => "'" . ($array['news_url'] ? $array['news_url'] : translitStrlover ( $array['news_title'] )) . "',",
			// "news_w_description" => "'" . $array['news_w_description'] . "',",
			// "news_w_keywords" => "'" . $array['news_w_keywords'] . "',",
			// "type_id" => "'" . $array['type_id'] . "',",
			// "news_w_title" => "'" . $array['news_w_title'] . "',",
			// "pos" => ($array['pos'] ? $array['pos'] : "null"));
			// $Data = new mysql_select ( "news" );
			// $Data->update_table ( "WHERE news_id = '{$array['news_id']}' and lang_id={$_COOKIE['lang_id']}", $arr_update );
			// $return['success'] = true;
		}
		return $return;
	}
	public function saveItemProperties($param) {
		$lang_f = 2;
		foreach ( $param as $key => $value ) {
			if ($key != 'im_id' and $key != 'retention' and $key != 'Clear') {
				$FieldTupe = substr ( substr ( $key, 0, 2 ), 0, 1 );
				$key = substr ( $key, 2, strlen ( $key ) );
				
				if (! empty ( $value )) {
					//
					if ($FieldTupe == 's') {
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
					('{$key}', '{$param[im_id]}', '{$_COOKIE[lang_id]}','', '" . mysql_escape_string ( $value ) . "', '') ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '" . mysql_escape_string ( $value ) . "', im_prop_value='', im_prop_value_dict_list='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
							('{$key}', '{$param[im_id]}', '{$lang_f}','', '" . mysql_escape_string ( $value ) . "', '') ON DUPLICATE KEY UPDATE im_prop_value_dict_id = '" . mysql_escape_string ( $value ) . "', im_prop_value='', im_prop_value_dict_list='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					}
					//
					if ($FieldTupe == 't') {
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
					('{$key}', '{$param[im_id]}', '{$_COOKIE[lang_id]}','" . mysql_escape_string ( $value ) . "', '', '') ON DUPLICATE KEY UPDATE im_prop_value = '" . mysql_escape_string ( $value ) . "', im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
								('{$key}', '{$param[im_id]}', '{$lang_f}','', '', '') ON DUPLICATE KEY UPDATE im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					}
					//
					if ($FieldTupe == 'm') {
						$PostField = PostField ( $value );
						if (! empty ( $PostField )) {
							$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
					('{$key}', '{$param[im_id]}', '{$_COOKIE[lang_id]}','', '', '" . mysql_escape_string ( $PostField ) . "') ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '" . mysql_escape_string ( $PostField ) . "', im_prop_value='', im_prop_value_dict_id='';";
							if (! mysql_query ( $query ))
								throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
							$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
						('{$key}', '{$param[im_id]}', '{$lang_f}','', '', '" . mysql_escape_string ( $PostField ) . "') ON DUPLICATE KEY UPDATE im_prop_value_dict_list = '" . mysql_escape_string ( $PostField ) . "', im_prop_value='', im_prop_value_dict_id='';;";
							if (! mysql_query ( $query ))
								throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
						}
					}
					//
					if ($FieldTupe == 'c') {
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
					('{$key}', '{$param[im_id]}', '{$_COOKIE[lang_id]}','" . mysql_escape_string ( $value ) . "', '', '')
					ON DUPLICATE KEY UPDATE im_prop_value = '" . mysql_escape_string ( $value ) . "', im_prop_value_dict_id='', im_prop_value_dict_list='';";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
						$query = "INSERT INTO im_properties_info (`im_prop_id`, `im_id`, `lang_id`, `im_prop_value`, `im_prop_value_dict_id`, `im_prop_value_dict_list`) VALUES
					('{$key}', '{$param[im_id]}', '{$lang_f}','', '', '') ON DUPLICATE KEY UPDATE `lang_id`= VALUES(`lang_id`), im_prop_value_dict_id='', im_prop_value_dict_list='';;";
						if (! mysql_query ( $query ))
							throw new ExceptionMySQL ( mysql_error (), $query, "ERROR INSERT or UPDATE IM_PROP_INFO" );
					}
				}
			}
		}
		return;
	}
	public function saveItemImages($param) {
		return null;
	}
	public function saveItemSummary($param) {
		$return['success'] = false;
		if (!$param["im_su_id"]) {
			$sql = "INSERT INTO `immovables_summary`(`im_id`, `lang_id`, `im_su_text`) VALUES ({$param['im_id']},'4c5d58cd3898c','{$param['im_su_text']}')";
			if (! mysql_query ( $sql )) {
				echo $return['generalError'] = "error {$sql}";
				return $return;
			}
			$return["id"] = mysql_insert_id ();
			$return['success'] = true;
		}
		return $return;
	}
}
function PostField($PostFieldValue) {
	$update = "";
	for($i = 0; $i < count ( $PostFieldValue ); $i ++) {
		if (! empty ( $PostFieldValue[$i] ))
			$update .= "{$PostFieldValue[$i]} ";
	}
	if (empty ( $update ))
		return;
	return substr ( $update, 0, strlen ( $update ) - 1 );
}
