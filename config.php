<?php
define("DS", DIRECTORY_SEPARATOR);
define("ENVIRONMENT", "DEV");
require_once 'lib/includes.php';

$prefs = Preferences::getInstance();

// default dev structure
$prefs->setProp("ROOT_PATH", dirname(__FILE__) . DS);
$prefs->setProp("ROOT_URL", str_replace('index.php', '', $_SERVER['PHP_SELF']));
$prefs->setProp("BLOCKS_DIR_NAME", "_blocks");
$prefs->setProp("BLOCKS_TPL_EXTENSION", ".tpl.php");
$prefs->setProp("TEMPLATES_DIR_NAME", "templates");

// combined properties
$prefs->setProp("BLOCKS_PATH", $prefs->getProp("ROOT_PATH") . $prefs->getProp("BLOCKS_DIR_NAME"));
$prefs->setProp("TEMPLATES_PATH", $prefs->getProp("ROOT_PATH") . $prefs->getProp("TEMPLATES_DIR_NAME"));
$prefs->setProp("TEMPLATES_URL", $prefs->getProp("ROOT_URL") . $prefs->getProp("TEMPLATES_DIR_NAME"));