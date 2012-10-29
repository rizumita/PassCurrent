<?php if (isset($pass)): ?>

<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>
<?php $manager = new Pass_File_Manager($pass); ?>

<fieldset>
    <div class="clearfix">
        <?php echo Form::label('Background 180×220', 'background'); ?>

        <?php $echo_img('background.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('background'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Background Retina', 'background@2x'); ?>

        <?php $echo_img('background@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('background@2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Footer 286×15', 'footer'); ?>

        <?php $echo_img('footer.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('footer'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Footer Retina', 'footer@2x'); ?>

        <?php $echo_img('footer@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('footer@2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Logo 160×50', 'logo'); ?>

        <?php $echo_img('logo.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('logo'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Logo Retina', 'logo@2x'); ?>

        <?php $echo_img('logo@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('logo@2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Icon 29x29', 'icon'); ?>

        <?php $echo_img('icon.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('icon'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Icon Retina', 'icon@2x'); ?>

        <?php $echo_img('icon@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('icon@2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Strip 312×110, 312×123', 'strip'); ?>

        <?php $echo_img('strip.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('strip'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Strip Retina', 'strip@2x'); ?>

        <?php $echo_img('strip@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('strip@2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Thumbnail 90×90', 'thumbnail'); ?>

        <?php $echo_img('thumbnail.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('thumbnail'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Thumbnail Retina', 'thumbnail@2x'); ?>

        <?php $echo_img('thumbnail@2x.png'); ?>
        <div class="input">
            <?php echo \Fuel\Core\Form::file('thumbnail@2x'); ?>
        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass', 'Back'); ?></p>
