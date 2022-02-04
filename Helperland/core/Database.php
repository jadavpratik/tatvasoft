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

    // -----------------WHERE-------------------
    public function where($where){
        $this->where = $where;
        return $this;
    }


    // -----------------READ-------------------
    public function read(){
        try{
            if($this->where!==""){
                $this->query = "SELECT * FROM $this->table WHERE $this->where";
            }
            else{
                $this->query = "SELECT * FROM $this->table";
            }
            $result = $this->conn->query($this->query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($data));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------EXISTS-------------------
    public function exists(){
        $this->query = "SELECT * FROM $this->table WHERE $this->where";
        $result = $this->conn->query($this->query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if(count($data) >= 1){
            return true;
        }
        else{
            return false;
        }
    }


    // -----------------UPDATE-------------------
    public function update($arr){
        // SET THE KEYS AND VALUES INTO A STRING...
        $updateString = '';
        foreach($arr as $key => $value){
            if(gettype($value)=='integer'){
                $updateString .= $key." = ".$value.", ";
            }
            else if(gettype($value)=='string'){
                $updateString .= $key." = '".$value."', ";
            }
        }
        $updateString = rtrim($updateString, ', ');
        try{
            $this->query = "UPDATE $this->table SET $updateString WHERE $this->where";
            return $this->conn->exec($this->query);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------DELETE-------------------
    public function delete(){
        try{
            $this->query = "DELETE FROM $this->table WHERE $this->where";
            return $this->conn->exec($this->query);    
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------JOIN-------------------
    public function join(){

    }
    
    public function __destruct(){
        $this->conn = null;
        // echo "Database Disconnected";
    }

}