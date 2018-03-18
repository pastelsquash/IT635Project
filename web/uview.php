<?php

        include_once 'header.php';
	include_once("../include/studentDB.inc");
	
	if (!$_SESSION['user_name']) {
		header("Location: ./index.php?login=error");
		exit();
	}


//register spot: addSpace($userid,$zoneid,$spacenum,$spacenotes)
//lookup spot: getParkingSpace($user,$zone)
//Leave spot: delSpace($userid,$zoneid)




?>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<section class="main-container">
        <div class="main-wrapper">
                <h2>Hello user!</h2>
        </div>
	<br>
	<div>
		<h2>REGISTER PARKING SPOT</h2>
		<form class="forms" action="./uaction.php" method="POST">
		<label>Select the venue you parked at:
<?php
			$studentDB = new StudentAccess("Parking");

			$result = $studentDB->listVenues();

    echo "<select name='place' id='place'>";

    echo "<option value=''>Select Venue</option>";

    while ($row = $result->fetch_assoc()) {

                  unset($id, $name);
                  $id = $row['venue_ID'];
                  $name = $row['venue_name'];
                  echo '<option value="'.$id.'">'.$name.'</option>';

	}

    echo "</select>";

?>
</label>
			<label for="lot">Select the lot within that venue:
			<select name="lot" id="lot"><option>Select Lot</option></select></label>

			 <label for="notes">Type anything here that will help you remember your spot.</label>
				<input type="text" name="notes" placeholder="By the elevator, etc...">
			
			 <label for="spacenum">Number for space (can be blank):</label><input type="text" name="spacenum">
			<button type="addspace" name="addspace">Register my spot!</button>
		</form>
	</div>
</section>

<?php
        include_once 'footer.php';
?>

