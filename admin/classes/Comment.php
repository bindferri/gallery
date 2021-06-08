<?php
require_once "Database.php";


class Comment extends Parent_methods{

    protected static $db;
    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id','username','body');
    public $id;
    public $photo_id;
    public $username;
    public $body;

    public function __construct(){
        self::$db = new Database();
    }

    public function findCommentsById($id){
        self::$db->query("SELECT * FROM comments WHERE photo_id = $id");
        return self::$db->fetchAll();
    }

    public function createComment($param1,$param2=null,$param3=null){
        $params = [
            static::$db_table_fields[0] => $param1,
            static::$db_table_fields[1] => $param2,
            static::$db_table_fields[2] => $param3
        ];
        $value_params = array();
        $key_params = array();
        foreach ($params as $key => $value){
            if ($value != null || !empty($value)){
                $value_params[] = $value;
            }
            if (isset($value)){
                $key_params[] = "$key";
            }
        }
        static::$db->query("INSERT INTO ".static::$db_table." (".implode(', ',$key_params).") VALUES ('".implode("',' ",$value_params)."')");
    }

    public function countCommentsById($id){
        $count = self::$db->query("SELECT * FROM comments WHERE photo_id = $id");
        return mysqli_num_rows($count);
    }

}