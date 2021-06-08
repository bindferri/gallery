<?php
require_once "includes/header.php";
$session = new Session();
$session->logout();
redirect("login.php");
