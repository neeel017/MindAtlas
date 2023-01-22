<?php

namespace App\Models;

use App\Core\DB;
use PDO;

/**
 * base class for models
 */
abstract class Model
{
    /** @var PDO $db pdo instance */
    protected PDO $db;

    /**
     * constructor to initialize pdo connection
     *
     **/
    public function __construct()
    {
        $this->db = DB::instance();
    }
}
