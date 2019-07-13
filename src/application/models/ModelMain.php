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
}
