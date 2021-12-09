<?php


namespace Plots\Core;
use PDO;
use PDOException;

class Db
{
    private static $instance;

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
                self::$instance == self::connect();
            }catch(PDOException $ex){
                // TODO: show exception on the error page
            }

        }
        return self::$instance;
    }
}