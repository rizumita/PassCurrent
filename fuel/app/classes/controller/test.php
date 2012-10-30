<?php

class Controller_Test extends Controller_Template
{
    public $template = '';

    public function action_index()
    {
        $img = file_get_contents(DOCROOT . 'assets/img/glyphicons-halflings.png');
        return Response::forge($img, 200, array('Content-Type' =>
                                                'image/png'));
    }
}
