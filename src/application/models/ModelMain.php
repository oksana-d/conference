<?php

namespace src\application\models;

use src\application\core\Model;

class ModelMain extends Model
{
    public function getCountUser()
    {
        return $this->conn->query("SELECT COUNT(idUser) as total FROM user");
    }

    public function checkExistsEmail($email)
    {
        $executeQuery = $this->conn->query("SELECT COUNT(idUser) as total FROM user WHERE email =?", [$email])[0];

        return $executeQuery['total'] > 0 ? true : false;
    }

    public function saveUserInfo($data)
    {
        $executeQuery = $this->conn->query("
            INSERT INTO user (firstname, lastname, birthday, reportSubject, country, phone, email)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $data['firstname'],
                $data['lastname'],
                date('Y-m-d', strtotime($data['birthday'])),
                $data['reportSubject'],
                $data['country'],
                $data['phone'],
                $data['email'],
            ]);

        if ($executeQuery) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    public function updateUserInfo($data, $img = null)
    {
        if ( ! empty(filter_input_array(INPUT_COOKIE)['idUser'])) {
            $executeQuery = $this->conn->query("
              INSERT INTO profile (idUser, company, position, aboutMe, photo)
              VALUES (?, ?, ?, ?, ?)
            ", [
                filter_input_array(INPUT_COOKIE)['idUser'],
                $data['company'],
                $data['position'],
                $data['aboutMe'],
                $img,
            ]);

            if ($executeQuery) {
                return true;
            } else {
                return false;
            }
        }
    }
}
