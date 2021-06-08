<?php require_once "autoload.php";
require_once "config.php";
$user = new User();
if (isset($_POST['image_name'])){
    $user->ajax_update_image($_POST['image_name'],$_POST['user_id']);
}
