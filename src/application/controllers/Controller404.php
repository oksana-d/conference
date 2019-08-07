<?php

namespace src\application\controllers;

use src\application\core\Controller;

class Controller404 extends Controller
{
    /**
     * Show page 404
     */
    public function indexAction()
    {
        $this->view->generate('404.php', 'TemplateView.php');
    }
}
