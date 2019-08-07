<?php

namespace src\application\controllers;

use src\application\core\Controller;
use src\application\models\ModelParticipants;

class ControllerParticipants extends Controller
{
    /**
     * Show all registered conference participants
     */
    public function indexAction()
    {
        $this->model = new ModelParticipants();
        $this->view->generate('ParticipantsView.php', 'TemplateView.php', [
            'users' => $this->model->getAllUsers(),
        ]);
    }

}
