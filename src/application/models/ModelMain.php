<?php

namespace src\application\models;

use src\application\core\Model;
use src\application\Database;

class ModelMain extends Model
{
    public function getCountUser()
    {
        $conn = Database::connect();
        return $conn->query("SELECT COUNT(idUser) as total FROM user");
    }

    public function checkExistsEmail($email)
    {
        $conn = Database::connect();
        $executeQuery = $conn->query("SELECT COUNT(idUser) as total FROM user WHERE email =?", [$email])[0];

        return $executeQuery['total'] > 0 ? true : false;
    }
}
