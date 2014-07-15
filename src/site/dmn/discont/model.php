<?php
class DMN_Disconts extends Controller {
	public $dictionaries;

	public function getPage($array) {
		$return = array ();
		$catalogProvider = new CatalogProvider('catalog');
		$catalogProvider->GetCatalogList(array("dict_id" => "4fb609173b483"));
		$tListData = $this->Template ( "/dmn/discont/template/list.phtml", array ('Data' => $catalogProvider->resTable ) );
		$tAction = $this->Template ( "/dmn/discont/template/action.phtml", array ('Data' => "" ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}

	public function getDiscont($array) {
		$Data = NULL;
		$ImageData = NULL;
		if (isset ( $array ["id"] )) {
			$provider = new mysql_select ( "catalog" );
			$Data = $provider->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}" );
			$providerImage = new mysql_select ( "ct_photos " );
			$ImageData = $providerImage->select_table_id ( "where ct_id = '{$array['id']}' and lang_id = {$_COOKIE[lang_id]}"  );
		}
		return $this->Template ( "/dmn/discont/template/form.phtml", array ('Data' => $Data, "ImageData" => $ImageData ) );
	}

	public function delete($array) {
		DMN_Catalog::delete($array);
		return $this->getPage(array());
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