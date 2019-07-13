<?php
namespace src\application\controllers;

use src\application\core\Controller;
use src\application\models\ModelMain;

class ControllerMain extends Controller
{

    public function indexAction()
    {
        $this->model = new ModelMain();
        $this->view->generate('MainView.php', 'TemplateView.php', [
            'countUser' => $this->model->getCountUser()[0]]);
    }
}
