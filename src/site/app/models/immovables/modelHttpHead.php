<?php
class immovablesHttpHeadModelClass extends immovablesModelClass {
	public function __construct($parent, $dictionaries) {
		parent::__construct ( $parent->provider );
		$this->dictionaries = $dictionaries;
		// $this = $parent;
	}
	/**
	 *
	 * @return string
	 */
	public function getImmovableTitle() {
		$ret = sprintf ( "%s - %s, %s, %s %s, %s %s, %s y.e", getLangString ( $this->item["im_catalog_id"] . "_item" ), $this->item["im_code"], $this->dictionaries->getDictValue ( $this->item, "im_city_id" ), $this->dictionaries->getDictValue ( $this->item, "im_adress_id" ), $this->item["im_adress_house"], $this->item["im_space"], $this->dictionaries->getDictValue ( $this->item, "im_space_value_id" ), ($this->routingObj->getAction () == "detailssale") ? $this->item["im_prace"] : $this->item["im_prace_manth"] );
		return $ret;
	}
	/**
	 * функция формирует rel в head для пейджинга (список недвижимости)
	 *
	 * @param unknown $param        	
	 * @param string $typeImmovable        	
	 * @param string $typeImmovableSaleRent        	
	 */
	public function buildImmovablesRelLink($param, $typeImmovable = "flat", $typeImmovableSaleRent = "sale") {
		global $renderHtmlLinkObj;
		if ($this->provider->pager->total > 0) {
			$page_id = (! empty ( $param["page_id"] ) ? $param["page_id"] : 1);
			if ($page_id != 1)
				$renderHtmlLinkObj->addRel ( "prev", sprintf ( "http://%s/%s/%s/%s", $_SERVER['HTTP_HOST'], $typeImmovable, $typeImmovableSaleRent, $page_id - 1 ) . $this->provider->pagerparamafter );
			if ($page_id != round ( $this->provider->pager->total / $_COOKIE["im_f_show_pnumber"] ))
				$renderHtmlLinkObj->addRel ( "next", sprintf ( "http://%s/%s/%s/%s", $_SERVER['HTTP_HOST'], $typeImmovable, $typeImmovableSaleRent, $page_id + 1 ) . $this->provider->pagerparamafter );
		}
		$renderHtmlLinkObj->addRel ( "canonical", "каноническая страница" );
	}
	/**
	 * функция формирует метатеги в head для пейджинга (список недвижимости)
	 *
	 * @param unknown $param        	
	 * @param string $typeImmovable        	
	 * @param string $typeImmovableSaleRent        	
	 * @return multitype:string
	 */
	public function buildImmovablesAppData($param, $typeImmovable = "flat", $typeImmovableSaleRent = "sale") {
		global $arWords;
		$ret = "";
		$replaceArray = array();
		$replaceArray["page_id"] = $param["page_id"];
		require_once DOC_ROOT . '/app/models/immovables/metatag.php';
		$categoryMetateg = "default";
		/* city/kiev */
		$paramIssetValue = $this->isParamIssetValue ( $param, 2 );
		$replaceArray["city"] = "";
		if ($paramIssetValue["isset"]) {
			$categoryMetateg = "city";
			$replaceArray["city"] = $paramIssetValue["data"];
			if (! isset ( $paramIssetValue["id"][1] ) && ($paramIssetValue["id"][0] == "4c3eb839f144e"))
				$categoryMetateg = "kiev";
		}
		/* area */
		$paramIssetValue = $this->isParamIssetValue ( $param, 3 );
		$replaceArray["area"] = "";
		if ($paramIssetValue["isset"]) {
			if ($categoryMetateg != "kiev")
				$categoryMetateg = "area";
			$replaceArray["area"] = $paramIssetValue["data"];
		}
		$paramIssetValue = $this->isParamIssetValue ( $param, 4 );
		$replaceArray["array"] = "";
		if ($paramIssetValue["isset"]) {
			$replaceArray["array"] = ", " . $paramIssetValue["data"];
		}
		/* im_adress_id */
		if (! empty ( $param["im_adress_id"] )) {
			$categoryMetateg = "streat";
		}
		/* room */
		$paramIssetValue = $this->isParamIssetRooms ( $param );
		if ($paramIssetValue["isset"]) {
			$categoryMetateg = "room";
			$replaceArray["rooms"] = $paramIssetValue["data"];
		}
		/* area_room */
		if ($categoryMetateg == "room" && ! empty ( $replaceArray["area"] ))
			$categoryMetateg = "area_room";
		if (isset ( $param["page_id"] )) {
			if ($categoryMetateg == "default" && $param["page_id"] != 1)
				$categoryMetateg = "default_page";
		}
		if (empty ( $categoryMetateg ))
			return;
		$categoryMetategArray = $matategImmovables[$typeImmovableSaleRent][$categoryMetateg];
		/* replace	array */
		$replaceArray["im_adress_id"] = ($param["im_adress_id"] ? substr ( $param["im_adress_id"], 0, strlen ( $param["im_adress_id"] ) - 5 ) : "");
		$replaceArray["metateg_immovable_category"] = $arWords["metateg_immovable_category"][$typeImmovable];
		$replaceArray["metateg_immovable_category_y"] = $arWords["metateg_immovable_category_y"][$typeImmovable];
		$ret = array(
				"title" => $this->strreplace ( $categoryMetategArray["title"], $replaceArray ),
				"keywords" => "keywords",
				"description" => $this->strreplace ( $categoryMetategArray["description"], $replaceArray ),
				"h" => $this->strreplace ( $categoryMetategArray["h"], $replaceArray ),
				"categoryMetateg" => $categoryMetateg);
		return $ret;
	}
	/**
	 * поиск вхождение территориальных параметров
	 *
	 * @param unknown $param        	
	 * @param unknown $searchVarchar        	
	 * @return multitype:boolean string
	 */
	private function isParamIssetValue($param, $searchVarchar) {
		$ret = array(
				"isset" => false);
		foreach ( $param as $key => $value ) {
			$pos = strpos ( $key, "_" );
			if ($pos && $key[14] == $searchVarchar) {
				$ret["isset"] = true;
				$id = substr ( $key, 0, $pos );
				$ret["id"][] = $id;
				$ret["data"] .= $this->dictionaries->getItemValue ( $id ) . ", ";
			}
		}
		if ($ret["data"])
			$ret["data"] = substr ( $ret["data"], 0, strlen ( $ret["data"] ) - 2 );
		return $ret;
	}
	/**
	 * поиск вхождение параметров комнат
	 *
	 * @param unknown $param        	
	 * @return multitype:boolean string
	 */
	private function isParamIssetRooms($param) {
		$ret = array(
				"isset" => false);
		foreach ( $param as $key => $value ) {
			if (substr ( $key, 0, 2 ) == "l_") {
				$ret["isset"] = true;
				foreach ( $value as $ikey => $ivalue )
					$ret["data"] .= $ivalue . ", ";
			}
		}
		if ($ret["data"])
			$ret["data"] = substr ( $ret["data"], 0, strlen ( $ret["data"] ) - 2 );
		return $ret;
	}
	/**
	 * замена значений в строке
	 *
	 * @param unknown $str        	
	 * @param unknown $array        	
	 * @return mixed
	 */
	private function strreplace($str, $array) {
		foreach ( $array as $key => $value ) {
			$str = str_replace ( sprintf ( "#%s#", $key ), $value, $str );
		}
		return $str;
	}
}