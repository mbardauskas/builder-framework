<?php
require_once 'config.php';

$prefs = Preferences::getInstance();
$tpl_dir = $prefs->getProp("TEMPLATES_DIR_NAME");
$tpl_url = $prefs->getProp("TEMPLATES_URL");

$template_list = buildTemplateList($tpl_dir);

if(!empty($template_list)): ?>
<ul>
<?php foreach($template_list as $template): ?>
	<li><a href="<?php echo $tpl_url . '/' . $template ?>"><?php echo $template ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>