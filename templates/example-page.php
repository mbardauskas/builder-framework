<?php
require_once '../config.php';
$page = new Page(__FILE__);

$output = $page->prerenderBlock('example-block');
$output = $page->wrapBlock('example-block-wrapper', $output);

echo $output;
