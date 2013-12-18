<?php
require_once 'lib/includes.php';

$templates_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . TEMPLATES_DIR;
$templates_uri = $_SERVER['REQUEST_URI'] . TEMPLATES_DIR;
$template_list = buildTemplateList($templates_path);

if(!empty($template_list)): ?>
<ul>
<?php foreach($template_list as $template): ?>
	<li><a href="<?php echo $templates_uri . '/' . $template ?>"><?php echo $template ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>