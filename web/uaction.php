<?php

	session_start();

if (isset($_POST['addspace'])) {
	include_once("../include/studentDB.inc");
	
        $studentDB = new StudentAccess("Parking");

	$notes = $_POST['notes'];
	$place = $_POST['place'];
	$lot = $_POST['lot'];
	$zone = $_POST['zone'];
	$spacenum = $_POST['spacenum'];
	
	$carmake = $_POST['carmake'];
	$carmodel = $_POST['carmodel'];
	$caryear = $_POST['caryear'];
	$carcolor = $_POST['carcolor'];
	



	$row = $studentDB->addSpace($_SESSION['user_ID'],$zone,$spacenum,$notes,$carmake,$carmodel,$caryear,$carcolor);
	if (!$row) {
		header("Location: ./uview.php?action=error");
               	exit();

		}
		else {
                	header("Location: ./uview.php?action=success");
                	exit();
		}
		
}

else if(isset($_POST['delspace'])) {
	
	include_once("../include/studentDB.inc");

        $studentDB = new StudentAccess("Parking");

        $id = $_SESSION['user_ID'];
	
	$row = $studentDB->delSpace($_SESSION['user_ID']);

	if ($row) {
		 header("Location: ./uview.php?action=success");
                 exit();
	}
	else {
		header("Location: ./uview.php?action=error");
                exit();
	}


}
else {

	header("Location: ./uview.php?action=error");
	exit();
}


?>
