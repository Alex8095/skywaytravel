<?php
class structureModelClass extends modelClass {
	public function getItemId($id) {
		$this->item = $this->provider->getItem ( $id );
	}
	public function getItem($controller, $action) {
		$this->item = $this->provider->getItemParam ( array(
				"controller" => $controller,
				"action" => $action) );
	}
	public function getItemUrl($url) {
		devLogs::_echo($url);
		$this->item = $this->provider->getItemParam ( array(
				"page_url" => $url) );
		devLogs::_printr($this->item, "ssssssss");
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res["resTable"];
		$this->listData = $res["resBuildTable"];
	}
}