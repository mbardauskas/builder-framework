<?php
class Page {
	public $pageName;
	
	function __construct($filename) {
		$this->pageName = basename($filename, ".php");;
	}
	
	public function render($code) {
		echo $this->prerender($code);
	}
	
	public function getPageName() {
		return $this->pageName;
	}
	
	private function prerender() {
		
	}
}

?>