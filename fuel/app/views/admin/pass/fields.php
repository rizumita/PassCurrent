<h2>Listing Pass <?php ucfirst($type); ?> Fields</h2>
<br>
<?php if (isset($pass)): ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>Key</th>
        <th>Label</th>
        <th>Value</th>
        <th>Others</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($fields as $field): ?>
    <tr>
        <td><?php echo $field->key; ?></td>
        <td><?php echo $field->label; ?></td>
        <td><?php echo $field->value; ?></td>
        <td><?php if (!empty($field->others)) {
            echo $field->others_readable();
        } ?></td>
        <td>
            <?php echo Html::anchor('admin/pass/delete_field/' . $field->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
        </td>
    </tr>
        <?php endforeach; ?>
    <tr>
        <?php echo \Fuel\Core\Form::open(); ?>
        <td><?php echo \Fuel\Core\Form::input('key', '', array('class' => 'span3')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('label', '', array('class' => 'span3')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('value', '', array('class' => 'span3')); ?></td>
        <td><?php echo \Fuel\Core\Form::input('others', '', array('class' => 'span3',
                                                                  'placeholder' => 'name1:content1 name2:content2 ...')); ?></td>
        <td><?php echo \Fuel\Core\Form::submit('submit', 'Save', array('class' => 'btn btn-primary')) ?></td>
        <?php echo \Fuel\Core\Form::close(); ?>
    </tr>
    </tbody>
</table>

<p><?php echo \Fuel\Core\Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
<?php endif; ?>
