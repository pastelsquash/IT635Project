<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
        <nav>
        <div class="main-wrapper">
                <ul>
                        <li><a href="index.php">Home</a></li>
                </ul>
                <div class="nav-login">
                        <form action="./auth.php" method="POST">
                                <input type="text" name="uid" placeholder="Username">
                                <input type="password" name="pid" placeholder="Password">
                                <button type="login" name="login">Sign In</button>

                        </form>

                </div>
        </div>
        </nav>
</header>

