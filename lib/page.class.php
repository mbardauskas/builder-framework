<?php
class Page {
	private $pageName;
	private $pageDir;
	private $pageType;
	
	function __construct($filename) {
		$this->pageName = basename($filename, ".php");
		$this->pageDir = dirname($filename);
		$this->setPageType();
	}
	
	public function getPageType() {
		return $this->pageType;
	}
	
	public function wrapBlock($block_name, $code) {
		$path = $this->buildBlockPath($block_name);
		$page = $this;
		$output = $code;
		ob_start();
		include($path);
		return ob_get_clean();
	}
	
	public function prerenderBlock($block) {
		$path = $this->buildBlockPath($block);
		$page = $this;
		ob_start();
		include($path);
		return ob_get_clean();
	}
	
	private function buildBlockPath($block_name) {
		$prefs = Preferences::getInstance();
		$blocks_dir_name = $prefs->getProp("BLOCKS_DIR_NAME");
		$tpl_ext = $prefs->getProp("BLOCKS_TPL_EXTENSION");

		return $this->pageDir . DS . $blocks_dir_name . DS . $block_name . $tpl_ext;
	}

	private function setPageType() {
		if(isset($_GET['e']) && !empty($_GET['e'])) {
			$this->pageType = $_GET['e'];
		}
		else {
			$this->pageType = "dev";
		}
	}
}
