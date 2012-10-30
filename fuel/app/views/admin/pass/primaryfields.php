<h2>Listing Pass Primary Field</h2>
<br>

<?php echo \Fuel\Core\Form::open(); ?>

<fieldset>
    <div class="clearfix">
        <?php echo \Fuel\Core\Form::label('Label', 'label'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::input('label', \Fuel\Core\Input::post('label', isset($field) ? $field->label : '')); ?>
        </div>
    </div>

    <div class="clearfix">
        <?php echo \Fuel\Core\Form::label('Value', 'value'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::input('value', \Fuel\Core\Input::post('value', isset($field) ? $field->value : '')); ?>
        </div>
    </div>

    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>

<?php echo \Fuel\Core\Form::close(); ?>

<p><?php echo \Fuel\Core\Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
