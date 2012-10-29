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
<?php if (!empty($pass->barcode_message)): ?>
<p>
    <strong>Barcode message:</strong>
    <?php echo $pass->barcode_message; ?></p>
<p>
    <strong>Barcode format:</strong>
    <?php echo $pass->barcode_format_readable(); ?></p>
<?php endif; ?>

<div class="container">
    <button class="btn btn-large span2"
            onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/cert/' . $pass->id); ?>';">
        Certificate
    </button>

    <button class="btn btn-large span2"
            onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/images/' . $pass->id); ?>';">Images
    </button>

    <button class="btn btn-large span2"
            onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/colors/' . $pass->id); ?>';">Colors
    </button>

    <button class="btn btn-large span2"
            onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/locations/' . $pass->id); ?>';">
        Locations
    </button>
</div>

<?php echo Html::anchor('admin/pass/edit/' . $pass->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/pass', 'Back'); ?>
