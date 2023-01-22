<?php

namespace App\Models;

/**
 * User model
 */
class User extends Model
{
    /**
     * creates user
     *
     * @param string $firstName First name
     * @param string $surName Surname
     * @return int
     **/
    public function create(string $firstName, string $surName): int
    {
        $query = "INSERT INTO users (firstname, surname) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$firstName, $surName]);

        return (int) $this->db->lastInsertId();
    }
}
