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
            'countUser' => $this->model->getCountUser()[0],
        ]);
    }

    public function checkExistsEmailAction()
    {
        if (filter_has_var(INPUT_POST, 'email')) {
            $this->model = new ModelMain();
            if ($this->model->checkExistsEmail(filter_input(INPUT_POST, 'email'))) {
                echo(json_encode(false));
            } else {
                echo(json_encode(true));
            }
        }
    }

    public function saveUserInfoAction()
    {
        if ( ! empty(filter_input_array(INPUT_POST))) {
            $this->model = new ModelMain();
            if ($idUser = $this->model->saveUserInfo(filter_input_array(INPUT_POST))) {
                setcookie("idUser", $idUser, 0, '/');
                $this->view->ajaxGenerate('Profile.php', [
                    'countUser' => $this->model->getCountUser()[0],
                ]);
            }
        }
    }

    public function updateUserInfoAction()
    {
        if ( ! empty(filter_input_array(INPUT_POST))) {
            $config = require __DIR__ . '/../share_config.php';
            $this->model = new ModelMain();
            $target = null;

            if (isset($_FILES['photo']['name']) && ! empty($_FILES['photo']['name'])) {
                $imageName = $_FILES['photo']['name'];
                $target = 'src/img/users/' . $imageName;
                if ( ! is_dir('src/img/users/')) {
                    mkdir('src/img/users/');
                }
                move_uploaded_file($_FILES['photo']['tmp_name'], $target);
            }

            if ($this->model->updateUserInfo(filter_input_array(INPUT_POST), $target)) {
                unset(filter_input_array(INPUT_COOKIE)['idUser']);
                setcookie('idUser', null, -1, '/');
                $this->view->ajaxGenerate('SocialNetworks.php', [
                    'countUser' => $this->model->getCountUser()[0],
                    'config'    => $config['share'],
                ]);
            }
        }
    }
}
