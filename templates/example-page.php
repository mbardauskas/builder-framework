<?php
require_once '../config.php';
$page = new Page(__FILE__);

echo $page->prerenderBlock('example-block');
echo $page->prerenderRegion('example-block-wrapper', array(
	'content' => $page->prerenderBlock('example-block'),
));