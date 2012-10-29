<?php if (isset($pass)): ?>

<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>

<fieldset>
    <div class="clearfix">
        <div class="input">
            <?php echo \Fuel\Core\Form::file('certificate'); ?>
        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
