<?php
function buildTemplateList($path) {
	$files_array = scandir($path);

	$templates = array_filter($files_array, function($file) {
		return preg_match('/.php$/', $file);
	});
	return $templates;
}