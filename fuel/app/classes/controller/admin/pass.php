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
            $pass->name = Input::post('name');
            $pass->description = Input::post('description');
            $pass->logo_text = Input::post('logo_text');
            $pass->pass_type_identifier = Input::post('pass_type_identifier');
            $pass->team_identifier = Input::post('team_identifier');
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
                $pass->name = $val->validated('name');
                $pass->description = $val->validated('description');
                $pass->logo_text = $val->validated('logo_text');
                $pass->pass_type_identifier = $val->validated('pass_type_identifier');
                $pass->team_identifier = $val->validated('team_identifier');
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
            $manager = new Pass_File_Manager($pass);

            if ($manager->get_upload_files(array('p12')))
            {
                Session::set_flash('error', $manager->error);
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

    public function action_images($id = null)
    {
        $pass = Model_Pass::find($id);

        if (Input::method() == 'POST')
        {
            $manager = new Pass_File_Manager($pass);

            if ($manager->get_upload_files(array('png')) == false)
            {
                Session::set_flash('error', $manager->error);
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
        $this->template->title = "Pass Images";
        $images_vm = ViewModel::forge('admin/pass/images');
        $images_vm->pass = $pass;
        $this->template->content = $images_vm;
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

    public function action_image($id = null, $name = null)
    {
        $pass = Model_Pass::find($id);
        $manager = new Pass_File_Manager($pass);
        $path = $manager->file_path($name . '.png');

        $body = null;

        if (file_exists($path))
        {
            $info = \Fuel\Core\File::file_info($path);
            $body = file_get_contents($path);
        }

        return Response::forge($body, 200, array('Content-Type' => 'image/png',
                                                 'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                                                 'Content-Length' => $info['size']));
    }

    public function post_generate($id = null)
    {
        $pass = Model_Pass::find($id);

        if (!empty($pass))
        {
            $error = $pass->generate(\Fuel\Core\Input::post('cert_password', ''));
            if (empty($error))
            {
                Session::set_flash('success', e('Generated pass #' . $id));
            }
            else
            {
                Session::set_flash('error', e('Could not generate pass #' . $id . ". " . $error));
            }
        }

        Response::redirect('admin/pass');
    }

    public function action_colors($id = null)
    {
        $pass = Model_Pass::find($id);
        $val = \Fuel\Core\Validation::forge();
        $val->add_field('background_color', 'Background Color', 'max_length[255]');
        $val->add_field('foreground_color', 'Foreground Color', 'max_length[255]');
        $val->add_field('label_color', 'Label Color', 'max_length[255]');

        if ($val->run())
        {
            $pass->background_color = \Fuel\Core\Input::post('background_color');
            $pass->foreground_color = \Fuel\Core\Input::post('foreground_color');
            $pass->label_color = \Fuel\Core\Input::post('label_color');

            if ($pass->save())
            {
                Session::set_flash('success', e('Set colors of pass #' . $id));

                Response::redirect('admin/pass/view/' . $id);
            }
            else
            {
                Session::set_flash('error', e('Could not update pass #' . $id));
            }
        }
        else
        {
            if (\Fuel\Core\Input::method() == 'POST')
            {
                $pass->background_color = $val->validated('background_color');
                $pass->foreground_color = $val->validated('foreground_color');
                $pass->label_color = $val->validated('label_color');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('pass', $pass, false);
        }

        $this->template->title = "Passe colors";
        $this->template->set_safe('head', '<script type="text/javascript" src="' . \Fuel\Core\Uri::base() . 'assets/modcoder_excolor/jquery.modcoder.excolor.js"></script>');
        $this->template->content = View::forge('admin/pass/colors');
    }
}