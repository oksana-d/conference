<?php
namespace src\application\core;

class View
{
    public function generate($contentView, $templateView, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }

        include 'src/application/views/'.$templateView;
    }

    public function ajaxGenerate($contentView, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }

        include 'src/application/views/'.$contentView;
    }
}
