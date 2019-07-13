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

    public function saveUserInfo($data)
    {
        $conn = Database::connect();
        $executeQuery = $conn->query("
            INSERT INTO user (firstname, lastname, birthday, reportSubject, country, phone, email)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [$data['firstname'], $data['lastname'], date('Y-m-d', strtotime($data['birthday'])), $data['reportSubject'], $data['country'], $data['phone'], $data['email']]);

        if ($executeQuery) {
            return $conn->lastInsertId();
        } else return false;
    }

    public function updateUserInfo($data, $img = null)
    {
        $conn = Database::connect();
        if (isset($_COOKIE['idUser'])) {
            $executeQuery = $conn->query("
              INSERT INTO profile (idUser, company, position, aboutMe, photo)
              VALUES (?, ?, ?, ?, ?)
            ", [$_COOKIE['idUser'], $data['company'], $data['position'], $data['aboutMe'], $img]);

            if ($executeQuery) {
                return true;
            } else return false;
        }
    }
}
