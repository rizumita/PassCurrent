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

        $image_names = array('icon.png', 'icon@2x.png', 'logo.png', 'logo@2x.png', 'background.png',
                             'background@2x.png',
                             'footer.png', 'footer@2x.png', 'strip.png', 'strip@2x.png', 'thumbnail.png',
                             'thumbnail@2x.png');

        $this->images = array_map(function ($image_name) use ($manager)
        {
            if (file_exists($manager->file_path($image_name)))
            {
                return array('name' => $image_name,
                             'sizes' => \Fuel\Core\Image::sizes($manager->file_path($image_name)));
            }
            else
            {
                return null;
            }
        }, array_filter($image_names, function ($image_name) use($manager) {
            if (file_exists($manager->file_path($image_name)))
            {
                return true;
            }
            else
            {
                return false;
            }
        }));

        $this->upload_image_selection = $manager->required_images_readable();
    }

}