<?php
class Page {
	private $pageName;
	private $pageDir;
	private $pageType;

	protected $options = array();
	protected $regionName;
	protected $blocks = array();
	protected $missing_blocks = array();
	
	function __construct($filename) {
		$this->pageName = basename($filename, ".php");
		$this->pageDir = dirname($filename);
		$this->setPageType();
	}

	public function getPageName() {
		return $this->pageName;
	}

	/**
	 * @return mixed
	 */
	public function getPageType() {
		return $this->pageType;
	}

	/**
	 * Returns option passed to rendered region
	 * @param $option
	 * @return mixed|bool
	 */
	public function getOption($option) {
		if(array_key_exists($option, $this->options)) {
			return $this->options[$option];
		}
		return false;
	}

	/**
	 * @param string $block_name Block name (template file name without extensions)
	 * @param array $blocks Rendered blocks to be printed to region
	 * @param array $options
	 * @return string Rendered region
	 */
	public function prerenderRegion($block_name, array $blocks = array(), array $options = array()) {
		$saved_region = $this->regionName;
		$saved_blocks = $this->blocks;

		$this->options = $options;
		$this->blocks = $blocks;
		$this->regionName = $block_name;

		$path = $this->buildBlockPath($block_name);
		ob_start();

		// used in template
		$page = $this;
		include($path);

		$this->blocks = $saved_blocks;
		$this->regionName = $saved_region;
		return ob_get_clean();
	}

	public function render($block_name) {
		if(array_key_exists($block_name, $this->blocks)) {
			echo $this->blocks[$block_name];
		} else {
			$this->missing_blocks[$this->regionName] = $block_name;
		}
	}

	/**
	 * @param string $block Block name (template file name without extensions)
	 * @return string Rendered block
	 */
	public function prerenderBlock($block) {
		$path = $this->buildBlockPath($block);

		// used in template
		$page = $this;

		ob_start();
		include($path);
		return ob_get_clean();
	}

	/**
	 * @param string $block_name Block name (template file name without extensions)
	 * @return string block path
	 */
	private function buildBlockPath($block_name) {
		$prefs = Preferences::getInstance();
		$blocks_dir_name = $prefs->getProp("BLOCKS_DIR_NAME");
		$tpl_ext = $prefs->getProp("BLOCKS_TPL_EXTENSION");

		return $this->pageDir . DS . $blocks_dir_name . DS . $block_name . $tpl_ext;
	}

	/**
	 * Ad-hoc environment for page
	 */
	private function setPageType() {
		if(!empty($_GET['e'])) {
			$this->pageType = $_GET['e'];
		}
		else {
			$this->pageType = ENVIRONMENT;
		}
	}

	/**
	 * Returns missing blocks from page
	 * @return array
	 */
	private function getMissingBlocks() {
		return $this->missing_blocks;
	}

	/**
	 * Reports missing blocks to the template
	 * @return string
	 */
	public function reportMissingBlocks() {
		// used in template
		$missing_blocks = $this->getMissingBlocks();
		include(__DIR__.DS.'tpl/errors.tpl.php');

		return ob_get_clean();
	}
}
