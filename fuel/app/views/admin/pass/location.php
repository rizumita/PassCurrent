<h2>Location: <?php echo $pass->title; ?></h2>


<?php echo \Fuel\Core\Form::open(); ?>
<div class="clearfix">
    <div class="input">
        <?php echo \Fuel\Core\Form::input('lat', '', array('class' => 'span4')); ?>
    </div>
</div>
<div class="clearfix">
    <div class="input">
        <?php echo \Fuel\Core\Form::input('lng', '', array('class' => 'span4')); ?>
    </div>
</div>

<?php echo Html::anchor('admin/pass', 'Back'); ?>