<?php

namespace App\Models;

/**
 * Enrolment model
 */
class Enrolment extends Model
{

    /**
     * creates an enrolment
     *
     * @param int $userId User id
     * @param int $courseId Course id
     * @param int $statusId Status id
     * @return int
     **/
    public function create(int $userId, int $courseId, int $statusId): int
    {
        $query = "INSERT INTO enrolments (user_id, course_id, status_id) VALUES (?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId, $courseId, $statusId]);

        return (int) $this->db->lastInsertId();
    }


    /**
     * paginate enrolments
     *
     * @param int $perPage limit of rows
     * @return array
     **/
    public function paginate(int $perPage)
    {
        $page = 1;
        $start = 0;
        $search = '';

        $query = "Select firstname, surname, description, name as status from enrolments
        inner join users on users.id = enrolments.user_id
        inner join courses on courses.id = enrolments.course_id
        inner join statuses on statuses.id = enrolments.status_id";
        if (!empty($_GET["search"])) {
            $search = $_GET['search'];
            $query .= " where firstname like '%{$search}%'
            or surname like '%{$search}%'
            or description like '%{$search}%'
            or name like '%{$search}%'";
        }

        $statement = $this->db->prepare("{$query}");
        $statement->execute();
        $count = $statement->rowCount();



        if (!empty($_GET["page"])) {
            $page = $_GET["page"];
            $start = ($page - 1) * $perPage;
        }



        $statement = $this->db->prepare("{$query} limit {$start},{$perPage}");
        $statement->execute();
        $result = $statement->fetchAll();
        return ['count' => $count, 'results' => $result, 'current_page' => $page, 'per_page' => $perPage, 'search' => $search];
    }
}
