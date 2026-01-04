<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                global $config;

                $dsn = sprintf(
                    'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
                    $config['db']['host'],
                    $config['db']['port'],
                    $config['db']['dbname']
                );

                self::$instance = new PDO(
                    $dsn,
                    $config['db']['user'],
                    $config['db']['pass'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
            } catch (PDOException $e) {
                // 正式環境不 echo
                throw new PDOException('Database connection failed');
            }
        }

        return self::$instance;
    }
}
