<h2>Viewing #<?php echo $pass->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $pass->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $pass->description; ?></p>
<p>
	<strong>Logo text:</strong>
	<?php echo $pass->logo_text; ?></p>
<p>
	<strong>Background color:</strong>
	<?php echo $pass->background_color; ?></p>
<p>
	<strong>Foreground color:</strong>
	<?php echo $pass->foreground_color; ?></p>
<p>
	<strong>Label color:</strong>
	<?php echo $pass->label_color; ?></p>
<p>
	<strong>Barcode message:</strong>
	<?php echo $pass->barcode_message; ?></p>
<p>
	<strong>Barcode format:</strong>
	<?php echo $pass->barcode_format; ?></p>
<p>
    <strong>Offer label:</strong>
    <?php echo $pass->offer_label; ?></p>
<p>
    <strong>Offer value:</strong>
    <?php echo $pass->offer_value; ?></p>

<button class="btn btn-large span2" onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/cert/' . $pass->id); ?>';">Certificate</button>

<button class="btn btn-large span2" onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/images/' . $pass->id); ?>';">Images</button>

<button class="btn btn-large span2" onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/colors/' . $pass->id); ?>';">Colors</button>

<button class="btn btn-large span2" onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/locations/' . $pass->id); ?>';">Locations</button>

<?php echo Html::anchor('admin/pass/edit/'.$pass->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/pass', 'Back'); ?>
