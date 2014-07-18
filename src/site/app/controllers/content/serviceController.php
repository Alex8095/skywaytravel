<?php
class serviceController extends aControllerClass {

	public function index($param) {
		$this->redirect ( "service/visa" );
	}

	public function visa($param) {
		if ($this->routingObj->getParamItem ( "visa_id" )) {
			return $this->View ( array ("Model" => $model ), "service/visa/details" );
		}
		return $this->View ( array ("Model" => $model ) );
	}

	public function flights($param) {
		return $this->View ( array ("Model" => $model ) );
	}

	public function passport($param) {
		return appHtmlClass::partialAction ( "content", "partialDetails", array ("cashe" => 1,"page_id" => "53c522b809d21" ) );
	}
	
	/* sitemap */
	public function sitemap($param) {
		$this->isPartial = true;
		if ($param ["action"] == "index") {
			$model = new serviceModelClass ( new serviceProviderClass ( "service_catalog" ) );
			$model->getList ( array ("hide" => "show" ) );
			return $this->partialView ( array ("Model" => $model,"level" => $param ["level"] ), "service/sitemap/index" );
		}
	}

	public function sitemapxml($param) {
		$this->isPartial = true;
		if ($param ["action"] == "index") {
			$model = new serviceModelClass ( new serviceProviderClass ( "service_catalog" ) );
			$model->getList ( array ("hide" => "show" ) );
			$array = null;
			if ($model->list) {
				foreach ( $model->list as $key => $value ) {
					$array [] = array ("loc" => sprintf ( "http://%s/service/details/%s", $_SERVER ['HTTP_HOST'], $value ["sc_id"] ),"lastmod" => date ( "Y-m-d H:i:s" ),"changefreq" => "weekly","priority" => $param ["priority"] );
				}
			}
			return $array;
		}
	}

}
