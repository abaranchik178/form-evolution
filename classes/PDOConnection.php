<?php


namespace classes;

use \PDO;

class PDOConnection
{
    private static $pdo;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private function __construct()
    {
        static::$pdo = new PDO($_ENV['MYSQL_DSN'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $this->options);
    }

    public static function getPDO(): PDO
    {
        if (static::$pdo === null) {
            $connection = new static();
            static::$pdo = $connection::$pdo;
        }

        return static::$pdo;
    }
}