<?php


namespace Plots\Core;
use PDO;
use PDOException;
use Plots\Exceptions\NotFoundException;

class Db
{
    private static $instance;

    /**
     * @throws NotFoundException
     */
    private static function connect(): PDO{
        $dbConfig = Config::getInstance()->get('db');
        return new PDO(
            $dbConfig['driver'] . ':' . 'host:' . $dbConfig['host'] . 'dbname:' . $dbConfig['database'],
            $dbConfig['user'],
            $dbConfig['password']
        );
    }

    public static function getInstance() :PDO{
        if (self::$instance == null) {
            try{
                self::$instance = self::connect();

            } catch (NotFoundException $e) {
                echo $e->getMessage();
                exit;
            }

        }
        return self::$instance;
    }
}