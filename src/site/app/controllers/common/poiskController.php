<?php
class poiskController extends aControllerClass {
	public function index($param) {
		return $this->View ();
	}
	public function nakarte($param) {
		$model = new immovablesSearchModelClass ( new immovablesProviderClass ( "immovables" ) );
		$model->buildDictionaries ();
		$model->buildAdvasedSearchForm ( $param );
		$model->buildImmovablesProperties ();
		return $this->View ( array(
				"Model" => $model) );
	}
}