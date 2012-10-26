<?php if (isset($pass)): ?>

<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>

<fieldset>
    <div class="clearfix">
        <?php echo Form::label('Background 180×220', 'background'); ?>

        <?php if ($pass->background) : ?>
        <img src="<?php echo \Fuel\Core\Uri::create('admin/pass/image/' . $pass->id . '/background'); ?>" alt="Background">
        <?php endif; ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('background'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Background Retina', 'background2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('background2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Footer 286×15', 'footer'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('footer'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Footer Retina', 'footer2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('footer2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Logo 160×50', 'logo'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('logo'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Logo Retina', 'logo2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('logo2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Icon 29x29', 'icon'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('icon'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Icon Retina', 'icon2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('icon2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Strip 312×110, 312×123', 'strip'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('strip'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Strip Retina', 'strip2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('strip2x'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Thumbnail 90×90', 'thumbnail'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('thumbnail'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo Form::label('Thumbnail Retina', 'thumbnail2x'); ?>

        <div class="input">
            <?php echo \Fuel\Core\Form::file('thumbnail2x'); ?>
        </div>
    </div>
    <div class="actions">
        <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass', 'Back'); ?></p>
