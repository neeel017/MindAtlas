<?php

namespace App\Core;

use PDO;

/**
 * singleton class to manage db connection
 */
class DB
{
    /** @var PDO $pdo pdo instance */
    private static PDO $pdo;

    /**
     * private constructor to prevent initialization
     *
     **/
    private function __construct()
    {
    }

    /**
     * static method to get singleton pdo instance
     *
     * @return PDO
     **/
    public static function instance()
    {
        if (empty(static::$pdo)) {
            $config = Config::get('db');

            static::$pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';port=' . $config['port'] .  ';dbname=' . $config['database'],
                $config['user'],
                $config['password'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        }

        return static::$pdo;
    }

    /**
     * Magic method to get pdo methods
     *
     * @param string $name function name
     * @param array $arguments arguments
     **/
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([static::$pdo, $name], $arguments);
    }
}
