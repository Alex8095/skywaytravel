<?php
class renderHtmlLink {
	public $cssArr;
	public $jsArr;
	public $relArr;
	public $jsFullArr;
	public function __construct() {
		$this->cssArr = array();
		$this->jsArr = array();
		$this->jsFullArr = array();
		$this->relArr = array();
	}
	public function addCss($name) {
		array_push ( $this->cssArr, $name );
	}
	public function addJs($name) {
		array_push ( $this->jsArr, $name );
	}
	public function addJsFull($name) {
		array_push ( $this->jsFullArr, $name );
	}
	public function addRel($name, $link) {
		array_push ( $this->relArr, array(
				$name,
				$link) );
	}
	public function renderCss() {
		$ret = "";
		if ($this->cssArr != null)
			foreach ( $this->cssArr as $key => $value ) {
				$ret .= sprintf ( "<link rel=\"stylesheet\" href=\"/%s.css\">", $value );
			}
		return $ret;
	}
	public function renderJs() {
		$ret = "";
		if ($this->jsArr != null)
			foreach ( $this->jsArr as $key => $value ) {
				$ret .= sprintf ( "<script type=\"text/javascript\" src=\"/%s.js\"></script>", $value );
			}
		return $ret;
	}
	public function renderJsFull() {
		$ret = "";
		if ($this->jsArr != null)
			foreach ( $this->jsFullArr as $key => $value ) {
				$ret .= sprintf ( "<script type=\"text/javascript\" src=\"%s\"></script>", $value );
			}
		return $ret;
	}
	public function renderRel() {
		$ret = "";
		if ($this->relArr != null)
			foreach ( $this->relArr as $key => $value ) {
				$ret .= sprintf ( "<link rel=\"%s\" href=\"%s\"/>", $value[0], $value[1] );
			}
		return $ret;
	}
}