<?php
require_once "includes/init.php";
require_once "includes/header.php";
if (!$session->checkSignIn()){
    redirect("login.php");
}
if (isset($_GET['id'])){
    $id = $_GET['id'];
}
$comment = new Comment();
$comment->deleteById($id);
redirect("comments.php");
