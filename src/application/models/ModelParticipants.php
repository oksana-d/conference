<?php

namespace src\application\models;

use src\application\core\Model;
use src\application\Database;

class ModelParticipants extends Model
{
    public function getAllUsers()
    {
        $conn = Database::connect();
        $result = $conn->query("
            SELECT user.idUser, photo, firstname, lastname, reportSubject, email
            FROM user
            left JOIN profile on profile.idUser = user.idUser");

        return $result;
    }
}
