<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/29
 * Time: 10:14
 * To change this template use File | Settings | File Templates.
 */

class View_Admin_Pass_Images extends ViewModel
{
    public function view()
    {
        $manager = new Pass_File_Manager($this->pass);
        $pass = $this->pass;
        $this->echo_img = function ($name) use ($manager, $pass)
        {
            if (file_exists($manager->file_path($name)))
            {
                echo \Fuel\Core\Html::img(\Fuel\Core\Uri::create('admin/pass/image/' . $pass->id . '/' . $name),
                                          array('alt' => str_replace('.png', '', $name)));
            }
        };
    }

}