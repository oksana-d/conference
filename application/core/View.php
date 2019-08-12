<?php

namespace application\core;

class View
{
    public function generate($contentView, $templateView, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        include 'application/views/'.$templateView;
        
        
    }

    public function ajaxGenerate($contentView, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        include 'application/views/'.$contentView;
    }
}
