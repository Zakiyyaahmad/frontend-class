<?php

namespace App\Core;

class Model extends Database
{
    //get single record
    /*
    * @param string $table
    * @param int $id
    * @return object
    */
    public static function getId($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = self::dbh()->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
    }

    //get where
    /*
    * @param string $table
    * @param array $data
    * @return object
    */
    public static function getWhere($table, $array_data, $order = "", $limit = null)
    {
        $sql = "SELECT * FROM $table WHERE ";
        $sql .= implode(" = ? AND ", array_keys($array_data));
        $sql .= " = ?";
        //check if order is set
        if (!empty($order)) {
            $sql .= " ORDER BY ";
            $sql .= $order;
        }
        //check if limit is set
        if (!empty($limit)) {
            $sql .= " LIMIT ";
            $sql .= $limit;
        }
        $stmt = self::dbh()->prepare($sql);
        $stmt->execute(array_values($array_data));
        return $stmt->fetchAll();
    }

    
    //get table
    /*
    * @param string $table
    * @return object
    */
    public static function getTable($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = self::dbh()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //get single record
    /*
    * @param string $table
    * @param string $column
    * @param string $value
    * @return object
    */
    public static function getSingle($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = :value";
        $stmt = self::dbh()->prepare($sql);
        $stmt->execute([
            ':value' => $value
        ]);
        return $stmt->fetch();
    }

    //get all records
    /*
    * @param string $table
    * @return array
    */
    public static function all($table, $order = null, $limit = null)
    {
        $sql = "SELECT * FROM $table";
        //check if order is set
        if (!empty($order)) {
            $sql .= " ORDER BY ";
            $sql .= $order;
        }
        //check if limit is set
        if (!empty($limit)) {
            $sql .= " LIMIT ";
            $sql .= $limit;
        }
        $stmt = self::dbh()->prepare($sql);
    
        //execute
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //insert record
    /*
    * @param string $table
    * @param array $data
    * @return bool
    */
    public static function create($table, $array_data)
    {
        try {
            $dbh = self::dbh();
            $sql = "INSERT INTO $table (";
            $sql .= implode(", ", array_keys($array_data));
            $sql .= ") VALUES (";
            $sql .= ":" . implode(", :", array_keys($array_data));
            $sql .= ")";
            $stmt = $dbh->prepare($sql);
            $stmt->execute($array_data);
            //get last inserted id
            $lastid =  $dbh->lastInsertId();
            return self::getId($table, $lastid);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //update record
    /*
    * @param string $table
    * @param array $data
    * @param int $id
    * @return bool
    */
    public static function update($table, $array_data, $id)
    {
        try {
            $sql = "UPDATE $table SET ";
            $sql .= implode(" = ?, ", array_keys($array_data));
            $sql .= " = ? WHERE id = ?";
            $stmt = self::dbh()->prepare($sql);
            $array_values = array_values($array_data);
            $array_values[] = $id;
            $stmt->execute($array_values);
            return self::getId($table, $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //delete record
    /*
    * @param string $table
    * @param int $id
    * @return bool
    */
    public static function delete($table, $id)
    {
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = self::dbh()->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
