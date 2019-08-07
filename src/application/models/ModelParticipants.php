<?php

namespace src\application\models;

use src\application\core\Model;
use PDOStatement;

class ModelParticipants extends Model
{
    /**
     * Get the information of the conference participants
     *
     * @return false|PDOStatement
     */
    public function getAllUsers()
    {
        $result = $this->conn->query("
            SELECT user.idUser, photo, firstname, lastname, reportSubject, email
            FROM user
            left JOIN profile on profile.idUser = user.idUser");

        return $result;
    }
}
