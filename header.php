<?php
    session_start();
    $connection = require_once 'Connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login System</title>
</head>
<body>
<nav>
    <div class="wrapper">
        <ul>
            <?php
                if (isset($_SESSION['useruid'])) {
                    echo '<li><a href="index.php">My Notes</a></li>';
                    echo '<li><a href="note.php">Add Note</a></li>';
                    echo '<li><a href="includes/logout.inc.php">Logout</a></li>';
                } else {
                    echo '<li><a href="descover.php">About Us</a></li>';
                    echo '<li><a href="signup.php">Sign up</a></li>';
                    echo '<li><a href="login.php">Login</a></li>';
                }
            ?>
        </ul>
    </div>
</nav>
<div class="wrapper" >
