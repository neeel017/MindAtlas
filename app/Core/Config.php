<?php

namespace App\Core;

/**
 * config class for managing app configs
 */
class Config
{
    /** @var array $config config array */
    protected array $config = [];

    /**
     * set configuration
     *
     * @param array $env env config array
     **/

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'port' => $env['DB_PORT'],
                'user' => $env['DB_USER'],
                'password' => $env['DB_PASSWORD'],
                'database' => $env['DB_DATABASE'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
            ]
        ];
    }

    /**
     * static function to get config
     *
     * @param string $key config key
     * @return array|string|null
     **/
    public static function get(string $key)
    {
        $obj = (new static($_ENV));
        return $obj->config[$key] ?? null;
    }
}
