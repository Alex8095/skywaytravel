<?php
class contentController extends aControllerClass {

	public function index($param) {
		return;
	}

	public function details($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages" ) );
		$model->getItemId ( $param ["page_id"] );
		return $this->View ( array ("Data" => $model->item ) );
	}

	public function partialDetails($param) {
		$model = new structureModelClass ( new structureProviderClass ( "pages_content" ) );
		$model->getItemId ( $param ["page_id"] );
		return $this->partialView ( array ("Data" => $model->item ), "content/details" );
	}

	public function error($param) {
		header ( "Status: 404 Not Found" );
		$this->appDataObj->setTitle ( "404" );
		return $this->View ( array (), "content/404" );
	}

}