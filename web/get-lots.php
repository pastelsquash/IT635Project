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

} elseif (isset($_POST['l_id'])) {
  
   $studentDB = new StudentAccess("Parking");

  $lid = $_POST['l_id'];



  $result = $studentDB->listZones($lid);
  echo "<option value=''>------- Zones --------</option>";
  while($row = $result->fetch_assoc()) {
          unset($id, $name);
          $zid = $row['zone_ID'];
          $zname = $row['zone_description'];
          echo '<option value="'.$zid.'">'.$zname.'</option>';


	}
}
  else { header('location: ./');
}
?>
