<?php
require_once "Database.php";

class   Session{

    protected static $db;
    public $user_id;
    private $signed_in = false;
    public $views_count;

    public function __construct(){
        $this->db = new Database();
        session_start();
        $this->countViews();
        $this->checkLogIn();
    }

    public function checkSignIn(){
        return $this->signed_in;
    }

    public function login($user){
        if ($user){
            $this->user_id = $_SESSION['id'];
            $this->signed_in = true;
        }
    }

    public function logout(){
        unset($_SESSION['id']);
        unset($this->user_id);
        session_destroy();
        $this->signed_in = false;
    }

    public function checkLogIn(){
        if (isset($_SESSION['id'])){
            $this->user_id = $_SESSION['id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function countViews(){
        if (isset($_SESSION['count'])){
            return $this->views_count = $_SESSION['count']++;
        }else{
            return $_SESSION['count'] = 0;
        }
    }
}

