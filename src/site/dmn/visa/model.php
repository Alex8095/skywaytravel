<?php
class DMN_Visa extends Controller {
	public $dictionaries;

	public function getPage($array) {
		$return = array ();
		$catalogProvider = new catalogProviderClass ( 'catalog' );
		$catalogProvider->GetCatalogList ( array ("dict_id" => "4fb609173b483","parent_id" => "1000000000001" ) );
		$tListData = $this->Template ( "/dmn/visa/template/list.phtml", array ('Data' => $catalogProvider->resTable ) );
		$tAction = $this->Template ( "/dmn/visa/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData,"tAction" => $tAction ) );
	}

	public function getVisa($array) {
		$Data = NULL;
		$ImageData = NULL;
		if (isset ( $array ["id"] )) {
			$provider = new mysql_select ( "catalog" );
			$Data = $provider->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
			$providerImage = new mysql_select ( "ct_photos " );
			$ImageData = $providerImage->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
		}
		$this->getDictionaris();
		return $this->Template ( "/dmn/visa/template/form.phtml", array ('Data' => $Data,"ImageData" => $ImageData, "dictionaries" => $this->dictionaries ) );
	}

	public function delete($array) {
		DMN_Catalog::delete ( $array );
		return $this->getPage ( array () );
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