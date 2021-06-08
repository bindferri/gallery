<?php
//require_once "includes/config.php";
class Database{
    private $connection;
    private $stmt;
    private $escape_string;

    public function __construct(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    }

    public function query($query){
       $this->stmt = $this->connection->query($query);
       return $this->stmt;
    }

    public function fetchSingle(){
        return mysqli_fetch_object($this->stmt);
    }

    public function fetchAll(){
        $array = array();
        while ($row = mysqli_fetch_object($this->stmt)){
            $array[] = $row;
        }
        return $array;
    }

    public function escape_string($string){
       $this->escape_string = $this->connection->real_escape_string($string);
       return $this->escape_string;
    }
}