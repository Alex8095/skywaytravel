<?php
class toursController extends aControllerClass {

	public function index($param) {
		$this->redirect ( "tours/bus" );
	}

	public function avia($param) {
		if ($this->routingObj->getParamItem ( "url" ))
			return appHtmlClass::Action ( "tours", "details", $this->routingObj->getParam () );
		$this->routingObj->setParamItem ( "is_show", true );
		$this->routingObj->setParamItem ( "type_id", "53c90bf8f1da2" );
		$model = new tourModelClass ( new tourProviderClass ( "tours", "tour_id" ) );
		$model->getListPager ( $this->routingObj->getParam (), $this->routingObj->getParamItem ( "page_id" ), "/tours/avia" );
		return $this->View ( array ("Model" => $model ) );
	}

	public function bus($param) {
		if ($this->routingObj->getParamItem ( "url" ))
			return appHtmlClass::Action ( "tours", "details", $this->routingObj->getParam () );
		$this->routingObj->setParamItem ( "is_show", true );
		$this->routingObj->setParamItem ( "type_id", "53c90bd9efafa" );
		$model = new tourModelClass ( new tourProviderClass ( "tours", "tour_id" ) );
		$model->getListPager ( $this->routingObj->getParam (), $this->routingObj->getParamItem ( "page_id" ), "/tours/bus" );
		return $this->View ( array ("Model" => $model ) );
	}

	public function burning($param) {
		if ($this->routingObj->getParamItem ( "url" ))
			return appHtmlClass::Action ( "tours", "details", $this->routingObj->getParam () );
		$this->routingObj->setParamItem ( "is_show", true );
		$this->routingObj->setParamItem ( "is_hot", true );
		$model = new tourModelClass ( new tourProviderClass ( "tours", "tour_id" ) );
		$model->getListPager ( $this->routingObj->getParam (), $this->routingObj->getParamItem ( "page_id" ), "/tours/burning" );
		return $this->View ( array ("Model" => $model ) );
	}

	public function details($param) {
		$model = new tourModelClass ( new tourProviderClass ( "tours", "tour_id" ) );
		$model->buildDictionaries ();
		$this->routingObj->setParamItem ( "is_show", true );
		$model->getItemByParam ( $this->routingObj->getParam () );
		if (! $model->item)
			$this->redirectToErrorPage ();
		return $this->View ( array ("Model" => $model ) );
	}

}