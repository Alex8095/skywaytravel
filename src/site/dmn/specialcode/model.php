<?php
/*	SPECIAL CODE	*/
class TSpecialCode extends Controller {
	public $dictionaries;
	public function getPage($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "goods_stores", "order by date desc" );
		$Data->select_table_query ( "select c.*, d.dict_name as dealer_name from goods_stores c LEFT JOIN dictionaries d ON c.dialer_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]} where gs_dealer_sc != '' order by c.gs_id desc" );
		//
		$tListData = $this->Template ( "/dmn/specialcode/template/list_special_codes.phtml", array ('Data' => $Data->table ) );
		//$tAction = $this->Template ( "/dmn/specialcode/template/action_specail_code.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	public function getList($array) {
		$return = array ();
		//
		$Data = new mysql_select ( "t_dealer_codes", "order by date desc" );
		$Data->select_table_query ( "select c.*, d.dict_name as dealer_name from goods_stores c LEFT JOIN dictionaries d ON c.dialer_id = d.dict_id and d.lang_id = {$_COOKIE[lang_id]} order by c.gs_id desc" );
		//
		$DealerData = new mysql_select ( " ", "where value_id  date desc" );
		$DealerData->select_table_query ( "select v.value, v.option_id from eav_attribute_option_value v left join eav_attribute_option o on o.option_id = v.option_id where o.attribute_id = 128 and store_id = 0" );
		return $tListData = $this->Template ( "/dmn/specialcode/template/list_special_codes.phtml", array ('Data' => $Data->table, "DealerData" => $DealerData->table ) );
	}
	public function getCode($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 30 ); //
		$dealerDataDict = $this->dictionaries->my_dct;
		$Data = NULL;
		if (isset ( $array ["c_id"] )) {
			$Data = new mysql_select ( "goods_stores", "order by date" );
			$Data = $Data->select_table_id ( "where gs_id = {$array[c_id]}" );
		}
		return $this->Template ( "/dmn/specialcode/template/form_specail_code.phtml", array ('Data' => $Data, "DealerData" => $dealerDataDict ) );
	}
	public function save($array) {
		$sql = "insert into t_dealer_codes(code, d_id, is_activated, date, c_md) values('$array[code]', '$array[d_id]', 0, NOW(), '" . md5 ( $array ['code'] ) . "')";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "TBanners";
		$return ['success'] = true;
		return $return;
	}
	public function update($array) {
		$return = array ();
		return $return;
	}
	public function delete($array) {
		$arr_update = array ("gs_dealer_sc" => "''" );
		$Data = new mysql_select ( "goods_stores" );
		$Data->update_table ( "WHERE gs_id = {$array['id']}", $arr_update );
		$return ['conf'] = "TSpecialCode";
		$return ['success'] = true;
		return $this->getPage ( array () );
	}
	public function getDictionaris() {
		#объявляем класс словаря
		$this->dictionaries = new dictionariesClass ( );
		#формируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		#формируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}
}


