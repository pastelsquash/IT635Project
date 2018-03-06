<?php

	session_start();

if (isset($_POST['addspace'])) {
	include_once("../include/studentDB.inc");
	
        $studentDB = new StudentAccess("Parking");

	$notes = $_POST['notes'];
	$place = $_POST['place'];
	$placetype = $_POST['placetype'];
	$zone = $_POST['zone'];
	$spacenum = $_POST['spacenum'];
	
	if ($placetype == "venue") {
		$table = "venues";
	}
	else {
		$table = "lots";
	}





	$result = $studentDB->findLot($table,$placetype,$place);
	if (empty($result)) {  
	        header("Location: ./uview.php?action=error");
                exit();
	}
	elseif ($result) {
		$lotid = $result->fetch_assoc();
		$result2 = $studentDB->findZone($table,$lotid['lot_ID'],$zone,$spacenum,$notes);
		if ($result2) {
		$row = $studentDB->addSpace($_SESSION['user_ID'],$result2['zone_ID'],$spacenum,$spacenotes);
		if (!$row) {
			header("Location: ./uview.php?action=error");
                	exit();

		}
		else {
                	header("Location: ./uview.php?action=success");
                	exit();
		}
		}

	}
	else {
		header("Location: ./uview.php?action=error");
		exit();
	}

}

?>
