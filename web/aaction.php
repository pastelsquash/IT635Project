<?php

        session_start();

if (isset($_POST['addlot'])) {

	if ($_SESSION['user_role'] == "admin" ) {

	        include_once("../include/studentDB.inc");
	
	        $studentDB = new StudentAccess("Parking");
	
	        $place = $_POST['place'];
	        $lot = $_POST['lot'];
	        $size = $_POST['size'];
	        $address = $_POST['address'];
	        $state = $_POST['state'];
	        $zip = $_POST['zip'];
	        $description = $_POST['description'];


	        $row = $studentDB->addLot($place,$lot,$size,$address,$state,$zip,$description);
	        if (!$row) {
	                header("Location: ./aview.php?action=error");
	                exit();
	
	                }
	                else {
	                        header("Location: ./aview.php?action=success");
	                        exit();
	                }
	
		}
		else { 
	                header("Location: ./aview.php?action=error");
	                exit();

		}

}
