<?php

namespace core;

use \PDO;
use \Exception;

class Database{

    private $dbType = DB_TYPE;
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPassword = DB_PASSWORD;
    private $conn = null;
    
    private $query = '';
    private $columns = '';
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
            echo "Connection Failed ! <br><br>".$e->getMessage();
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
            if(gettype($value)=='integer')
                $values .= "{$value} ,";
            else if($value!=null)
                $values .= "'{$value}' ,";
            else
                $values .= 'null';
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
    public function where($key, $operator=false, $value=false){
        if($operator!=false && $value!=false){
            // IF WE PASS ALL THREE PARAMETERS...
            $this->where = $key.' '.$operator.' '.$value;
        }
        else if(gettype($key)=='array'){
            // IF WE PASS ARRAY...
            for($i = 0; $i<count($key); $i++){
                $this->where .= $key[$i];
            }
        }
        else{
            // IF WE PASS STRING...
            $this->where = $key;
        }
        return $this;
    }

    // -----------------EXISTS-------------------
    public function exists(){
        $this->query = "SELECT * FROM $this->table WHERE $this->where";
        try{
            $result = $this->conn->query($this->query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            if(count($data) >= 1){
                return true;
            }
            else{
                return false;
            }    
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    // -----------------COLUMN-------------------
    public function column($columns){
        if(isset($columns) && !empty($columns)){
            foreach($columns as $column){
                $this->columns .= $column.', ';
            }
            $this->columns = rtrim($this->columns, ', ');
        }
        return $this;
    }

    // -----------------READ-------------------
    public function read(){
        try{
            if($this->columns!=="" && $this->where!==""){
                // WITH SELECTED COLUMNS & WITH WHERE CONDITION...
                $this->query = "SELECT $this->columns FROM $this->table WHERE $this->where";
            }                
            else if($this->columns!=="" && $this->where==""){
                // WITH SELECTED COLUMNS & WITHOUT WHERE CONDITION...
                $this->query = "SELECT $this->columns FROM $this->table";
            }
            else if($this->columns=="" && $this->where!==""){
                // WITH ALL COLUMNS & WITH WHERE CONDITION...
                $this->query = "SELECT * FROM $this->table WHERE $this->where";
            }
            else{
                // WITH ALL COLUMNS & WITHOUT WHERE CONDITION...
                $this->query = "SELECT * FROM $this->table";
            }
            $result = $this->conn->query($this->query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($data));
            // RETURN ARRAY OF AN OBJECT...
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
            if(gettype($value)=='integer'){
                $updateString .= $key." = {$value}, ";
            }
            else if(gettype($value)=='string'){
                $updateString .= $key." = '{$value}', ";
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