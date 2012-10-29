<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>

<fieldset>
<div class="clearfix">
    <?php echo Form::label('Name', 'name'); ?>

    <div class="input">
        <?php echo Form::input('name', Input::post('name', isset($pass) ? $pass->name : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Description', 'description'); ?>

    <div class="input">
        <?php echo Form::textarea('description', Input::post('description', isset($pass) ? $pass->description : ''), array('class' => 'span8',
                                                                                                                           'rows' => 8)); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Logo text', 'logo_text'); ?>

    <div class="input">
        <?php echo Form::input('logo_text', Input::post('logo_text', isset($pass) ? $pass->logo_text : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Barcode message', 'barcode_message'); ?>

    <div class="input">
        <?php echo Form::input('barcode_message', Input::post('barcode_message', isset($pass) ? $pass->barcode_message : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Barcode format', 'barcode_format'); ?>

    <div class="input">
        <?php echo \Fuel\Core\Form::select('barcode_format', Input::post('barcode_format', isset($pass) ? $pass->barcode_format : 0), array('QR',
                                                                                                                                            'PDF417',
                                                                                                                                            'Aztec'),
                                           array('class' => 'span2')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Offer Label', 'offer_label'); ?>

    <div class="input">
        <?php echo Form::input('offer_label', Input::post('offer_label', isset($pass) ? $pass->offer_label : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Offer value', 'offer_value'); ?>

    <div class="input">
        <?php echo Form::input('offer_value', Input::post('offer_value', isset($pass) ? $pass->offer_value : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="actions">
    <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

</div>
</fieldset>
<?php echo Form::close(); ?>