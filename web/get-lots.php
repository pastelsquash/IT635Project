<?php

//start_session();
include_once("../include/studentDB.inc");


if(isset($_POST['v_id'])) {

  $studentDB = new StudentAccess("Parking");

  $vid = $_POST['v_id']; 

	

  $result = $studentDB->listLots($vid); 
  echo "<option value=''>------- Lots --------</option>";
  while($row = $result->fetch_assoc()) {
          unset($id, $name); 
          $lid = $row['lot_ID'];
          $lname = $row['lot_name'];
          echo '<option value="'.$lid.'">'.$lname.'</option>';


	}

} else {
  header('location: ./');
}
?>
