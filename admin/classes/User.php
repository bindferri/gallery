<?php
require_once "Database.php";
class User{

    private $db;
    private $user_image;
    private $images_path = "user_images";
    private $placeholder = "https://via.placeholder.com/100";

    public function __construct(){
        $this->db = new Database();
    }

    public function user_image($user_image){
        return empty($user_image) ? $this->placeholder : $this->images_path."/".$user_image;
    }

    public function findAllUsers(){
        $this->db->query("SELECT * FROM users");
        return $this->db->fetchAll();
    }

    public function countUsers(){
        $users = $this->db->query("SELECT * FROM users");
        return mysqli_num_rows($users);
    }

    public function findUserById($id){
        $this->db->query("SELECT * FROM users WHERE id = $id");
        return $this->db->fetchSingle();
    }

    public function verify_username($username){
        $username_verify_result = $this->db->query("SELECT * FROM users WHERE username = '$username'");

        if (mysqli_num_rows($username_verify_result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function verify_login($username,$password){
        if ($this->verify_username($username)) {
            $verify_login_result = $this->db->query("SELECT * FROM users WHERE username = '$username'");
            while ($row = mysqli_fetch_assoc($verify_login_result)){
                $db_password = $row['password'];
                $db_id = $row['id'];
            }
            if ($password == $db_password){
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $db_id;
                return true;
            }else{
                return false;
            }
        }
    }

    public function createUser($username,$password,$firstname,$lastname,$image){
        $create_user = $this->db->query("INSERT INTO users (username,password,user_firstname,user_lastname,user_image) VALUES ('$username','$password','$firstname','$lastname','$image')");
    }

    public function updateUser($id,$param1,$param2){
        $this->db->query("UPDATE users SET $param1 = '$param2' WHERE id = '$id'");
    }

    public function deleteUserById($id){
        $this->db->query("DELETE FROM users WHERE id = $id");
    }

    public function updateUserCostum($id,$username=null,$password=null,$firstname=null,$lastname=null,$image=null){
        $properties = [
            'username' => $username,
            'password' => $password,
            'user_firstname' => $firstname,
            'user_lastname' => $lastname,
            'user_image' => $image
        ];

        $updated_properties = array();

        foreach ($properties as $key => $value){
            if ($value != null || !empty($value)){
                $updated_properties[] = "$key = '$value'";
            }
        }
        $this->db->query("UPDATE users SET ". implode(', ',$updated_properties). " WHERE id = $id");
    }

    public function ajax_update_image($user_image,$user_id){
        $this->updateUserCostum($user_id,null,null,null,null,$user_image);
    }
}

