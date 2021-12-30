<?php


namespace app\core;

use \PDO;

class Database
{
    private static $instance = null;

    private static PDO $pdo;

    private function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        self::$pdo = new PDO($dsn, $user, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function connect(array $config)
    {
        if (self::$instance == null) {
            self::$instance = new Database($config);
        }

        return self::$instance;
    }

    public static function prepare($sql)
    {
        return self::$pdo->prepare($sql);
    }
}
