<h2>Editing Pass</h2>
<br>

<?php echo render('admin/pass/_form'); ?>
<p>
	<?php echo Html::anchor('admin/pass/view/'.$pass->id, 'View'); ?> |
	<?php echo Html::anchor('admin/pass', 'Back'); ?></p>
