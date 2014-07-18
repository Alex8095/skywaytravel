<?php
/**
 * @author Alex Tsurkin
 *
 */
class catalogProviderClass extends providerClass {

	/**
	 *
	 * @param array() $param        	
	 * @return multitype:NULL Ambigous <unknown, multitype:> |NULL
	 */
	public function GetCatalogList($param = array()) {
		$res = null;
		$query = "";
		if (! empty ( $param ['dict_id'] ))
			$query .= " and c.dict_id='{$param ["dict_id"]}'";
		if (! isset ( $_COOKIE ['admin_login'] ))
			$query .= " and c.hide = 1";
		if (! empty ( $param ['parent_id'] ))
			$query .= " and c.parent_id='{$param ["parent_id"]}'";
		if (! empty ( $param ['ct_id'] ))
			$query .= " and c.ct_id='{$param ["ct_id"]}'";
		if (! empty ( $param ['ct_url'] ))
			$query .= " and c.ct_url='{$param ["ct_url"]}'";
		$catData = new mysql_select ( $this->table );
		$catData->select_table_query ( "select c.*, ci.ct_photo_id, ci.ct_photo_file_type from {$this->table} c
										left join ct_photos ci on ci.ct_id = c.ct_id and ci.is_main = 1 and ci.lang_id={$_COOKIE['lang_id']}
										WHERE c.lang_id = {$_COOKIE['lang_id']} {$query} ORDER BY pos", $this->id );
		$this->resTable = $catData->table;
		$this->resBuildTable = $catData->buld_table;
		if (! empty ( $catData->table )) {
			return array ("resTable" => $this->resTable,"resBuildTable" => $this->resBuildTable );
		} else
			return $res;
	}

	public function GetCatalogWhithInfo($param = array()) {
		$queryPhoto = "";
		if (! empty ( $param ['ct_photo_type_id'] ))
			$queryPhoto = " and ci.ct_photo_type_id='{$param ["ct_photo_type_id"]}'";
		$queryCat = "";
		if (! empty ( $param ['dict_id'] ))
			$queryCat = " and c.dict_id='{$param ["dict_id"]}'";
		if (! empty ( $param ['ct_id'] ))
			$queryCat .= " and c.ct_id='{$param ["ct_id"]}'";
		if (! empty ( $param ['city_id'] ))
			$queryCat .= " and s.city_id ='{$param ["city_id"]}'";
		if (! empty ( $param ['brend_id'] ))
			$queryCat .= " and s.brand_id ='{$param ["brend_id"]}'";
		if (! empty ( $param ['hide'] ))
			$queryCat .= " and c.hide = 1";
		$catData = new mysql_select ( 'catalog' );
		$catData->select_table_query ( "select c.*, ci.ct_photo_id, ci.ct_photo_file_type, ci.is_main, b.ct_name as brand_name, d.dict_name, s.city_id, s.brand_id
										from catalog c
										left join shop_info s on c.ct_id = s.ct_id
										left join catalog b on s.brand_id = b.ct_id and b.lang_id = {$_COOKIE[lang_id]}
										left join dictionaries d on s.city_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]}
										left join ct_photos ci on ci.ct_id = c.ct_id {$queryPhoto} and ci.lang_id = {$_COOKIE[lang_id]}
										WHERE c.lang_id = {$_COOKIE[lang_id]} {$queryCat} ORDER BY c.pos", "ct_id" );
		$this->resTable = $catData->table;
		$this->resBuildTable = $catData->buld_table;
		if (! empty ( $catData->table )) {
			return array ("resTable" => $this->resTable,"resBuildTable" => $this->resBuildTable );
		} else
			return $res;
	}

