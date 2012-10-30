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
<p>
    <strong>Relevant date:</strong>
    <?php if ($pass->relevant_date > 0) {
    echo \Fuel\Core\Date::forge($pass->relevant_date)->format('mysql');
} ?></p>

<div class="container">
    <div class="row">
        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/cert/' . $pass->id); ?>';">
            Certificate
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/images/' . $pass->id); ?>';">
            Images
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/colors/' . $pass->id); ?>';">
            Colors
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/locations/' . $pass->id); ?>';">
            Locations
        </button>
    </div>

    <h3>Fields</h3>

    <div class="row">
        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/fields/' . $pass->id . '/primary'); ?>';">
            Primary
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/fields/' . $pass->id . '/secondary'); ?>';">
            Secondary
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/fields/' . $pass->id . '/auxiliary'); ?>';">
            Auxiliary
        </button>

        <button class="btn btn-large span2"
                onclick="location.href = '<?php echo \Fuel\Core\Uri::create('admin/pass/fields/' . $pass->id . '/back'); ?>';">
            Back
        </button>
    </div>
</div>

<?php echo Html::anchor('admin/pass/edit/' . $pass->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/pass', 'Back'); ?>
