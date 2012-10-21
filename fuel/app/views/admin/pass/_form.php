<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Title', 'title'); ?>

			<div class="input">
				<?php echo Form::input('title', Input::post('title', isset($pass) ? $pass->title : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Description', 'description'); ?>

			<div class="input">
				<?php echo Form::textarea('description', Input::post('description', isset($pass) ? $pass->description : ''), array('class' => 'span8', 'rows' => 8)); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Logo text', 'logo_text'); ?>

			<div class="input">
				<?php echo Form::input('logo_text', Input::post('logo_text', isset($pass) ? $pass->logo_text : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Identifier', 'identifier'); ?>

			<div class="input">
				<?php echo Form::input('identifier', Input::post('identifier', isset($pass) ? $pass->identifier : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Background color', 'background_color'); ?>

			<div class="input">
				<?php echo Form::input('background_color', Input::post('background_color', isset($pass) ? $pass->background_color : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Foreground color', 'foreground_color'); ?>

			<div class="input">
				<?php echo Form::input('foreground_color', Input::post('foreground_color', isset($pass) ? $pass->foreground_color : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Label color', 'label_color'); ?>

			<div class="input">
				<?php echo Form::input('label_color', Input::post('label_color', isset($pass) ? $pass->label_color : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Altitude', 'altitude'); ?>

			<div class="input">
				<?php echo Form::input('altitude', Input::post('altitude', isset($pass) ? $pass->altitude : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Latitude', 'latitude'); ?>

			<div class="input">
				<?php echo Form::input('latitude', Input::post('latitude', isset($pass) ? $pass->latitude : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Longitude', 'longitude'); ?>

			<div class="input">
				<?php echo Form::input('longitude', Input::post('longitude', isset($pass) ? $pass->longitude : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Relevant text', 'relevant_text'); ?>

			<div class="input">
				<?php echo Form::input('relevant_text', Input::post('relevant_text', isset($pass) ? $pass->relevant_text : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Signature', 'signature'); ?>

			<div class="input">
				<?php echo Form::input('signature', Input::post('signature', isset($pass) ? $pass->signature : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Logo', 'logo'); ?>

			<div class="input">
				<?php echo Form::input('logo', Input::post('logo', isset($pass) ? $pass->logo : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Logo2x', 'logo2x'); ?>

			<div class="input">
				<?php echo Form::input('logo2x', Input::post('logo2x', isset($pass) ? $pass->logo2x : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Icon', 'icon'); ?>

			<div class="input">
				<?php echo Form::input('icon', Input::post('icon', isset($pass) ? $pass->icon : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Icon2x', 'icon2x'); ?>

			<div class="input">
				<?php echo Form::input('icon2x', Input::post('icon2x', isset($pass) ? $pass->icon2x : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Strip', 'strip'); ?>

			<div class="input">
				<?php echo Form::input('strip', Input::post('strip', isset($pass) ? $pass->strip : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Strip2x', 'strip2x'); ?>

			<div class="input">
				<?php echo Form::input('strip2x', Input::post('strip2x', isset($pass) ? $pass->strip2x : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

		</div>
	</fieldset>
<?php echo Form::close(); ?>