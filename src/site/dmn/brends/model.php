<?php
class DMN_Brends extends Controller {
	public $dictionaries;
	
	public function getBrendPage($array) {
		$return = array ();
		$catalogProvider = new CatalogProvider ( 'catalog' );
		$catalogProvider->GetCatalogList ( array ("dict_id" => "4d3c421816e39" ) );
		$tListData = $this->Template ( "/dmn/brends/template/list.phtml", array ('Data' => $catalogProvider->resTable ) );
		$tAction = $this->Template ( "/dmn/brends/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	
	public function getBrend($array) {
		$Data = NULL;
		$ImageData = NULL;
		$catalogProvider = new CatalogProvider ( 'catalog' );
		if (isset ( $array ["id"] )) {
			$provider = new mysql_select ( "catalog" );
			$Data = $provider->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"] ) );
		}
		$DataCollection = $this->getCollections ( array ('parent_id' => $array ['id'] ) );
		$DataArticles = $this->getArticles ( array ('parent_id' => $array ['id'] ) );
		return $this->Template ( "/dmn/brends/template/form.phtml", array ('Data' => $Data, "ImageData" => $catalogProvider->resTable, 'DataCollection' => $DataCollection, 'DataArticles' => $DataArticles ) );
	}
	
	public function delete($array) {
		DMN_Catalog::delete ( $array );
		return $this->getBrendPage ( array () );
	}
	
	public function getCollections($array) {
		$return = array ();
		$catalogProvider = new CatalogProvider ( 'catalog' );
		if ($array ['parent_id'])
			$catalogProvider->GetCatalogList ( array ("dict_id" => "4fbcb01342cf0", "parent_id" => $array ['parent_id'] ) );
		return $this->Template ( "/dmn/brends/template/list.collections.phtml", array ('Data' => $catalogProvider->resTable ) );
	}
	
	public function getCollection($array) {
		$Data = NULL;
		$ImageData = NULL;
		$catalogProvider = new CatalogProvider ( 'catalog' );
		if (isset ( $array ["id"] )) {
			$provider = new mysql_select ( "catalog" );
			$Data = $provider->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
			$catalogProvider->GetCatalogItemImages ( array ("ct_id" => $array ["id"] ) );
		}
		return $this->Template ( "/dmn/brends/template/form.collection.phtml", array ('Data' => $Data, "ImageData" => $catalogProvider->resTable, 'parent_id' => $array ['parent_id'] ) );
	}
	
	public function deleteCollection($array) {
		DMN_Catalog::delete ( $array );
		return $this->getCollections ( $array );
	}
	
	public function getArticles($array) {
		$return = array ();
		$catalogProvider = new CatalogProvider ( 'catalog' );
		if ($array ['parent_id'])
			$catalogProvider->GetCatalogList ( array ("dict_id" => "4fbcb00b7ccb8", "parent_id" => $array ['parent_id'] ) );
		return $this->Template ( "/dmn/brends/template/list.article.phtml", array ('Data' => $catalogProvider->resTable ) );
	}
	
	public function getArticle($array) {
		$Data = NULL;
		$ImageData = NULL;
		if (isset ( $array ["id"] )) {
			$provider = new mysql_select ( "catalog" );
			$Data = $provider->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
			$providerImage = new mysql_select ( "ct_photos " );
			$ImageData = $providerImage->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
		}
		return $this->Template ( "/dmn/brends/template/form.article.phtml", array ('Data' => $Data, "ImageData" => $ImageData, 'parent_id' => $array ['parent_id'] ) );
	}
	
	public function deleteArticle($array) {
		DMN_Catalog::delete ( $array );
		return $this->getArticles ( $array );
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