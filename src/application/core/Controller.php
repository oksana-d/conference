<?php

namespace src\application\core;

abstract class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public abstract function indexAction();
}
