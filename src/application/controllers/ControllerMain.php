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

    public function checkExistsEmailAction()
    {
        if (isset($_POST['email'])) {
            $this->model = new ModelMain();
            if ($this->model->checkExistsEmail($_POST['email'])) {
                echo(json_encode(false));
            } else {
                echo(json_encode(true));
            }
        }
    }
}
