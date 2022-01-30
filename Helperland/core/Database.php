<?php

namespace core;

use \PDO;

class Database{

    private $dbType = DB_TYPE;
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPassword = DB_PASSWORD;
    private $conn = null;
    
    private $query = '';
    protected $table = '';
    private $where = '';


    // -----------------CONNECT-------------------
    public function connect(){
        try {
            $dbString = "$this->dbType:host=$this->dbHost;dbname=$this->dbName";
            $this->conn = new PDO($dbString, $this->dbUser, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch(PDOException $e){
            echo "Connection Failed: " . $e->getMessage();
        }
    }

    public function __construct(){
        $this->connect();
    }

    // -----------------TABLE-------------------
    public function table($name){
        $this->table = $name;
        return $this;
    }

    // -----------------CREATE-------------------
    public function create($arr){
        // SET THE KEYS AND VALUES INTO A STRING...
        $keys = '(';
        $values = '(';
        foreach($arr as $key => $value){
            $keys .= $key.', ';
            $values .= "'".$value."', ";
        }
        $keys = rtrim($keys, ', ');
        $values = rtrim($values, ', ');
        $keys .= ')';
        $values .= ')';
        try{
            $this->query = "INSERT INTO $this->table $keys VALUES $values";
            return $this->conn->exec($this->query);    
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------READ-------------------
    public function read(){
        try{
            $this->query = "SELECT * FROM $this->table";
            $result = $this->conn->query($this->query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return (object) json_decode(json_encode($data));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------UPDATE-------------------
    public function update($arr){
        // SET THE KEYS AND VALUES INTO A STRING...
        $updateString = '';
        foreach($arr as $key => $value){
            echo "<pre>";
            if(gettype($value)=='integer'){
                $updateString .= $key." = ".$value.", ";
            }
            else if(gettype($value)=='string'){
                $updateString .= $key." = '".$value."', ";
            }
        }
        $updateString = rtrim($updateString, ', ');
        try{
            $this->query = "UPDATE $this->table SET $updateString WHERE $this->whereCond";
            // echo $this->query;
            // echo $this->query;
            return $this->conn->exec($this->query);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------DELETE-------------------
    public function delete(){
        try{
            $this->query = "DELETE FROM $this->table WHERE $this->whereCond";
            return $this->conn->exec($this->query);    
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------WHERE-------------------
    public function where($key, $operator, $value){
        $this->whereCond = $key.$operator.$value;
        return $this;
    }

    // -----------------JOIN-------------------
    public function join(){

    }
    
    public function __destruct(){
        $this->conn = null;
        // echo "Database Disconnected";
    }

}