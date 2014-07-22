<?php
class DMN_Tours extends Controller {
	public $model;
	public $dictionaries;
	public $provider;
	public $dictionarisType = array ();
	public $dictionarisTypeInner = array ();
	public $dictionarisTypeCountrys = array ();

	public function __construct() {
		$this->model = new tourModelClass ( new tourProviderClass ( "tours" ) );
		$this->provider = new tourProviderClass ( "tours" );
		// $this->getDictionaris ();
		// $this->dictionarisType = $this->dictionaries->do_dictionaries ( 83 );
		// $this->dictionarisTypeInner = array_merge ( $this->dictionaries->do_dictionaries ( 84 ), $this->dictionaries->do_dictionaries ( 85 ) );
		// $this->dictionarisTypeCountrys = $this->dictionaries->do_dictionaries ( 82 );
	}
	
	/* SPECIAL CODE */
	public function getPage($array) {
		$return = array ();
		//
		$this->model->getModelDictionarys ( null );
		$this->provider->getList ( $array );
		//
		$tListData = $this->Template ( "/dmn/tours/template/list.phtml", array ('Data' => $this->provider->list,"Model" => $this->model ) );
		$tAction = $this->Template ( "/dmn/tours/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData,"tAction" => $tAction ) );
	}

	public function getItem($array) {
		$this->model->getModelDictionarys ( null );
		//
		// $NewsData = NULL;
		// $NewsImageData = NULL;
		if (isset ( $array ["id"] )) {
			$this->model->getItem ( $array ["id"] );
			// $Data = new mysql_select ( "news" );
			// $NewsData = $Data->select_table_id ( "where news_id = '{$array['id']}' and lang_id={$_COOKIE['lang_id']}" );
			// $catalogProvider = new catalogProviderClass ( 'catalog' );
			// $catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"],"ph_dicts_id" => "'4fba172ec899c', '4fba176e2cec2'" ) );
			// $NewsImageData = $catalogProvider->resTable;
			// $catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"],"ph_dict_id" => "4fbb5273dc1e5" ) );
			// $GalleryData = $catalogProvider->resTable;
		}
		return $this->Template ( "/dmn/tours/template/form.phtml", array ('ItemData' => $NewsData,"newsTypeDict" => $newsTypeDict,"ImageData" => $NewsImageData,"GalleryData" => $GalleryData,"Model" => $this->model ) );
	}

	public function saveTourPrice($param) {
		$return = $this->model->provider->saveTourPrice ( $param );
		$res = $this->model->provider->getTourPrices ( array ("tour_id" => $param ["tour_id"] ) );
		$this->model->buildDictionaries ();
		$return ["callbackArgs"] ["template"] = $this->Template ( "/dmn/tours/template/listprices.phtml", array ('Data' => $res ["resTable"],"Model" => $this->model ) );
		return $return;
	}

	public function saveTourDate($param) {
		$return = $this->model->provider->saveTourDate ( $param );
		$res = $this->model->provider->getTourDates ( array ("tour_id" => $param ["tour_id"] ) );
		$this->model->buildDictionaries ();
		$return ["callbackArgs"] ["template"] = $this->Template ( "/dmn/tours/template/listdates.phtml", array ('Data' => $res ["resTable"],"Model" => $this->model ) );
		return $return;
	}

	public function saveTourCountry($param) {
		$return ['success'] = true;
		if (! $param) {
			$return ['generalError'] = "empty param list";
			$return ['success'] = false;
			return $return;
		}
		$this->model->provider->deleteTourCountry ( array ("tours_tour_id" => $param ["tour_id"] ) );
		foreach ( $_POST as $key => $value ) {
			if ($key != "tour_id")
				$return = $this->model->provider->saveTourCountry ( array ("tours_tour_id" => $param ["tour_id"],"country_id" => $key ) );
		}
		return $return;
	}

	public function setMainImage($id, $image) {
		$this->model = new tourModelClass ( new tourProviderClass ( "tours" ) );
		$this->model->provider->saveTourMainImage ( array ("tour_id" => $id,"img" => $image ) );
	}

	public function saveItem($array) {
		return $this->model->provider->saveItem ( $array );
		$res = $this->model->provider->getTourPrices ( array ("tour_id" => $array ["tour_id"] ) );
		return $this->Template ( "/dmn/tours/template/listprices.phtml", array ('Data' => $res ["resTable"] ) );
	}

	public function saveImage($array) {
		$ga_img = $this->saveFile ();
		$arr_update = array ("ga_img" => "'{$ga_img}'" );
		$Data = new mysql_select ( "goods_action" );
		$Data->update_table ( "WHERE ga_id = {$array['ga_id']}", $arr_update );
	}

	public function delete($array) {
		$this->model->provider->deleteItem ( $array ["id"] );
		$this->model->provider->deleteTourCountry ( array ("tours_tour_id" => $array ["id"] ) );
		$this->model->provider->deleteTourPrice ( array ("tours_tour_id" => $array ["id"] ) );
		$this->model->provider->deleteTourDate ( array ("tours_tour_id" => $array ["id"] ) );
		return $this->getPage ( array () );
	}

	public function deletePrice($array) {
		$this->model->buildDictionaries ();
		$this->model->provider->deleteTourPrice ( array ("tour_prices_id" => $array ["id"] ) );
		$res = $this->model->provider->getTourPrices ( array ("tour_id" => $array ["tour_id"] ) );
		return $this->Template ( "/dmn/tours/template/listprices.phtml", array ('Data' => $res ["resTable"],"Model" => $this->model ) );
	}

	public function deleteDate($array) {
		$this->model->buildDictionaries ();
		$this->model->provider->deleteTourDate ( array ("tours_date_id" => $array ["id"] ) );
		$res = $this->model->provider->getTourDates ( array ("tour_id" => $array ["tour_id"] ) );
		return $this->Template ( "/dmn/tours/template/listdates.phtml", array ('Data' => $res ["resTable"],"Model" => $this->model ) );
	}

	public function getCatalogData() {
		// производим выборку
		$CatData = new mysql_select ( "catalog", "where lang_id = {$_COOKIE['lang_id']} and dict_id='4d3c421816e39'" );
		$CatData->select_table ( "ct_id" );
		return $CatData;
	}

	public function getDictionaris() {
		// бъявляем класс словаря
		$this->dictionaries = new dictionariesClass ();
		// ормируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		// ормируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}

}
?>