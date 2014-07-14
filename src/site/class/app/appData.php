<?php
/**
 * Этот класс формирует отвечает за обработку мета данных страницы 
 * @author Alex
 *
 */
class appDataClass {
	public $p_w_title;
	public $p_w_keyw;
	public $p_w_desc;
	public $string_navigation;
	public $parent_controller;
	public $parent_action;
	public $social;
	public $h;
	public $record_type;
	function __construct($page = null) {
		if ($page) {
			$this->p_w_title = $page ["p_w_title"];
			$this->p_w_keyw = $page ["p_w_keyw"];
			$this->p_w_desc = $page ["p_w_desc"];
			$this->h = $page ["p_title"];
		}
		$this->record_type = "set";
		$this->string_navigation = "";
		$this->social = array (
				"fb" => new appSocialData ( getLangString ( "facebook_id" ) ),
				"vk" => new appSocialData ( getLangString ( "vkontakte_id" ) ) 
		);
	}
	/* p_w_title */
	public function appentTitle($data) {
		$this->p_w_title = ($data ? $this->p_w_title . " - " . $data : $this->p_w_title);
	}
	public function setTitle($data) {
		$this->p_w_title = ($data ? $data : $this->p_w_title);
	}
	public function getTitle() {
		return $this->p_w_title;
	}
	/* p_w_keyw */
	public function appentKeyw($data) {
		$this->p_w_keyw = ($data ? $data . " - " . $this->p_w_keyw : $this->p_w_keyw);
	}
	public function setKeyw($data) {
		$this->p_w_keyw = ($data ? $data : $this->p_w_keyw);
	}
	public function getKeyw() {
		return $this->p_w_keyw;
	}
	/* p_w_desc */
	public function appentDesc($data) {
		$this->p_w_desc = ($data ? $this->p_w_desc . " - " . $data : $this->p_w_desc);
	}
	public function getDesc() {
		return $this->p_w_desc;
	}
	public function setDesc($data) {
		$this->p_w_desc = ($data ? $data : $this->p_w_desc);
	}
	/* string_navigation */
	public function appentStringNavigation($data) {
		$this->string_navigation = ($data ? $this->string_navigation . $data : $this->string_navigation);
	}
	public function setStringNavigation($data) {
		$this->string_navigation = ($data ? $data : $this->string_navigation);
	}
	public function setStringNavigationLast($data) {
		$this->string_navigation = ($data ? sprintf ( ' <span class="last">%s</span>', $data ) : $this->string_navigation);
	}
	public function getStringNavigation() {
		return $this->string_navigation;
	}
	/* parent_controller */
	public function setPController($data) {
		$this->parent_controller = ($data ? $data : $this->parent_controller);
	}
	public function getPController() {
		return $this->parent_controller;
	}
	/* parent_action */
	public function setPAction($data) {
		$this->parent_action = ($data ? $data : $this->parent_action);
	}
	public function getPAction() {
		return $this->parent_action;
	}
	/* h1 */
	public function setH($data) {
		$this->h = ($data ? $data : $this->h);
	}
	public function getH() {
		return $this->h;
	}
}
class appSocialData {
	public $type = "website";
	public $title;
	public $url;
	public $image;
	public $site;
	public $id;
	public function __construct($id) {
		$this->type = "website";
		$this->url = $_SERVER ["REQUEST_URI"]; 
		//"http://" . $_SERVER ["HTTP_HOST"] . $_SERVER ["REQUEST_URI"];
		$this->site = "http://" . $_SERVER ["HTTP_HOST"];
		$this->image = "http://img.alfabrok.ua/files/images/bg/alfabrok.logo.png";
		$this->id = $id;
	}
}