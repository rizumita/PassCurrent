<h2>Listing Pass Locations</h2>
<br>
<?php if (isset($pass)): ?>

<?php if (count($pass->locations) >= 10): ?>
    <p>It reach the upper limit of locations. To add new location, delete unnecessary location.</p>
    <?php endif; ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Altitude</th>
        <th>Relevant Text</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($pass->locations as $location): ?>
    <tr>
        <td><?php echo $location->latitude; ?></td>
        <td><?php echo $location->longitude; ?></td>
        <td><?php echo $location->altitude; ?></td>
        <td><?php echo $location->relevant_text ?></td>
        <td>
            <?php echo Html::anchor('admin/pass/delete_location/' . $location->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
        </td>
    </tr>
        <?php endforeach; ?>
    <tr>
        <?php if (count($pass->locations) < 10): ?>
        <?php echo \Fuel\Core\Form::open(); ?>
        <td><?php echo \Fuel\Core\Form::input('latitude', '', array('class' => 'span3',
                                                                    'placeholder' => 'Number')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('longitude', '', array('class' => 'span3',
                                                                     'placeholder' => 'Number')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('altitude', '', array('class' => 'span3',
                                                                    'placeholder' => 'Number, allow no value')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('relevant_text', '', array('class' => 'span3',
                                                                         'placeholder' => 'Allow no value')); ?></td>
        <td><?php echo \Fuel\Core\Form::submit('submit', 'Save', array('class' => 'btn btn-primary')) ?></td>
        <?php echo \Fuel\Core\Form::close(); ?>
        <?php endif; ?>
    </tr>
    </tbody>
</table>

<p><?php echo \Fuel\Core\Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
<?php endif; ?>
