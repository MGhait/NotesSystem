<?php

if (isset($_POST['submit'])){

    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    $connection = require_once '../Connection.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username,$pwd) !== false) {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }
     $connection->loginUser($username, $pwd);
} else {
    header("Location: ../login.php");
    exit();
}