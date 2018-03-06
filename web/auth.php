<?php

	session_start();

if (isset($_POST['login'])) {
	include_once("../include/studentDB.inc");
	
        $studentDB = new StudentAccess("Parking");
        $row = $studentDB->validateUser($_POST['uid'],$_POST['pid']);

	if (!empty($row)) {
		$_SESSION['user_name'] = $row['user_name'];
                $_SESSION['user_role'] = $row['user_role'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_ID'] = $row['user_ID'];
		if (!$row['user_role']) {
			header("Location: ./uview.php");
			exit();
		}
		else {
			header("Location: ./aview.php");
			exit();
		}
	
	}

	else {
		header("Location: ./index.php?login=error");
		exit();
	}
}

?>