	public function InsertNewCatalogItem($array = array()) {
		$array ['ct_id'] = ($array ['ct_id'] ? $array ['ct_id'] : uniqid ());
		$array ['hide'] = ($array ['hide'] ? $array ['hide'] : 'NULL');
		$array ['ct_url'] = translitStrlover ( $array ['ct_name'] );
		$cl_sel_pages = new mysql_select ( 'catalog' );
		$ParentData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and ct_id ='{$array[parent_id]}'" );
		if (empty ( $array ["pos"] )) {
			$cl_sel_pages = new mysql_select ( 'catalog' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and dict_id ='{$array[dict_id]}' and parent_id ='{$_POST[parent_id]}' order by pos desc" );
			$array ["pos"] = $PosData ["pos"] + 1;
		}
		$level = $ParentData ["ct_level"] + 1;
		
		$query = "INSERT INTO
							catalog
						SET
							ct_id 			= '{$array['ct_id']}',
							parent_id  		= '{$array['parent_id']}',
							hide  			= {$array['hide']},
							ct_name			= '" . mysql_real_escape_string ( $array ['ct_name'] ) . "',
							ct_title		= '" . mysql_real_escape_string ( $array ['ct_title'] ) . "',
							dict_id			= '{$array['dict_id']}',
							ct_url			= '" . mysql_real_escape_string ( $array ['ct_url'] ) . "',
							lang_id			= #lang_id#,
							ct_level		= {$level},
							date			= NOW(),
							pos				= {$array['pos']},
							ct_text			= '" . mysql_real_escape_string ( $array ['ct_text'] ) . "',
							ct_description	= '" . mysql_real_escape_string ( $array ['ct_description'] ) . "',
							ct_w_title		= '" . mysql_real_escape_string ( $array ['ct_w_title'] ) . "',
							ct_w_keywords	= '" . mysql_real_escape_string ( $array ['ct_w_keywords'] ) . "',
							ct_w_description	= '" . mysql_real_escape_string ( $array ['ct_w_description'] ) . "';";
		if (! mysql_query ( str_replace ( "#lang_id#", 1, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" + $query );
		if (! mysql_query ( str_replace ( "#lang_id#", 2, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" + $query );
		if (! mysql_query ( str_replace ( "#lang_id#", 3, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" + $query );
		return $array ['ct_id'];
	}

	public function insertImage($array) {
		if (empty ( $array ["ct_photo_order"] )) {
			$cl_sel_pages = new mysql_select ( 'ct_photos' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and ct_id ='{$_POST[ct_id]}' order by ct_photo_order desc" );
			$array ["ct_photo_order"] = $PosData ["ct_photo_order"] + 1;
		}
		$array ['is_main'] = ($array ['is_main'] ? $array ['is_main'] : 'NULL');
		$query = "INSERT INTO
							ct_photos
						SET
							ct_photo_id 		= '{$array['ct_photo_id']}',
							ct_photo_type_id  	= '{$array['ct_photo_type_id']}',
							ct_id  				= '{$array['ct_id']}',
							ct_photo_order		= '{$array['ct_photo_order']}',
							ct_photo_file_type	= '{$array['ct_photo_file_type']}',
							is_main				= {$array['is_main']},
							lang_id				= #lang_id#,
							ct_photo_title		= '{$array['ct_photo_title']}';";
		if (! mysql_query ( str_replace ( "#lang_id#", 1, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		if (! mysql_query ( str_replace ( "#lang_id#", 2, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
		if (! mysql_query ( str_replace ( "#lang_id#", 3, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	}

	public function insertImageLang($array, $lang_id = 1) {
		if (empty ( $array ["ct_photo_order"] )) {
			$cl_sel_pages = new mysql_select ( 'ct_photos' );
			$PosData = $cl_sel_pages->select_table_id ( "WHERE lang_id = {$_COOKIE[lang_id]} and ct_id ='{$_POST[ct_id]}' order by ct_photo_order desc" );
			$array ["ct_photo_order"] = $PosData ["ct_photo_order"] + 1;
		}
		$array ['is_main'] = ($array ['is_main'] ? $array ['is_main'] : 'NULL');
		$query = "INSERT INTO
							ct_photos
						SET
							ct_photo_id 		= '{$array['ct_photo_id']}',
							ct_photo_type_id  	= '{$array['ct_photo_type_id']}',
							ct_id  				= '{$array['ct_id']}',
							ct_photo_order		= '{$array['ct_photo_order']}',
							ct_photo_file_type	= '{$array['ct_photo_file_type']}',
							is_main				= {$array['is_main']},
							lang_id				= #lang_id#,
							ct_photo_title		= '{$array['ct_photo_title']}';";
		if (! mysql_query ( str_replace ( "#lang_id#", $lang_id, $query ) ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	}

	public function deleteImageForType($ct_id, $ct_photo_type_id) {
		// echo "delete from ct_photos where ct_id = '{$ct_id}' and ct_photo_type_id = '$ct_photo_type_id'";
		if (! mysql_query ( "delete from ct_photos where ct_id = '{$ct_id}' and ct_photo_type_id = '$ct_photo_type_id'" ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	}

	public function deleteImage($ct_photo_id) {
		if (! mysql_query ( "delete from ct_photos where ct_photo_id = '{$ct_photo_id}'" ))
			throw new ExceptionMySQL ( mysql_error (), $query, "ERROR" );
	}

	public function GetCatalogItemImages($param = array()) {
		$query = "";
		if (! empty ( $param ['dict_id'] ))
			$query .= " and c.dict_id='{$param ["dict_id"]}'";
		if (! empty ( $param ['ph_dict_id'] ))
			$query .= " and cf.ct_photo_type_id='{$param ["ph_dict_id"]}'";
		if (! empty ( $param ['ph_dicts_id'] ))
			$query .= " and cf.ct_photo_type_id IN ({$param ["ph_dicts_id"]})";
		if (! empty ( $param ['hide'] ))
			$query .= " and c.hide = 1";
		if (! empty ( $param ['ct_id'] ))
			$query .= " and cf.ct_id = '{$param ['ct_id']}'";
		$Data = new mysql_select ();
		$Data->select_table_query ( "select cf.*, c.ct_name, c.lang_id, d.dict_name
									 from ct_photos cf
									 left join catalog c on cf.ct_id = c.ct_id and c.lang_id = {$_COOKIE[lang_id]} 
									 left join dictionaries d on cf.ct_photo_type_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]}
									 where cf.lang_id = {$_COOKIE[lang_id]} {$query}
									 order by cf.ct_photo_order", "ct_photo_id" );
		$this->resTable = $Data->table;
		$this->resBuildTable = $Data->buld_table;
		if (! empty ( $Data->table )) {
			return array ("resTable" => $this->resTable,"resBuildTable" => $this->resBuildTable );
		} else
			return $res;
	}

}
