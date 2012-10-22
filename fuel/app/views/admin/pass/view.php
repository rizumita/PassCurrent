<h2>Viewing #<?php echo $pass->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $pass->title; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $pass->description; ?></p>
<p>
	<strong>Logo text:</strong>
	<?php echo $pass->logo_text; ?></p>
<p>
	<strong>Identifier:</strong>
	<?php echo $pass->identifier; ?></p>
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
	<strong>Altitude:</strong>
	<?php echo $pass->altitude; ?></p>
<p>
	<strong>Latitude:</strong>
	<?php echo $pass->latitude; ?></p>
<p>
	<strong>Longitude:</strong>
	<?php echo $pass->longitude; ?></p>
<p>
	<strong>Relevant text:</strong>
	<?php echo $pass->relevant_text; ?></p>
<p>
	<strong>Signature:</strong>
	<?php echo $pass->signature; ?></p>
<p>
	<strong>Logo:</strong>
	<?php echo $pass->logo; ?></p>
<p>
	<strong>Logo2x:</strong>
	<?php echo $pass->logo2x; ?></p>
<p>
	<strong>Icon:</strong>
	<?php echo $pass->icon; ?></p>
<p>
	<strong>Icon2x:</strong>
	<?php echo $pass->icon2x; ?></p>
<p>
	<strong>Strip:</strong>
	<?php echo $pass->strip; ?></p>
<p>
	<strong>Strip2x:</strong>
	<?php echo $pass->strip2x; ?></p>
<p>
	<strong>Barcode message:</strong>
	<?php echo $pass->barcode_message; ?></p>
<p>
	<strong>Barcode format:</strong>
	<?php echo $pass->barcode_format; ?></p>

<?php echo Html::anchor('admin/pass/edit/'.$pass->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/pass', 'Back'); ?>