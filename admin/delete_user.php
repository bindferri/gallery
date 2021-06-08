<?php
require_once "includes/header.php";
require_once "includes/init.php";
if (!empty($_GET['id'])){
    $id = $_GET['id'];
    $user = new User();
    $user->deleteUserById($id);
    flash("user_deleted", "User deleted successfully","alert alert-danger");
    redirect("users.php");

}else{
    redirect("users.php");
}
