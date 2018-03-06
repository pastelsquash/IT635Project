<?php

        include_once 'header.php';

	
	if (!$_SESSION['user_name']) {
		header("Location: ./index.php?login=error");
		exit();
	}


//register spot: addSpace($userid,$zoneid,$spacenum,$spacenotes)
//lookup spot: getParkingSpace($user,$zone)
//Leave spot: delSpace($userid,$zoneid)


?>

<section class="main-container">
        <div class="main-wrapper">
                <h2>Hello user!</h2>
        </div>
	<br>
	<div>
		<h2>REGISTER PARKING SPOT</h2>
		<form class="forms" action="./uaction.php" method="POST">
			<label for="place"> Where did you park?</label><input type"text" name="place">
			<label for="placetype">Is that a venue or a lot?</label>
				<label for="venue">Venue<input type="radio" name="placetype" value="venue"></label>
				<label for="lot">Lot<input type="radio" name="placetype" value="lot"></label>
			 <label for="zone"> If you parked in a multi-level lot, which floor/zone?</label><input type"text" name="zone">
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

