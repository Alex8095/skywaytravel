<?php
class tourModelClass extends modelClass {
	public $tourPrices;
	public $tourCountrys;
	public $toursDates;

	public function getItem($id) {
		$this->item = $this->provider->getItem ( $id );
		if ($this->item) {
			$this->tourPrices = $this->provider->getTourCountrys ( $id );
			$this->tourCountrys = $this->provider->getTourPrices ( $id );
			$this->toursDates = $this->provider->getToursDates ( $id );
		}
	}

	public function getItemByParam($param) {
		$item = $this->provider->getItemByParam ( $param );
		if ($item)
			$this->getItem ( $item ["tour_id"] );
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