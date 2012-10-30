<h2>Listing Passes</h2>
<br>
<?php if ($passes): ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Pass URL</th>
        <th>Status</th>
        <th>Action</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($passes as $pass): ?>
    <tr>

        <td><?php echo $pass->name; ?></td>
        <?php $manager = new Pass_File_Manager($pass); ?>
        <td><?php echo $manager->pkpass_url(); ?></td>
    <td><?php if (file_exists($manager->pkpass_path())): ?>
        <?php echo \Fuel\Core\Html::anchor(\Fuel\Core\Uri::create('admin/pass/pkpass/' . $pass->id), $pass->status()); ?></td>
            <?php else: ?>
        <?php echo $pass->status(); ?>
        <?php endif; ?>
        <td>
            <?php if (empty($pass->file_name)): ?>
            <?php echo \Fuel\Core\Form::open(array('action' => 'admin/pass/generate/' . $pass->id,
                                                   'method' => 'POST')); ?>
            <?php echo \Fuel\Core\Form::hidden('cert_password_' . $pass->id, ''); ?>
            <?php echo \Fuel\Core\Form::submit('submit', 'Generate', array('class' => 'btn',
                                                                           'onClick' => 'return generate_pkpass(' . $pass->id . ');')); ?>
            <?php else: ?>
            <?php echo Html::anchor('admin/pass/update/' . $pass->id, 'Update', array('onclick' => "return confirm('Are you sure?')")); ?>
            | <?php Html::anchor('admin/pass/remove/' . $pass->id, 'Remove', array('onclick' => "return confirm('Are you sure?')")); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php echo Html::anchor('admin/pass/view/' . $pass->id, 'View'); ?> |
            <?php echo Html::anchor('admin/pass/edit/' . $pass->id, 'Edit'); ?> |
            <?php echo Html::anchor('admin/pass/delete/' . $pass->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

        </td>
    </tr>
        <?php endforeach; ?>    </tbody>
</table>

<?php else: ?>
<p>No Passes.</p>

<?php endif; ?><p>
    <?php echo Html::anchor('admin/pass/create', 'Add new Pass', array('class' => 'btn btn-success')); ?>

</p>
