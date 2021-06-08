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
$commentId = $comment->findById($id);
$comment->deleteById($id);
redirect("specific_photo.php?id=".$commentId->photo_id);
