<?php

namespace application\controllers;

use application\core\Controller;

class Controller404 extends Controller
{
    /**
     * Show page 404
     */
    public function index()
    {
        $this->view->generate('404.php', 'TemplateView.php');
    }
}
