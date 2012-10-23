<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>

<fieldset>
<div class="clearfix">
    <?php echo Form::label('Title', 'title'); ?>

    <div class="input">
        <?php echo Form::input('title', Input::post('title', isset($pass) ? $pass->title : ''), array('class' => 'span4')); ?>

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
    <?php echo Form::label('Pass Type Identifier', 'pass_type_identifier'); ?>

    <div class="input">
        <?php echo Form::input('pass_type_identifier', Input::post('pass_type_identifier', isset($pass) ? $pass->pass_type_identifier : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Team Identifier', 'team_identifier'); ?>

    <div class="input">
        <?php echo Form::input('team_identifier', Input::post('team_identifier', isset($pass) ? $pass->team_identifier : ''), array('class' => 'span4')); ?>

    </div>
</div>
<!--<div class="clearfix">-->
<!--    --><?php //echo Form::label('Certification File', 'cert_file'); ?>
<!---->
<!--    --><?php //echo Input::post('cert_name', isset($pass) ? $pass->cert_name : 'No uploaded file.'); ?>
<!--    <div class="input">-->
<!--        --><?php //echo \Fuel\Core\Form::file('cert_file'); ?>
<!--    </div>-->
<!--</div>-->
<div class="clearfix">
    <?php echo Form::label('Background color', 'background_color'); ?>

    <div class="input">
        <?php echo Form::input('background_color', Input::post('background_color', isset($pass) ? $pass->background_color : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Foreground color', 'foreground_color'); ?>

    <div class="input">
        <?php echo Form::input('foreground_color', Input::post('foreground_color', isset($pass) ? $pass->foreground_color : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Label color', 'label_color'); ?>

    <div class="input">
        <?php echo Form::input('label_color', Input::post('label_color', isset($pass) ? $pass->label_color : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Signature', 'signature'); ?>

    <div class="input">
        <?php echo Form::input('signature', Input::post('signature', isset($pass) ? $pass->signature : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Logo', 'logo'); ?>

    <div class="input">
        <?php echo \Fuel\Core\Form::file('logo_file'); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Logo2x', 'logo2x'); ?>

    <div class="input">
        <?php echo Form::input('logo2x', Input::post('logo2x', isset($pass) ? $pass->logo2x : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Icon', 'icon'); ?>

    <div class="input">
        <?php echo Form::input('icon', Input::post('icon', isset($pass) ? $pass->icon : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Icon2x', 'icon2x'); ?>

    <div class="input">
        <?php echo Form::input('icon2x', Input::post('icon2x', isset($pass) ? $pass->icon2x : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Strip', 'strip'); ?>

    <div class="input">
        <?php echo Form::input('strip', Input::post('strip', isset($pass) ? $pass->strip : ''), array('class' => 'span4')); ?>

    </div>
</div>
<div class="clearfix">
    <?php echo Form::label('Strip2x', 'strip2x'); ?>

    <div class="input">
        <?php echo Form::input('strip2x', Input::post('strip2x', isset($pass) ? $pass->strip2x : ''), array('class' => 'span4')); ?>

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