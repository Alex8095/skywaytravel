<?php
/*
 * echo appHtmlClass::action("home", "menu", array("t"=>1)); echo appHtmlClass::partial("home/menu", array("t"=>1)); echo appHtmlClass::partialAction("home", "menu", array("t"=>1));
 */
class appHtmlClass {
	static function action($controller, $action, $param = array()) {
		global $cancellationLoyaut;
		$cancellationLoyaut = true;
		$param["COOKIE_wrapperCssClass"] = ($_COOKIE["wrapperCssClass"] ? $_COOKIE["wrapperCssClass"] : 1);
		if($_COOKIE["comparing"])
			$param["COOKIE_comparing"] = $_COOKIE["comparing"];
		return file_get_contents ( appHtmlClass::buildUrl ( $controller, $action, $param ) );
	}
	static function dataAction($controller, $action, $param = array()) {
		$controller = $controller . "Controller";
		$c = new $controller ();
		return $c->$action ( $param );
	}
	static function partialAction($controller, $action, $param = array()) {
		return file_get_contents ( appHtmlClass::buildUrl ( $controller, $action, $param ) );
	}
	static function partial($view, $param = array()) {
		$aControllerObj = new aControllerClass ();
		return $aControllerObj->view ( $param, $view );
	}
	static function partialActionFormat($controller, $action, $param = array(), $isCache = false) {
		global $cacheObj;
		$cacheObj = new cacheClass ();
		$ret = appHtmlClass::buildCashApp ( 'start', $isCache );
		if (! $ret)
			$ret = appHtmlClass::formatControllerData ( $controller . "Controller", $action, $param );
			// кеширование (сохранение сформированной страницы)
		appHtmlClass::buildCashApp ( 'end', $isCache );
		return $ret;
	}
	static function formatControllerData($controller, $action, $param, $is_partial = true) {
		try {
			$c = new $controller ();
			$c->setResult ( $c->$action ( $param ) );
		} catch ( Exception $ex ) {
			throw new ExceptionObject ( $ex, "Ошибка обращения к контроллеру" );
		}
		if ($is_partial) {
			$formatedPage = $c->result;
		} else {
			$aControllerObj = new aControllerClass ();
			$formatedPage = $aControllerObj->view ( array(
					"body" => $c->result), "/shared/" . $c->loyaut );
		}
		return $formatedPage;
	}
	static function buildCashApp($action = "start", $isCache = false) {
		if (! $isCache)
			return;
		global $cacheObj;
		if ($action == 'start') {
			$cacheObj->checking_inclusion ();
			return $cacheObj->checking_existence ();
		}
		if ($action == 'end') {
			$cacheObj->creation_page ();
		}
		return;
	}
	private static function buildUrl($controller, $action, $param = array()) {
		$p = "";
		foreach ( $param as $key => $value ) {
			if ($key == "string_navigation") {
				$value = str_replace ( " ", "~", $value );
				$value = str_replace ( "&", "Z", $value );
				$value = str_replace ( "?", "O", $value );
			}
			if ($key == "h")
				$value = str_replace ( " ", "~", $value );
			$p .= sprintf ( "&%s=%s", $key, $value );
		}
		$ret = sprintf ( "http://%s/%s/%s%s", $_SERVER['HTTP_HOST'], $controller, $action, (empty ( $p ) ? "" : sprintf ( "?%s", substr ( $p, 1, strlen ( $p ) ) )) );
		return $ret;
	}
}