<?php
//
// Базовый класс контроллера.
//
class aControllerClass {
	public $loyaut;
	public $isPartial = 0;
	private $view;
	public $result;
	public $appDataObj;
	public $dictionaries;
	public $routingObj;
	public function __construct() {
		$this->appDataObj = new appDataClass ();
		$this->loyaut = "_loyaut";
		$this->view = sprintf ( "%s/app/views/", DOC_ROOT );
		global $routingObj;
		$this->routingObj = $routingObj;
	}
	function view($vars = array(), $view = null, $backtraceNumber = 2) {
		try {
			$this->getView ( $view, $backtraceNumber );
			return $this->template ( $vars, $view );
		} catch ( Exception $ex ) {
			$ex->getMessage ();
			throw new ExceptionError ( $ex );
		}
	}
	function setResult($data) {
		$this->result = $data;
	}
	function setLoyaut($data) {
		$this->loyaut = ($data ? $data : $this->loyaut);
	}
	function template($vars = array(), $view) {
		try {
			if (is_array ( $vars ))
				foreach ( $vars as $k => $v ) {
					$$k = $v;
				}
			if (! file_exists ( $this->view )) {
				echo "NO ISSET TEMPLATE\n" . $this->view;
			}
			ob_start ();
			include $this->view;
		} catch ( Exception $ex ) {
			$ex->getMessage ();
			throw new ExceptionError ( $ex );
		}
		return ob_get_clean ();
	}
	function partialView($vars = array(), $view = null) {
		$this->isPartial = 1;
		return $this->View ( $vars, $view, 3 );
	}
	function getJson($data = array()) {
		$this->isPartial = 1;
		$jsonObj = new Services_JSON ();
		header ( 'Content-type: text/plain' );
		return $jsonObj->encode ( $data );
	}
	function getView($view = null, $backtraceNumber) {
		$backtrace = debug_backtrace ();
		if (empty ( $view )) {
			$this->view .= strtolower ( sprintf ( "%s/%s.php", str_replace ( "Controller", "", $backtrace[$backtraceNumber]["class"] ), $backtrace[$backtraceNumber]["function"] ) );
		} else {
			$this->view .= sprintf ( "%s.php", $view );
		}
	}
	public function buildDictionaries() {
		$this->dictionaries = new dictionariesClass ();
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE['lang_id']} ORDER BY dict_id" );
	}
	public function redirect($adress) {
		header ( "HTTP/1.1 301 Moved Permanently" );
		header ( "Location: http://" . $_SERVER['HTTP_HOST'] . "/" . $adress );
		exit ();
	}
	public function redirectToErrorPage($message = "", $exception = "") {
		header ( "HTTP/1.1 301 Moved Permanently" );
		header ( "Location: http://" . $_SERVER['HTTP_HOST'] . "/404.php" );
		exit ();
	}
	public function sitemap($param) {
		$this->isPartial = 1;
		return;
	}
	public function sitemapxml($param) {
		$this->isPartial = 1;
		return;
	}
	/**
	 * формирование rel ссылок и метатегов
	 *
	 * @param unknown $param        	
	 * @param unknown $model        	
	 * @param string $typeImmovable        	
	 * @param string $typeImmovableSaleRent        	
	 */
	public function buildImmovablesHttpHead($param, $model, $typeImmovable = "flat", $typeImmovableSaleRent = "sale") {
		$modelHttp = new immovablesHttpHeadModelClass ( $model->provider, $model->dictionaries );
		$modelHttp->buildImmovablesRelLink ( $param, $typeImmovable, $typeImmovableSaleRent );
		$AppData = $modelHttp->buildImmovablesAppData ( $param, $typeImmovable, $typeImmovableSaleRent );
		if (! empty ( $AppData )) {
			if ($AppData["categoryMetateg"] == "default") {
				$this->record_type = "appent";
			}
			$this->appDataObj->setH ( $AppData["h"] );
			$this->appDataObj->setTitle ( $AppData["title"] );
			// $this->appDataObj->setKeyw ( $AppData ["keywords"] );
			$this->appDataObj->setDesc ( $AppData["description"] );
		}
	}
}
