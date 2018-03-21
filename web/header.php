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
<?php

	if ($_SESSION['user_ID']) {
		echo '<li><a href="signout.php">Sign Out</a></li>';
	}

	if ($_SESSION['user_role'] == "admin" ) {


                echo '<li><a href="aparking.php">Parking Admin</a></li>';
                echo '<li><a href="apartners.php">Partners Admin</a></li>';
		echo '<li><a href="asearch.php">Database Search</a></li>';


	}


?>
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

