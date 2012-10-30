<?php if (isset($pass)): ?>
<?php $manager = new Pass_File_Manager($pass); ?>
<?php if (file_exists($manager->file_path('certificate.p12'))): ?>
    <p>File uploaded.</p>
    <?php endif; ?>

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
