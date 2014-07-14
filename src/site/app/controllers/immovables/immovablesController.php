<?php
class immovablesController extends aControllerClass {
	public function index($param) {
		$this->redirect ( "flat/sale" );
		exit ();
	}
	public function partialAdvancedSearchForm($param) {
		$model = new immovablesSearchModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->buildAdvasedSearchForm ( $param );
		global $arWords;
		global $routingObj;
		$model->buildImmovablesProperties ( $arWords["typeCatImDictOfController"][$routingObj->getController ()] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/formsearch" );
	}
	public function partialFilterSearchForm($param) {
		$model = new immovablesSearchModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->buildAdvasedSearchForm ( $param );
		global $arWords;
		global $routingObj;
		$model->buildImmovablesProperties ( $arWords["typeCatImDictOfController"][$routingObj->getController ()] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/formsearchfilter" );
	}
	/* list */
	/**
	 * новые обьекты
	 *
	 * @param unknown $param        	
	 * @return string
	 */
	public function novue($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$param["hide"] = "show";
		$param["limit"] = ($param["limit"] ? $param["limit"] : "10");
		$model->getList ( $param );
		if ($model->list) {
			$model->buildDictionaries ();
			$param["im_ids"] = $model->buildImmovablesIdForPropertiesQuery ();
			$model->getPropertiesList ( $param );
			unset ( $param["im_ids"] );
			$model->buildPropertiesData ();
		}
		return $this->View ( array(
				"Model" => $model), "immovables/list/new" );
	}
	public function partialNovue($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/list/new" );
	}
	public function partialList($param) {
		$param = 1;
		return $this->partialView ( array(), "/immovables/hotlist" );
	}
	public function partialListLink($param) {
		$this->buildDictionaries ();
		$this->provider->mysql = new mysql_select ( "im_links", "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY RAND(40)" );
		$this->provider->mysql->select_table ( "il_id" );
		return $this->partialView ( array(
				"Data" => $this->provider->mysql->table,
				"Dict" => $this->dictionaries), "/immovables/linklist" );
	}
	public function partialListHot($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array();
		$categotyImmovables = array(
				"4c3ec3ec5e9b5",
				"4c3ec3ec5e9b7",
				"4c3ec51d537c0",
				"4c3ec51d537c2",
				"4c3ec51d537c3");
		foreach ( $categotyImmovables as $key => $value ) {
			$model->getListHotPrice ( array(
					"is_hot" => true,
					"hide" => "show",
					"im_catalog_id" => $value,
					"limit" => 10) );
			if ($model->list)
				$Data = array_merge ( $Data, $model->list );
		}
		$model->list = $Data;
		$model->buildDictionaries ();
		return $this->partialView ( array(
				"Model" => $model,
				"Data" => $Data,
				"itemWidth" => $param["itemWidth"],
				"Dictionaries" => $this->dictionaries,
				"title" => getLangString ( "ImDivListHeaderHot" ),
				"cssClass" => "links_block"), "/immovables/minpricelist" );
	}
	public function partialListMinPrice($param) {
		$this->buildDictionaries ();
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$Data = array();
		$categotyImmovables = array(
				"4c3ec3ec5e9b5",
				"4c3ec3ec5e9b7",
				"4c3ec51d537c0",
				"4c3ec51d537c2",
				"4c3ec51d537c3");
		foreach ( $categotyImmovables as $key => $value ) {
			$model->getListHotPrice ( array(
					"is_hot" => true,
					"hide" => "show",
					"im_catalog_id" => $value,
					"limit" => 15) );
			if ($model->list)
				$Data = array_merge ( $Data, $model->list );
		}
		return $this->partialView ( array(
				"Data" => $Data,
				"Dictionaries" => $this->dictionaries,
				"title" => getLangString ( "ImDivListHeaderPrice" ),
				"cssClass" => "minprice"), "/immovables/minpricelist" );
	}
	public function search($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		if (empty ( $param["id"] )) {
			$this->isPartial = true;
			exit ();
		}
		$param["id"] = translitimcode ( toupper ( $param["id"] ) );
		if (! strpos ( $param["id"], "," ) || ! strpos ( $param["id"], "," )) {
			$model->getItemByCode ( $param["id"] );
			if (empty ( $param["canRedirect"] ))
				if ($model->item) {
					$this->redirect ( $model->getitemlink () );
					exit ();
				}
		}
		$param["hide"] = "show";
		$param["im_codes"] = $model->buildImmovablesCodeForStingToStringQuery ( $param["id"] );
		$model->getList ( $param );
		$model->buildDictionaries ();
		$paramAll["im_ids"] = $model->buildImmovablesIdForPropertiesQuery ();
		if (! empty ( $paramAll["im_ids"] )) {
			$model->getPropertiesList ( $paramAll );
			$model->buildPropertiesData ();
		}
		if ($param["canRedirect"] == "true") {
			return $this->view ( array(
					"Model" => $model,
					"param" => $param) );
		}
		return $this->partialView ( array(
				"Model" => $model), "immovables/search" );
	}
	/* similar */
	public function similarList($param) {
		$this->buildDictionaries ();
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->buildDictionaries ();
		return $this->partialView ( array(
				"Model" => $model) );
	}
	/* yandex */
	public function getImmovablesListYmap($param) {
		global $arWords;
		set_time_limit ( 10000 );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$param["hide"] = "show";
		$param["im_geopos_not_null"] = true;
		
		if (! empty ( $param['region_param'] )) {
			$arr = explode ( "&", $param['region_param'] );
			foreach ( $arr as $key => $value ) {
				if (! empty ( $value )) {
					$arrinner = explode ( ":", $value );
					$param[$arrinner[0]] = $arrinner[1];
				}
			}
			unset ( $arrinner );
			unset ( $param['region_param'] );
			// devLogs::_printr ( $param );
		}
		
		// $param["action"] = "ymap";
		if (empty ( $param["action"] ))
			unset ( $param["im_catalog_id"] );
		$param["SearchIsAdvasedChecked"] = 1;
		$model->getListPager ( $param, 1, "", ($param["limit"] ? $param["limit"] : 1000), "getListPagerMap" );
		// return $this->View ( array( "Model" => $model) ) ;
		return $this->getJson ( $model->list );
		/*
		 * $ret = array (); if ($model->list) { $model->buildDictionaries (); $param ["im_ids"] = $model->buildImmovablesIdForPropertiesQuery (); $model->getPropertiesList ( $param ); unset ( $param ["im_ids"] ); $model->buildPropertiesData (); $m = new ModuleSiteIm ( array (), $arWords, $Model->dictionaries, $Model->propertiesData->ImPropData, $Model->propertiesData->ImPropArrData ); foreach ( $model->list as $key => $value ) { $model->item = $value; if (($param ["im_is_rent"] && $value ["im_is_rent"]) || (empty ( $param ["action"] ) && $value ["im_is_rent"])) { $value ["rentHtml"] = appHtmlClass::partial ( "immovables/detailsymap", array ( "Model" => $model, "m" => $m, "typeRentSale" => "rent" ) ); $ret [] = $value; } if (($param ["im_is_sale"] && $value ["im_is_sale"] || (empty ( $param ["action"] ) && $value ["im_is_sale"]))) { $value ["saleHtml"] = appHtmlClass::partial ( "immovables/detailsymap", array ( "Model" => $model, "m" => $m, "typeRentSale" => "sale" ) ); $ret [] = $value; } } } // print_r($ret); // print_r($model->list); return $this->View ( array( "Model" => $ret) ); return $this->getJson ( $ret );
		 */
	}
	public function ymap($param) {
		set_time_limit ( 10000 );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$param["hide"] = "show";
		$param["limit"] = "10";
		$param["im_geopos_not_null"] = true;
		$model->getList ( $param );
		// $model->getImmovablesListToYmap ();
		return $this->View ( $model->list );
	}
	/* details */
	public function detailsbycode($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$param["hide"] = "show";
		$param["im_code"] = translitimcode ( toupper ( $param["im_code"] ) );
		$model->getItemByCode ( $param["im_code"] );
		if (! $model->item) {
			$this->redirect ( "immovables/search?canRedirect=true&id=" . $param["im_code"] );
			exit ();
		}
		$this->routingObj->setParamItem ( "type_cat", ($model->item["im_is_sale"] ? "sale" : "rent") );
		$this->routingObj->setParamItem ( "im_id", $model->item["im_id"] );
		$model->buildDictionaries ();
		$model->getItemProperties ( $model->item["im_id"] );
		global $arWords;
		$m = new ModuleSiteIm ( array(), $arWords, $model->dictionaries, $model->propertiesData->ImPropData, $model->propertiesData->ImPropArrData );
		$this->buildImmovablesAppData ( $model, ($model->item["im_is_sale"] ? "sale" : "rent"), $m );
		return $this->View ( array(
				"Model" => $model,
				"appDataObj" => $this->appDataObj,
				"m" => $m), sprintf ( "immovables/details%s", $this->routingObj->getParamItem ( "type_cat" ) ) );
	}
	public function detailsrent($param) {
		$this->routingObj->setParamItem ( "type_cat", "rent" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$param["hide"] = "show";
		$model->getItem ( $param["im_id"] );
		$model->getItemImages ( $param["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		if ($param["COOKIE_comparing"])
			$_COOKIE["comparing"] = $param["COOKIE_comparing"];
		$this->buildmetahmlforsocial ( $model );
		$model->buildDictionaries ();
		$model->getItemProperties ( $param["im_id"] );
		global $arWords;
		$m = new ModuleSiteIm ( array(), $arWords, $model->dictionaries, $model->propertiesData->ImPropData, $model->propertiesData->ImPropArrData );
		$this->buildImmovablesAppData ( $model, "rent", $m );
		return $this->View ( array(
				"Model" => $model,
				"appDataObj" => $this->appDataObj,
				"m" => $m) );
	}
	public function detailssale($param) {
		$this->routingObj->setParamItem ( "type_cat", "sale" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$param["hide"] = "show";
		$model->getItem ( $param["im_id"] );
		$model->getItemImages ( $param["im_id"] );
		if (! $model->item)
			$this->redirectToErrorPage ();
		if ($param["COOKIE_comparing"])
			$_COOKIE["comparing"] = $param["COOKIE_comparing"];
		$this->buildmetahmlforsocial ( $model );
		$model->buildDictionaries ();
		$model->getItemProperties ( $param["im_id"] );
		global $arWords;
		$m = new ModuleSiteIm ( array(), $arWords, $model->dictionaries, $model->propertiesData->ImPropData, $model->propertiesData->ImPropArrData );
		$this->buildImmovablesAppData ( $model, "sale", $m );
		return $this->View ( array(
				"Model" => $model,
				"appDataObj" => $this->appDataObj,
				"m" => $m) );
	}
	private function buildmetahmlforsocial($model) {
		if (! empty ( $model )) {
			global $arWords;
			$this->appDataObj->social["fb"]->url = $model->getitemlink ();
			$this->appDataObj->social["fb"]->image = sprintf ( "%s/files/images/immovables/si_%s", getLangString ( "imageDomain" ), $model->item["im_photo"] );
		}
	}
	public function partailImages($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemImages ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/images" );
	}
	public function partailPlan($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemPlan ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/plan" );
	}
	public function partailVideo($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemVideo ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/video" );
	}
	public function partailSummary($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemSummary ( $param["im_id"] );
		return $this->partialView ( array(
				"Model" => $model), "/immovables/details/summary" );
	}
	private function buildImmovablesAppData($model, $type_sale, $m) {
		global $arWords;
		$this->appDataObj->setTitle ( $model->getImmovablesTitle () );
		$this->appDataObj->setKeyw ( $this->appDataObj->getTitle () );
		$this->appDataObj->setDesc ( $this->appDataObj->getTitle () . ". " . $model->item["im_title"] );
		$this->appDataObj->setPAction ( $type_sale );
		$this->appDataObj->setPController ( $arWords["TypeCatImNameArrIdPAge"][$model->item["im_catalog_id"]] );
		$type_im = $arWords["TypeCatImNameArrIdPAge"][$model->item["im_catalog_id"]];
		$strNav = "";
		if ($model->item["im_region_id"] && $type_im != "flat")
			$strNav .= $this->getStringNavTerLink ( $model, $m, "im_region_id", 1, $type_im, $type_sale );
		if ($model->item["im_a_region_id"])
			$strNav .= $this->getStringNavTerLink ( $model, $m, "im_a_region_id", 1, $type_im, $type_sale );
		if ($model->item["im_city_id"])
			$strNav .= $this->getStringNavTerLink ( $model, $m, "im_city_id", 2, $type_im, $type_sale );
		if ($model->item["im_area_id"])
			$strNav .= $this->getStringNavTerLink ( $model, $m, "im_area_id", 3, $type_im, $type_sale, " р-н." );
		if ($model->item["im_adress_id"])
			$strNav .= $this->getStringNavAdressLink ( $model, $m, "im_adress_id", $type_im, $type_sale );
		$this->appDataObj->setStringNavigation ( $strNav . sprintf ( '<span class="last">%s</span>', $model->item["im_code"] ) );
		return;
	}
	private function getStringNavTerLink($model, $m, $field_name, $i, $category, $type_sale, $appenttext = "") {
		if (! $field_name)
			return;
		global $arWords;
		if (! $model->item[$field_name])
			return;
		$searchLink = $m->urlDictToParent ( $model->item[$field_name], $i );
		$dict_name = $model->dictionaries->getItemValue ( $model->item[$field_name] );
		$ret = sprintf ( '<a href="/%s/%s?%s&action=ImFormSearch" title="%s%s">%s%s</a><span class="next"> > </span>', $category, $type_sale, $searchLink, $dict_name, $appenttext, $dict_name, $appenttext );
		return $ret;
	}
	private function getStringNavAdressLink($model, $m, $field_name, $category, $type_sale) {
		if (! $field_name)
			return;
		global $arWords;
		if (! $model->item[$field_name])
			return;
		$dict_name = $model->dictionaries->getItemValue ( $model->item[$field_name] );
		$ret = sprintf ( '<a href="/%s/%s?im_adress_id=%s&action=ImFormSearch" title="%s">%s</a><span class="next"> > </span>', $category, $type_sale, $dict_name, $dict_name, $dict_name );
		return $ret;
	}
	public function immovableimages($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->getItemImages ( $param["im_id"] );
		return $this->getJson ( $model->imagesList );
	}
	
	/* сравнение обьектов comparing */
	public function sravnenie($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		if (! empty ( $_COOKIE["comparing"] )) {
			//devLogs::_printr ( $_COOKIE["comparing"] );
			$imidsarray = json_decode ( $_COOKIE["comparing"], true );
			$im_ids = "(";
			foreach ( $imidsarray as $key => $value )
				$im_ids .= sprintf ( "'%s',", $key );
			$im_ids = sprintf ( "%s)", substr ( $im_ids, 0, strlen ( $im_ids ) - 1 ) );
			$model->getList ( array(
					"hide" => "show",
					"im_ids" => $im_ids) );
			$model->getPropertiesList ( array(
					"im_ids" => substr ( $im_ids, 1, strlen ( $im_ids ) - 2 )) );
			$model->buildPropertiesData ();
			$model->getPropertiesOnlyGroupList ( null );
		}
		return $this->View ( array(
				"Model" => $model), "immovables/comparing/index" );
	}
	public function comparinglist($param) {
		$ret = array(
				"success" => true,
				"comparing" => null,
				"count" => 0);
		if (! empty ( $_COOKIE["comparing"] )) {
			$ret["comparing"] = $_COOKIE["comparing"];
			$ret["count"] = count ( json_decode ( $_COOKIE["comparing"], true ) );
		}
		return $this->getJson ( $ret );
	}
	public function comparingadditem($param) {
		$ret = array(
				"success" => true);
		if (empty ( $param["im_id"] )) {
			$ret["error"] = "noissetimid";
			$ret["success"] = false;
			return $this->getJson ( $ret );
		}
		$jsonComparing = $_COOKIE["comparing"];
		if (! empty ( $jsonComparing )) {
			$jsonObj = json_decode ( $jsonComparing, true );
			if (! isset ( $jsonObj[$param["im_id"]] )) {
				$jsonObj[$param["im_id"]] = $param["im_id"];
			}
		} else {
			$jsonObj[$param["im_id"]] = $param["im_id"];
		}
		$ret["comparing"] = $jsonObj;
		$jsonComparing = ($jsonObj ? json_encode ( $jsonObj ) : null);
		setcookie ( 'comparing', $jsonComparing, 0, '/' );
		$_COOKIE["comparing"] = $jsonComparing;
		return $this->getJson ( $ret );
	}
	public function comparingremoveitem($param) {
		$ret = array(
				"success" => true);
		if (empty ( $param["im_id"] )) {
			$ret["error"] = "noissetimid";
			$ret["success"] = false;
			return $this->getJson ( $ret );
		}
		$jsonComparing = $_COOKIE["comparing"];
		$jsonObj = "";
		if (! empty ( $jsonComparing )) {
			$jsonObj = json_decode ( $jsonComparing, true );
			if (isset ( $jsonObj[$param["im_id"]] )) {
				unset ( $jsonObj[$param["im_id"]] );
			} else
				$ret["error"] = "noissetitem";
		}
		$ret["comparing"] = $jsonObj;
		$jsonComparing = ($jsonObj ? json_encode ( $jsonObj ) : null);
		setcookie ( 'comparing', $jsonComparing, 0, '/' );
		$_COOKIE["comparing"] = $jsonComparing;
		return $this->getJson ( $ret );
	}
	public function comparingsetsorted($param) {
		if (! empty ( $param["list"] )) {
			$l = explode ( ",", $param["list"] );
			unset ( $l[count ( $l ) - 1] );
			foreach ( $l as $key => $value )
				$ret["comparing"][$value] = $value;
			$jsonComparing = ($ret["comparing"] ? json_encode ( $ret["comparing"] ) : null);
			setcookie ( 'comparing', $jsonComparing, 0, '/' );
			$_COOKIE["comparing"] = $jsonComparing;
		}
		return $this->getJson ( $ret );
	}
	/* сравнение обьектов comparing */
	
	/**
	 * предварительное найденное количество объектов недвижимости
	 *
	 * @param unknown $param        	
	 */
	public function precountfound($param) {
		$param["hide"] = "show";
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getListPager ( $param, 1, "" );
		// devLogs::_printr($param);
		return $this->getJson ( array(
				"count" => $model->provider->pager->total) );
	}
	
	/* cookie */
	public function setCookie($param) {
		$response['success'] = false;
		if (! empty ( $param["key"] ) && ! empty ( $param["value"] )) {
			setcookie ( $param["key"], $param["value"], 0, '/' );
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
	public function setSortTable($param) {
		$response['success'] = false;
		if (! empty ( $param["value"] )) {
			$v = explode ( " ", $param["value"] );
			setcookie ( 'im_where_sort', $v[0], 0, '/' );
			setcookie ( 'im_where_sort_order', $v[1], 0, '/' );
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
}