<?php
class Preferences {
	private $props;
	private static $instance;

	private function __construct() {}

	public static function getInstance() {
		if(empty(self::$instance)) {
			self::$instance = new Preferences();
		}
		return self::$instance;
	}

	public function setProp($key, $val) {
		$this->props[$key] = $val;
	}

	public function getProp($key) {
		return $this->props[$key];
	}
}