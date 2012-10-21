<h2>Listing Passes</h2>
<br>
<?php if ($passes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th>Logo text</th>
			<th>Identifier</th>
			<th>Background color</th>
			<th>Foreground color</th>
			<th>Label color</th>
			<th>Altitude</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>Relevant text</th>
			<th>Signature</th>
			<th>Logo</th>
			<th>Logo2x</th>
			<th>Icon</th>
			<th>Icon2x</th>
			<th>Strip</th>
			<th>Strip2x</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($passes as $pass): ?>		<tr>

			<td><?php echo $pass->title; ?></td>
			<td><?php echo $pass->description; ?></td>
			<td><?php echo $pass->logo_text; ?></td>
			<td><?php echo $pass->identifier; ?></td>
			<td><?php echo $pass->background_color; ?></td>
			<td><?php echo $pass->foreground_color; ?></td>
			<td><?php echo $pass->label_color; ?></td>
			<td><?php echo $pass->altitude; ?></td>
			<td><?php echo $pass->latitude; ?></td>
			<td><?php echo $pass->longitude; ?></td>
			<td><?php echo $pass->relevant_text; ?></td>
			<td><?php echo $pass->signature; ?></td>
			<td><?php echo $pass->logo; ?></td>
			<td><?php echo $pass->logo2x; ?></td>
			<td><?php echo $pass->icon; ?></td>
			<td><?php echo $pass->icon2x; ?></td>
			<td><?php echo $pass->strip; ?></td>
			<td><?php echo $pass->strip2x; ?></td>
			<td>
				<?php echo Html::anchor('admin/pass/view/'.$pass->id, 'View'); ?> |
				<?php echo Html::anchor('admin/pass/edit/'.$pass->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/pass/delete/'.$pass->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Passes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/pass/create', 'Add new Pass', array('class' => 'btn btn-success')); ?>

</p>
