<?php
class flightsController extends aControllerClass {
	public function index($param) {
		return $this->View ( array(
				1,
				1,
				2) );
	}
}