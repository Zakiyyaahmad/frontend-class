<?php

namespace App\Core;

use PDO;

class Database
{
    //database constants
    const DB_HOST = 'localhost';
    //user 
    const DB_USER = 'root';
    //password
    const DB_PASS = '';
    //database name
    const DB_NAME = 'timetable';
    private static $dbh;
    //make connection
    public static function connect()
    {
        try {
            $dbh = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            //set error mode
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //set default fetch mode
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            //set dbh
            self::$dbh = $dbh;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode(), $e->getPrevious(), $e->getTraceAsString(), $e->getLine(), $e->getFile());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), (int) $e->getCode(), $e->getPrevious(), $e->getTraceAsString(), $e->getLine(), $e->getFile());
        }
    }

    //dbh
    public static function dbh()
    {
        self::connect();
        return self::$dbh;
    }
}
