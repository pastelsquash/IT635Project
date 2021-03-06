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
			<select name="lot" id="lot"><option>--------</option></select></label>

			<label for="zone">Select the zone/floor within that lot:
                        <select name="zone" id="zone"><option>--------</option></select></label>


			 <label for="notes">Type anything here that will help you remember your spot.</label>
				<input type="text" name="notes" placeholder="By the elevator, etc...">
			
			 <label for="spacenum">Number for space (can be blank):</label><input type="text" name="spacenum" id="spacenum">
			<button type="addspace" name="addspace">Register Parking Spot</button>
		</form>
	</div>
	<br>
	<div>
		<h2>PARKING SPOT LOOKUP</h2>
	<br>
	<form class="forms" action="./uaction.php" method="POST">
	<?php
		$studentDB = new StudentAccess("Parking");

		$parked = $studentDB->getParkingSpace($_SESSION['user_ID']);

		if ($parked->num_rows == 0) {
			echo "<p>You haven't registered a parking spot yet.</p><br>";
		}
		else {
			while ($parkingspot = $parked->fetch_assoc()) {
				unset($pzone_id,$parkResp,$pvenue_name, $plot_name,$pzone_description,$notes,$number);
				$pzone_id = $parkingspot['zone_ID'];
                		$parkResp = $studentDB->getVenueLot($pzone_id);
				$pvenue_name = $parkResp['venue_name'];
				$plot_name = $parkResp['lot_name'];
				$pzone_description = $parkResp['zone_description'];
				$number = $parkingspot['space_number'];
				$notes = $parkingspot['space_notes'];
        	          	
				if ($plot_name == $pzone_description) {
                                echo '<p>You parked at the venue '.$pvenue_name.' in '.$plot_name;
				} else {
	                  	echo '<p>You parked at the venue '.$pvenue_name.' in '.$plot_name.', '.$pzone_description;
				}
				if ($number) {
				echo ", space number ".$number;
				}
				if ($notes) {
				echo ". You left yourself the following note: <b>".$notes.".</b></p><br>";
				}
				else { echo ".</p><br>"; }
			}
		}


	?>
		<button type="delspace" name="delspace">Unregister</button>

	</form>
	</div>

</section>

<?php
        include_once 'footer.php';
?>

