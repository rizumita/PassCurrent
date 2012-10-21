<?php
class Controller_Admin_Pass extends Controller_Admin 
{

	public function action_index()
	{
		$data['passes'] = Model_Pass::find('all');
		$this->template->title = "Passes";
		$this->template->content = View::forge('admin/pass/index', $data);

	}

	public function action_view($id = null)
	{
		$data['pass'] = Model_Pass::find($id);

		$this->template->title = "Pass";
		$this->template->content = View::forge('admin/pass/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Pass::validate('create');

			if ($val->run())
			{
				$pass = Model_Pass::forge(array(
					'title' => Input::post('title'),
					'description' => Input::post('description'),
					'logo_text' => Input::post('logo_text'),
					'identifier' => Input::post('identifier'),
					'background_color' => Input::post('background_color'),
					'foreground_color' => Input::post('foreground_color'),
					'label_color' => Input::post('label_color'),
					'altitude' => Input::post('altitude'),
					'latitude' => Input::post('latitude'),
					'longitude' => Input::post('longitude'),
					'relevant_text' => Input::post('relevant_text'),
					'signature' => Input::post('signature'),
					'logo' => Input::post('logo'),
					'logo2x' => Input::post('logo2x'),
					'icon' => Input::post('icon'),
					'icon2x' => Input::post('icon2x'),
					'strip' => Input::post('strip'),
					'strip2x' => Input::post('strip2x'),
				));

				if ($pass and $pass->save())
				{
					Session::set_flash('success', e('Added pass #'.$pass->id.'.'));

					Response::redirect('admin/pass');
				}

				else
				{
					Session::set_flash('error', e('Could not save pass.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Passes";
		$this->template->content = View::forge('admin/pass/create');

	}

	public function action_edit($id = null)
	{
		$pass = Model_Pass::find($id);
		$val = Model_Pass::validate('edit');

		if ($val->run())
		{
			$pass->title = Input::post('title');
			$pass->description = Input::post('description');
			$pass->logo_text = Input::post('logo_text');
			$pass->identifier = Input::post('identifier');
			$pass->background_color = Input::post('background_color');
			$pass->foreground_color = Input::post('foreground_color');
			$pass->label_color = Input::post('label_color');
			$pass->altitude = Input::post('altitude');
			$pass->latitude = Input::post('latitude');
			$pass->longitude = Input::post('longitude');
			$pass->relevant_text = Input::post('relevant_text');
			$pass->signature = Input::post('signature');
			$pass->logo = Input::post('logo');
			$pass->logo2x = Input::post('logo2x');
			$pass->icon = Input::post('icon');
			$pass->icon2x = Input::post('icon2x');
			$pass->strip = Input::post('strip');
			$pass->strip2x = Input::post('strip2x');

			if ($pass->save())
			{
				Session::set_flash('success', e('Updated pass #' . $id));

				Response::redirect('admin/pass');
			}

			else
			{
				Session::set_flash('error', e('Could not update pass #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$pass->title = $val->validated('title');
				$pass->description = $val->validated('description');
				$pass->logo_text = $val->validated('logo_text');
				$pass->identifier = $val->validated('identifier');
				$pass->background_color = $val->validated('background_color');
				$pass->foreground_color = $val->validated('foreground_color');
				$pass->label_color = $val->validated('label_color');
				$pass->altitude = $val->validated('altitude');
				$pass->latitude = $val->validated('latitude');
				$pass->longitude = $val->validated('longitude');
				$pass->relevant_text = $val->validated('relevant_text');
				$pass->signature = $val->validated('signature');
				$pass->logo = $val->validated('logo');
				$pass->logo2x = $val->validated('logo2x');
				$pass->icon = $val->validated('icon');
				$pass->icon2x = $val->validated('icon2x');
				$pass->strip = $val->validated('strip');
				$pass->strip2x = $val->validated('strip2x');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('pass', $pass, false);
		}

		$this->template->title = "Passes";
		$this->template->content = View::forge('admin/pass/edit');

	}

	public function action_delete($id = null)
	{
		if ($pass = Model_Pass::find($id))
		{
			$pass->delete();

			Session::set_flash('success', e('Deleted pass #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete pass #'.$id));
		}

		Response::redirect('admin/pass');

	}


}