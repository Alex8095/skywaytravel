<?php
class DMN_Shops extends Controller {
	public $dictionaries;
	
	public function getPage($array) {
		$return = array ();
		$catalogProvider = new CatalogProvider ( 'catalog' );
		$catalogProvider->GetCatalogWhithInfo ( array ("dict_id" => "4fb0f701c0e1f", "ct_photo_type_id" => "4fb2c2c75e2f5", "city_id" => $array['city_id'], "brend_id" => $array['brend_id'] ) );
		$tListData = $this->Template ( "/dmn/shops/template/list.phtml", array ('Data' => $catalogProvider->resTable ) );
		$catalogProvider->GetCatalogList ( array ("dict_id" => "4d3c421816e39" ) );
		$this->getDictionaris();
		$this->dictionaries->do_dictionaries ( 33 );
		$cityDataList = $this->dictionaries->my_dct;
		$tAction = $this->Template ( "/dmn/shops/template/action.phtml", array ('Data' => "", "brendDataList" => $catalogProvider->resTable, "cityDataList" => $cityDataList, "activeBrend" => $array['brend_id'], "activeCity" => $array['city_id'] ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	
	public function getShop($array) {
		$Data = NULL;
		$ImageData = NULL;
		$catalogProvider = new CatalogProvider ( 'catalog' );
		$catalogProvider->GetCatalogList ( array ('dict_id' => "4d3c421816e39" ) );
		$brandsParent = $catalogProvider->resTable;
		if (isset ( $array ["id"] )) {
			$catalogProvider->GetCatalogWhithInfo ( array ("ct_id" => $array ["id"], "ct_photo_type_id" => "4fb2c2c75e2f5" ) );
			$Data = $catalogProvider->resTable [0];
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"] ) );
		}
		return $this->Template ( "/dmn/shops/template/form.phtml", array ('Data' => $Data, "ImageData" => $catalogProvider->resTable, "brandsParent" => $brandsParent ) );
	}
	
	public function save($array) {
		$return = DMN_Catalog::save ( $array );
		if ($array ['type_save'] == "new") {
			$array ['ct_id'] = $return ['callbackArgs'] ["newActionID"];
		}
		mysql_query ( "delete from shop_info where ct_id= '{$array['ct_id']}'" );
		$query = "INSERT INTO shop_info SET ct_id = '{$array['ct_id']}', city_id = '{$array['city_id']}', brand_id = '{$array['brand_id']}';";
		if (! mysql_query ( $query ))
			echo "error";
		return $return;
	}
	
	public function delete($array) {
		DMN_Catalog::delete ( $array );
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
?>