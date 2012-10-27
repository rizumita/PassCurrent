<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/27
 * Time: 21:43
 * To change this template use File | Settings | File Templates.
 */

class Pass_File_Manager
{

    private $pass;

    public function Pass_File_Manager($pass)
    {
        $this->pass = $pass;

        if ($this->prepare_files_dir())
        {
            return $this;
        }
        else
        {
            return null;
        }
    }

    public function generate_file($name, $content)
    {
        $this->remove_file($this->file_path($name));
        \Fuel\Core\File::create($this->files_dir_path(), $name, $content);
    }

    public function files()
    {
        $files = array();

        $func = function ($name, $this_obj) use (&$files)
        {
            if (file_exists($this_obj->file_path($name)))
            {
                $files[$name] = $this_obj->file_path($name);
            }
        };

        $func('pass.json', $this);
        $func('background.png', $this);
        $func('background@2x.png', $this);
        $func('footer.png', $this);
        $func('footer@2x.png', $this);
        $func('logo.png', $this);
        $func('logo@2x.png', $this);
        $func('icon.png', $this);
        $func('icon@2x.png', $this);
        $func('strip.png', $this);
        $func('strip@2x.png', $this);
        $func('thumbnail.png', $this);
        $func('thumbnail@2x.png', $this);

        return $files;
    }

    private function prepare_files_dir()
    {
        if (!file_exists($this->files_dir_path()))
        {
            \Fuel\Core\File::create_dir(\Fuel\Core\Config::get('pass.files_dir'), $this->pass->id);
        }

        return file_exists($this->files_dir_path());
    }

    private function remove_file($path = null)
    {
        if (is_null($path))
        {
            return;
        }

        if (file_exists($path))
        {
            \Fuel\Core\File::delete($path);
        }
    }

    public function file_path($name)
    {
        return $this->files_dir_path() . DS . $name;
    }

    private function files_dir_path()
    {
        return \Fuel\Core\Config::get('pass.files_dir') . DS . $this->pass->id;
    }

}