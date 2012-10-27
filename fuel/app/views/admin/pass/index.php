<h2>Listing Passes</h2>
<br>
<?php if ($passes): ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Certificate File</th>
        <th>Image Files</th>
        <th>Location</th>
        <th>Status</th>
        <th>File</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($passes as $pass): ?>
    <tr>

        <td><?php echo $pass->name; ?></td>
        <td><?php echo Html::anchor('admin/pass/cert/' . $pass->id, 'Configure') ?></td>
        <td><?php echo Html::anchor('admin/pass/images/' . $pass->id, 'Configure') ?></td>
        <td><?php echo Html::anchor('admin/pass/locations/' . $pass->id, 'Configure') ?></td>
        <td><?php echo $pass->status(); ?></td>
        <td>
            <?php if (empty($pass->file_name)): ?>
                <?php echo Html::anchor('admin/pass/generate/' .$pass->id, 'Generate'); ?>
            <?php else: ?>
                <?php echo Html::anchor('admin/pass/update/' .$pass->id, 'Update', array('onclick' => "return confirm('Are you sure?')")); ?>
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
