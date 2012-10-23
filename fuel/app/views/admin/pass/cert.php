<?php if (isset($pass)): ?>

<?php if ($pass->cert): ?>
    <p>Current certificate: <?php echo $pass->cert; ?></p>
    <?php else: ?>
    <p>No certificate</p>

    <?php endif; ?>

<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>

<fieldset>
    <div class="clearfix">
        <div class="input">
            <?php echo \Fuel\Core\Form::file('cert'); ?>
        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass', 'Back'); ?></p>
