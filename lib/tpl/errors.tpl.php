<?php
/**
 * @var $missing_blocks array
 */
?>

<?php if(!empty($missing_blocks)): ?>
<div class="dev-errors">
	<?php foreach($missing_blocks as $region => $block): ?>
		<div class="dev-error">Region <?php echo $region; ?> tried to render missing block <?php echo $block ?>.</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>