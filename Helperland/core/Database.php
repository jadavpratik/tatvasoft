<?php

namespace core;

use \PDO;
use \Exception;

use core\Response;

class Database{

    private $dbType = DB_TYPE;
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPassword = DB_PASSWORD;
    private $conn = null;
    
    protected $table = '';
    private $query = '';
    private $columns = ' * ';
    private $where = '';
    private $joinString = '';
    private $res = null;

    // -----------------CONNECT-------------------
    public function connect(){
        try {
            $dbString = "{$this->dbType}:host=$this->dbHost;dbname=$this->dbName";
            $this->conn = new PDO($dbString, $this->dbUser, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        } 
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>'Database connection issue!']);
            exit();
        }
    }

    public function __construct(){
        $this->res = new Response();
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
            // FOR AVOID XSS...
            $value = htmlspecialchars($value);
            $keys .= $key.', ';
            if(is_integer($value))
                $values .= "{$value} ,";
            else if(is_string($value))
                $values .= "'{$value}' ,";
            else
                $values .= "null, ";
        }
        $keys = rtrim($keys, ', ');
        $values = rtrim($values, ', ');
        $keys .= ')';
        $values .= ')';
        try{
            $this->query = "INSERT INTO {$this->table} {$keys} VALUES {$values}";
            if($this->conn->exec($this->query)){
                return $this->conn->lastInsertId();
            }
            else{
                return false;
            }
        }
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }

    // -----------------WHERE-------------------
    public function where($key, $operator=false, $value=false){
        if($operator!=false && $value!=false){
            // IF WE PASS ALL THREE PARAMETERS...
            if(is_integer($value)){
                $this->where = 'WHERE '.$key.' '.$operator.' '.$value;
            }
            else if(is_string($value)){
                $value = "'{$value}'";
                $this->where = 'WHERE '.$key.' '.$operator.' '.$value;
            }
        }
        else{
            // IF WE PASS STRING...
            $this->where = 'WHERE '.$key;
        }
        return $this;
    }

    // -----------------EXISTS-------------------
    public function exists(){
        $this->query = "SELECT * FROM {$this->table} {$this->where}";
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
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }

    // -----------------COLUMN-------------------
    public function columns($columns){
        if(isset($columns) && !empty($columns)){
            // FIRST BLANK THE ALL COLUMNS...
            $this->columns = '';
            foreach($columns as $column){
                $this->columns .= $column.', ';
            }
            $this->columns = rtrim($this->columns, ', ');
        }
        return $this;
    }

    // -----------------CUSTOM_QUERY-------------------
    public function query($sql){
        try{
            $result = $this->conn->query($sql);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($data));
            // RETURN ARRAY OF AN OBJECT...
        }
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }
    
    // -----------------JOIN-------------------
    public function join($pk, $fk, $joinTable){
        $this->joinString = "INNER JOIN {$joinTable} ON {$this->table}.{$pk}={$joinTable}.{$fk}";
        return $this;
    }

    // -----------------READ-------------------
    public function read(){
        try{
            $this->query = "SELECT {$this->columns} FROM {$this->table} {$this->joinString} {$this->where}";
            $result = $this->conn->query($this->query);            
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($data));
            // RETURN ARRAY OF AN OBJECT...
        }
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }


    // -----------------UPDATE-------------------
    public function update($arr){
        // SET THE KEYS AND VALUES INTO A STRING...
        $updateString = '';
        foreach($arr as $key => $value){
            if(is_integer($value)){
                $updateString .= $key." = {$value}, ";
            }
            else if(is_string($value)){
                $updateString .= $key." = '{$value}', ";
            }
        }
        $updateString = rtrim($updateString, ', ');
        try{
            $this->query = "UPDATE {$this->table} SET {$updateString} {$this->where}";
            return $this->conn->exec($this->query);
        }
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }

    // -----------------DELETE-------------------
    public function delete(){
        try{
            $this->query = "DELETE FROM {$this->table} {$this->where}";
            return $this->conn->exec($this->query);    
        }
        catch(Exception $e){
            $this->res->status(500)->json(['message'=>$e->getMessage()]);
            exit();
        }
    }

    public function __destruct(){
        $this->conn = null;
        // echo "Database Disconnected";
    }

}