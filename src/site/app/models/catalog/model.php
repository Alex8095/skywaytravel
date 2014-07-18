<?php
class catalogModelClass extends modelClass {

	public function getItem($id) {
		$this->item = $this->provider->getItem ( $id );
	}

	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res ["resTable"];
		$this->listData = $res ["resBuildTable"];
	}

	public function getListPager($param, $page_id, $pagerlink, $limit = null, $providerMethod = "getListPager") {
		$this->buildDictionaries ();
		$this->provider->setValue ( "id", "tour_id" );
		$this->provider->setValue ( "orderby", "t.date_add" );
		$this->provider->setValue ( "pagerlink", $pagerlink );
		$this->provider->setValue ( "limit", 10 );
		// $this->provider->setValue ( "pagerparamafter", $this->getRequestStringForPager ( $param ) );
		$this->provider->setValue ( "ordersort", "desc" );
		$this->provider->getListPager ( $param, $page_id, $query );
		$this->list = $this->provider->list;
		$this->pager = $this->provider->pager;
	}

}