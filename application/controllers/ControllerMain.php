<?php

namespace application\controllers;

use application\core\Controller;
use application\models\ModelMain;

class ControllerMain extends Controller
{
    /**
     * Show the first form
     */
    public function index()
    {
        $this->model = new ModelMain();
        $this->view->generate('MainView.php', [
            'countUser' => $this->model->getCountUser()[0],
        ]);
    }

    /**
     * Check if a user is registered with this email
     */
    public function checkExistsEmail()
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

    /**
     * Save user information from the first form
     */
    public function saveUserInfo()
    {
        if (! empty(filter_input_array(INPUT_POST))) {
            $this->model = new ModelMain();
            if ($idUser = $this->model->saveUserInfo(filter_input_array(INPUT_POST))) {
                setcookie("idUser", $idUser, 0, '/');
                $this->view->generate('Profile.php', [
                    'countUser' => $this->model->getCountUser()[0],
                ]);
            }
        }
    }

    /**
     * Update user information from the second form
     */
    public function updateUserInfo()
    {
        if (! empty(filter_input_array(INPUT_POST))) {
            $config = require __DIR__.'/../config/share_config.php';
            $this->model = new ModelMain();
            $target = null;

            if (isset($_FILES['photo']['name']) && ! empty($_FILES['photo']['name'])) {
                $imageName = $_FILES['photo']['name'];
                $target = 'public/img/users/'.$imageName;
                if (! is_dir('public/img/users/')) {
                    mkdir('public/img/users/');
                }
                move_uploaded_file($_FILES['photo']['tmp_name'], $target);
            }

            if ($this->model->updateUserInfo(filter_input_array(INPUT_POST), $target)) {
                unset(filter_input_array(INPUT_COOKIE)['idUser']);
                setcookie('idUser', null, -1, '/');
                $this->view->generate('SocialNetworks.php', [
                    'countUser' => $this->model->getCountUser()[0],
                    'config'    => $config['share'],
                ]);
            }
        }
    }
}
