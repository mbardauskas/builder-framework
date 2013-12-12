<?php
class Page {
	private $pageName;
	private $pageDir;
	private $pageType;
	
	function __construct($filename) {
		$this->pageName = basename($filename, ".php");;
		$this->pageDir = dirname($filename);
		$this->pageType = "dev";
	}
	
	public function renderBlock($block) {
		echo $this->prerenderBlock($block);
	}
	
	public function getPageType() {
		return $this->pageType;
	}
	
	
	
	private function prerenderBlock($block) {
		$path = $this->buildBlockPath($block);
		$page = $this;
		ob_start();
		include($path);
		return ob_get_clean();
	}
	
	private function buildBlockPath($block_name) {
		return $this->pageDir . DIRECTORY_SEPARATOR . BLOCKS_DIR_NAME . DIRECTORY_SEPARATOR . $block_name . TEMPLATE_EXTENSION;
	}
}

?>