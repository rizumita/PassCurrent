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
                                               'name' => Input::post('name'),
                                               'description' => Input::post('description'),
                                               'logo_text' => Input::post('logo_text'),
                                               'pass_type_identifier' => Input::post('pass_type_identifier'),
                                               'team_identifier' => Input::post('team_identifier'),
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
                                               'barcode_message' => Input::post('barcode_message'),
                                               'barcode_format' => Input::post('barcode_format'),
                                               'offer_label' => Input::post('offer_label'),
                                               'offer_value' => Input::post('offer_value'),
                                          ));

                if ($pass and $pass->save())
                {
                    Session::set_flash('success', e('Added pass #' . $pass->id . '.'));

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
            $pass->title = Input::post('name');
            $pass->description = Input::post('description');
            $pass->logo_text = Input::post('logo_text');
            $pass->pass_type_identifier = Input::post('pass_type_identifier');
            $pass->team_identifier = Input::post('team_identifier');
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
            $pass->barcode_message = Input::post('barcode_message');
            $pass->barcode_format = Input::post('barcode_format');
            $pass->offer_label = \Fuel\Core\Input::post('offer_label');
            $pass->offer_value = \Fuel\Core\Input::post('offer_value');

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
                $pass->title = $val->validated('name');
                $pass->description = $val->validated('description');
                $pass->logo_text = $val->validated('logo_text');
                $pass->pass_type_identifier = $val->validated('pass_type_identifier');
                $pass->team_identifier = $val->validated('team_identifier');
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
                $pass->barcode_message = $val->validated('barcode_message');
                $pass->barcode_format = $val->validated('barcode_format');
                $pass->offer_label = $val->validated('offer_label');
                $pass->offer_value = $val->validated('offer_value');

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

            Session::set_flash('success', e('Deleted pass #' . $id));
        }

        else
        {
            Session::set_flash('error', e('Could not delete pass #' . $id));
        }

        Response::redirect('admin/pass');
    }

    public function action_cert($id = null)
    {
        $pass = Model_Pass::find($id);

        if (Input::method() == 'POST')
        {
            $upload_result = $pass->get_upload_files();

            $error_upload = count($upload_result) > 0;

            if ($error_upload)
            {
                Session::set_flash('error', $upload_result);
            }
            elseif ($pass and $pass->save())
            {
                Session::set_flash('success', e('Added pass #' . $pass->id . '.'));

                Response::redirect('admin/pass');
            }
            else
            {
                Session::set_flash('error', e('Could not save pass.'));
            }
        }

        $this->template->set_global('pass', $pass);
        $this->template->title = "Pass Certificate";
        $this->template->content = View::forge('admin/pass/cert');
    }

    public function action_locations($id = null)
    {
        $pass = Model_Pass::find($id);

        if (Input::method() == 'POST')
        {
            $val = Model_Location::validate('create');
            if ($val->run())
            {
                $location = Model_Location::forge(array(
                                                       'latitude' => \Fuel\Core\Input::post('latitude'),
                                                       'longitude' => \Fuel\Core\Input::post('longitude'),
                                                       'altitude' => \Fuel\Core\Input::post('altitude', null),
                                                       'relevant_text' => \Fuel\Core\Input::post('relevant_text', null),
                                                  ));
                $pass->locations[] = $location;

                if ($location and $pass->save())
                {
                    Session::set_flash('success', e('Added location #' . $location->id . '.'));
                    \Fuel\Core\Response::redirect('admin/pass/locations/' . $id);
                    return;
                }
                else
                {
                    Session::set_flash('error', e('Could not save location.'));
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->set_global('pass', $pass, false);
        $this->template->title = "Pass Locations";
        $this->template->content = View::forge('admin/pass/locations');
    }

    public function action_delete_location($id = null)
    {
        if ($location = Model_Location::find($id))
        {
            $pass = $location->pass;
            $location->delete();

            Session::set_flash('success', e('Deleted location #' . $id));

            Response::redirect('admin/pass/locations/' . $pass->id);
        }
        else
        {
            Session::set_flash('error', e('Could not delete location #' . $id));
            Response::redirect('admin/pass');
        }
    }
}