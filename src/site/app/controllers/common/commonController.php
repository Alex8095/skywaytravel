<?php
class commonController extends aControllerClass {
	public function setCookie($param) {
		$response['success'] = false;
		if (! empty ( $param["key"] ) && ! empty ( $param["value"] )) {
			setcookie ( $param["key"], $param["value"], 0, '/' );
			$response['success'] = true;
		}
		return $this->getJson ( $response );
	}
}