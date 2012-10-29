<?php if (isset($pass)): ?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>File</th>
        <th>Size</th>
        <th>Thumbnail</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($images as $image): ?>
    <tr>
        <td><?php echo $image['name']; ?></td>
        <td><?php echo $image['sizes']->width . ' x ' . $image['sizes']->height; ?></td>
        <td><?php $echo_img($image['name']); ?></td>
        <td>
            <?php echo Html::anchor('admin/pass/delete_image/' . $pass->id . '/' . $image['name'], 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
        </td>
    </tr>
        <?php endforeach; ?>
    <tr>
        <?php echo \Fuel\Core\Form::open(array('enctype' => 'multipart/form-data')); ?>
        <td><?php echo \Fuel\Core\Form::select('upload_image_selection', '', $upload_image_selection); ?></td>
        <td><?php echo \Fuel\Core\Form::file('upload_image'); ?></td>
        <td></td>
        <td><?php echo \Fuel\Core\Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?></td>
        <?php echo \Fuel\Core\Form::close(); ?>
    </tr>
    </tbody>
</table>

<?php endif; ?>

<p><?php echo Html::anchor('admin/pass/view/' . $pass->id, 'Back'); ?></p>
