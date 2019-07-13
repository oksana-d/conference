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

    public function saveUserInfoAction()
    {
        if ($_POST) {
            $this->model = new ModelMain();
            if ($id = $this->model->saveUserInfo($_POST)) {
                setcookie("idUser", $id,0, '/');
                $this->view->ajaxGenerate('Profile.php',[
                    'countUser' => $this->model->getCountUser()[0]]);
            }
        }
    }

    public function updateUserInfoAction()
    {
        if ($_POST) {
            $config = require __DIR__ . '/../share_config.php';
            $this->model = new ModelMain();
            $target = null;

            if (isset($_FILES['photo']['name'])&& !empty($_FILES['photo']['name'])){
                $imageName = $_FILES['photo']['name'];
                $target = 'src/img/users/'.$imageName;
                move_uploaded_file($_FILES['photo']['tmp_name'], $target);
            }

            if ($this->model->updateUserInfo($_POST, $target)) {
                unset($_COOKIE['idUser']);
                setcookie('idUser', null, -1, '/');
                $this->view->ajaxGenerate('SocialNetworks.php', [
                    'countUser' => $this->model->getCountUser()[0],
                    'config' => $config['share']]);
            }
        }
    }
}
