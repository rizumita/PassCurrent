<?php if (isset($pass)): ?>

<?php echo Form::open(); ?>

<fieldset>
    <div class="clearfix">
        <?php echo Form::label('Background Color', 'background_color'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::input('background_color', \Fuel\Core\Input::post('background_color', $pass->background_color)); ?>
            <script type="text/javascript"> $("#form_background_color").modcoder_excolor(); </script>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Foreground Color', 'foreground_color'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::input('foreground_color', \Fuel\Core\Input::post('foreground_color', $pass->foreground_color)); ?>
            <script type="text/javascript"> $("#form_foreground_color").modcoder_excolor(); </script>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Label Color', 'label_color'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::input('label_color', \Fuel\Core\Input::post('label_color', $pass->label_color)); ?>
            <script type="text/javascript"> $("#form_label_color").modcoder_excolor(); </script>
        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
