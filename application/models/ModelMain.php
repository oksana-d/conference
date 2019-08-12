<?php

namespace application\models;

use application\core\Model;
use PDOStatement;

class ModelMain extends Model
{
    /**
     * Get count conference participants
     *
     * @return false|PDOStatement
     */
    public function getCountUser()
    {
        return $this->conn->query("SELECT COUNT(idUser) as total FROM user");
    }

    /**
     * Check if a user is registered with this email
     *
     * @param  string  $email  Role of user email
     *
     * @return boolean
     */
    public function checkExistsEmail($email)
    {
        $executeQuery = $this->conn->query("SELECT COUNT(idUser) as total FROM user WHERE email =?", [$email])[0];

        return $executeQuery['total'] > 0 ? true : false;
    }

    /**
     * Save user information from the first form
     *
     * @param  array  $data
     *
     * @return bool|string
     */
    public function saveUserInfo($data)
    {
        $executeQuery = $this->conn->query(
            "
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
            ]
        );

        if ($executeQuery) {
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }

    /**
     * Update user information from the second form
     *
     * @param  array  $data
     * @param  string  $img
     *
     * @return bool
     */
    public function updateUserInfo($data, $img = null)
    {
        if (! empty(filter_input_array(INPUT_COOKIE)['idUser'])) {
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
            }
        }

        return false;
    }
}
