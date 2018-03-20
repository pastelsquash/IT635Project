<?php

        session_start();

if (isset($_POST['addlot'])) {

	if ($_SESSION['user_role'] == "admin" ) {

	        include_once("../include/studentDB.inc");
	
	        $studentDB = new StudentAccess("Parking");
	
	        $place = $_POST['place'];
	        $lot = $_POST['alot'];
	        $size = $_POST['size'];
	        $address = $_POST['address'];
	        $state = $_POST['state'];
	        $zip = $_POST['zip'];
	        $description = $_POST['description'];


	        $row = $studentDB->addLot($place,$lot,$size,$address,$state,$zip,$description);
	        if (!$row) {
	                header("Location: ./aparking.php?action=error");
	                exit();
	
	                }
	                else {
	                        header("Location: ./aparking.php?action=success");
	                        exit();
	                }
	
		}
		else { 
	                header("Location: ./aparking.php?action=error");
	                exit();

		}

}
else if (isset($_POST['addzone'])) {

        if ($_SESSION['user_role'] == "admin" ) {

                include_once("../include/studentDB.inc");

                $studentDB = new StudentAccess("Parking");

                $zlot = $_POST['zlot'];
                $zname = $_POST['zname'];

                $row = $studentDB->addZone($zlot,$zname);
                if (!$row) {
                        header("Location: ./aparking.php?action=error");
                        exit();

                        }
                        else {
                                header("Location: ./aparking.php?action=success");
                                exit();
                        }

                }
                else {
                        header("Location: ./aparking.php?action=error");
                        exit();

                }

}
else if (isset($_POST['delparking'])) {

        if ($_SESSION['user_role'] == "admin" ) {

                include_once("../include/studentDB.inc");

                $studentDB = new StudentAccess("Parking");

                $rlot = $_POST['rlot'];
                $deltype = $_POST['deltype'];
		$rzone = $_POST['rzone'];

                $row = $studentDB->delParking($rlot,$rzone,$deltype);
                if (!$row) {
                        header("Location: ./aparking.php?action=error");
                        exit();

                        }
                        else {
                                header("Location: ./aparking.php?action=success");
                                exit();
                        }

                }
        else {
                   header("Location: ./aparking.php?action=error");
                   exit();

                }

}

