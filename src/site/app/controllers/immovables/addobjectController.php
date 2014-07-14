<?php
class addobjectController extends aControllerClass {
	public function index($param) {
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$modelSearch = new immovablesSearchModelClass ( null );
		$modelSearch->dictionaries = $model->dictionaries;
		$modelSearch->buildTerrotoryDict ();
		return $this->View ( array(
				"Model" => $model,
				"modelSearch" => $modelSearch) );
	}
	public function harakteristiki($param) {
		if (empty ( $param["im_id"] ))
			$this->redirect ( "addobject" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->getItemNoHide ( $param["im_id"] );
		// ыборка характеристик недвижимости
		$ImPropList = new mysql_select ( "im_properties_list", "WHERE lang_id = {$_COOKIE['lang_id']} AND catalog_id='{$model->item['im_catalog_id']}' AND hide='show'", "ORDER BY im_prop_name ASC" );
		$ImPropList->select_table ( "im_prop_id" );
		// ыборка характеристик данной недвижимости
		$ImPropInfo = new mysql_select ( "im_properties_info", "WHERE lang_id = {$_COOKIE['lang_id']} AND im_id='{$model->item['im_id']}'" );
		$ImPropInfo->select_table ( "im_prop_id" );
		// бъеление клаасс построениея формы справочников, и поздтановка значений в поля формы
		$PrintPropForm = new ImPropAdvaced ( $ImPropList, $model->dictionaries, $ImPropInfo );
		$PrintPropForm->ImPropListPrintField ();
		return $this->View ( array(
				"model" => $model,
				"PrintPropForm" => $PrintPropForm), "addobject/properties" );
	}
	public function izobrazheniya($param) {
		
		// Set the POST data
// 		$postdata = http_build_query ( array(
// 				'email' => 'user@example.com',
// 				'name' => 'Some User') );
		
// 		// Set the POST options
// 		$opts = array(
// 				'http' => array(
// 						'method' => 'POST',
// 						'header' => 'Content-type: application/xwww-form-urlencoded',
// 						'content' => $postdata));
		
// 		// Create the POST context
// 		$context = stream_context_create ( $opts );
		
// 		// POST the data to an api
// 		$url = 'http://www.example.com/api/do/something/';
// 		$result = file_get_contents ( $url, false, $context );
		
		if (empty ( $param["im_id"] ))
			$this->redirect ( "addobject" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$param = array_merge ( $param, $_POST );
		$model->getItemNoHide ( $param["im_id"] );
		if ($param['retention']) {
			if ($param['retention'] == "images") {
				$model->saveItemImages ( $param, $_FILES );
				$this->redirect ( "addobject/opisanie/" . $param["im_id"] );
			}
		}
		return $this->View ( array(
				"Model" => $model), "addobject/images" );
	}
	public function opisanie($param) {
		if (empty ( $param["im_id"] ))
			$this->redirect ( "addobject" );
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->getItemNoHide ( $param["im_id"] );
		$model->getItemSummary ( $param["im_id"] );
		return $this->view ( array(
				"Model" => $model), "addobject/summary" );
	}
	public function save($param) {
		$param = $_POST;
		$response['success'] = false;
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables" ) );
		$immovable = null;
		if ($param['retention'] == "main")
			$immovable = $model->saveItem ( $param );
		if ($param['retention'] == "properties")
			$immovable = $model->saveItemProperties ( $param );
		if ($param['retention'] == "summary")
			$immovable = $model->saveItemSummary ( $param );
		
		if ($immovable["im_id"]) {
			$response['callbackArgs']['newActionID'] = $immovable["im_id"];
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
	public function menu($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages_structure" ) );
		$model->getList ( array(
				"parent_id" => "5260f30a970e4") );
		return $this->partialView ( array(
				"Model" => $model), "addobject/menu" );
	}
}


