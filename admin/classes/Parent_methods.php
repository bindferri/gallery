<?php

class Parent_methods{

    public function findAll(){
        static::$db->query("SELECT * FROM ".static::$db_table);
        return static::$db->fetchAll();
    }

    public function findById($id){
        static::$db->query("SELECT * FROM ".static::$db_table." WHERE id = $id");
        return static::$db->fetchSingle();
    }

    public function create($param1,$param2=null,$param3=null,$param4=null,$param5=null,$param6=null,$param7=null,$param8=null){
        $params = [
            static::$db_table_fields[0] => $param1,
            static::$db_table_fields[1] => $param2,
            static::$db_table_fields[2] => $param3,
            static::$db_table_fields[3] => $param4,
            static::$db_table_fields[4] => $param5,
            static::$db_table_fields[5] => $param6,
            static::$db_table_fields[6] => $param7,
            static::$db_table_fields[7] => $param8
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

//    public function createCustom($params = []){
//        $create_params = array_change_key_case(static::$db_table_fields,$params);
//        $create = array();
//        foreach ($create_params as $key => $value){
//            if (!empty($value)){
//                $create[] = $create_params;
//            }
//        }
//        return $create;
//    }

    public function updateSingle($id,$param1,$param2){
        static::$db->query("UPDATE ".static::$db_table." SET $param1 = '$param2' WHERE id = '$id'");
    }

    public function deleteById($id){
        static::$db->query("DELETE FROM ".static::$db_table." WHERE id = $id");
    }

    public function update($id,$param1,$param2=null,$param3=null,$param4=null,$param5=null){
        $params = [
            static::$db_table_fields[0] => $param1,
            static::$db_table_fields[1] => $param2,
            static::$db_table_fields[2] => $param3,
            static::$db_table_fields[3] => $param4,
            static::$db_table_fields[4] => $param5,
        ];
        $value_params = array();
        $key_params = array();
        foreach ($params as $key => $value){
            if ($value != null || !empty($value)){
                $value_params[] = $value;
            }
            if (isset($value)){
                $key_params[] = "$key = '$value'";
            }
        }
        return static::$db->query("UPDATE ".static::$db_table." SET ".implode(', ',$key_params)." WHERE id = $id");
    }

    public function countData(){
        $data = static::$db->query("SELECT * FROM ".static::$db_table);
        return mysqli_num_rows($data);
    }
}
