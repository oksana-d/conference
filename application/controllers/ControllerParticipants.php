<?php

namespace application\controllers;

use application\core\Controller;
use application\models\ModelParticipants;

class ControllerParticipants extends Controller
{
    /**
     * Show all registered conference participants
     */
    public function index()
    {
        $this->model = new ModelParticipants();
        $this->view->generate('ParticipantsView.php', 'TemplateView.php', [
            'users' => $this->model->getAllUsers(),
        ]);
    }
}
