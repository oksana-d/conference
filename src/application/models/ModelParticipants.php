<?php

namespace src\application\models;

use src\application\core\Model;

class ModelParticipants extends Model
{
    public function getAllUsers()
    {;
        $result = $this->conn->query("
            SELECT user.idUser, photo, firstname, lastname, reportSubject, email
            FROM user
            left JOIN profile on profile.idUser = user.idUser");

        return $result;
    }
}
