<?php

        include_once 'header.php';
	include_once '../include/studentDB.inc';

        if (!$_SESSION['user_role'] AND $_SESSION['user_name']) {
                header("Location: ./uview.php?login=nicetry");
                exit();
        }
	elseif (!$_SESSION['user_role'] OR !$_SESSION['user_name']) {
		header("Location: ./index.php?login=error");
                exit();
	}


?>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<section class="main-container">
        <div class="main-wrapper">
                <h2>Hello admin!</h2>
	</div>
        <br>
        <div>
                        <h2>LINK PARTNER TO LOT</h2>
                <form class="forms" action="./aaction.php" method="POST">
		
		 <label>Select a partner to associate with a lot:
<?php
                        $studentDB = new StudentAccess("Parking");

                        $result = $studentDB->listPartners();

    echo "<select name='partner' id='partner'>";

    echo "<option value=''>Select Partner</option>";

    while ($row = $result->fetch_assoc()) {

                  unset($id, $name);
                  $id = $row['partner_ID'];
                  $name = $row['partner_name'];
                  echo '<option value="'.$id.'">'.$name.'</option>';

        }

    echo "</select>";

?>
</label>


		<label>Select the venue associated with the lot:
<?php
                        $studentDB = new StudentAccess("Parking");

                        $result = $studentDB->listVenues();

    echo "<select name='rplace' id='rplace'>";

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
                        <label for="rlot">Select a lot:
                        <select name="rlot" id="rlot"><option>--------</option></select></label>

			
                        <label>Are you linking to an entire lot, or a single zone?</label>
                        
			<div style="float:left;clear:none;">	
			<label for="lot">Lot<input type="radio" name="deltype" id="lot" value="lot"></input></label>
			<label for="zone">Zone<input type="radio" name="deltype" id="zone" value="zone"></input></label>
			</div>
			
			<label for="rzone">If linking to a single zone, select it:
                        <select name="rzone" id="rzone"><option>--------</option></select></label>

			
                        <button type="addlink" name="addlink">Add Link</button>

</form>
<br>
			 <h2>ADD PARTNER</h2>
        <form class="forms" action="./aaction.php" method="POST">

			<label for="name">Name the partner:
      	        	<input type="text" name="name" id="name"></input></label>


                        <label for="address">Provide the partner's street address:
                        <input type="text" name="address" id="address"></input></label>

                        <label for="state">Provide the partner's home state (ex. AZ):
                        <input type="text" name="state" id="state" maxlength="2"></input></label>


                        <label for="zip">Provide the partner's zip code:
                        <input type="text" name="zip" id="zip" pattern="\d*" minlength="5" maxlength ="5"></input></label>

                        <label for="email">Provide the partner's email:
                        <input type="text" name="email" id="email"></input></label>

			<label for="advert">(optional) Provide a link to the partner's site/promo:
                        <input type="text" name="advert" id="advert"></input></label>

                        <button type="addpartner" name="addpartner">Register New Partner</button>
	


	</form>

<br>
                         <h2>DELETE PARTNER</h2>
        <form class="forms" action="./aaction.php" method="POST">

	
	                 <label>Select a partner to remove:
<?php
                        $studentDB = new StudentAccess("Parking");

                        $result = $studentDB->listPartners();

    echo "<select name='partner' id='partner'>";

    echo "<option value=''>Select Partner</option>";

    while ($row = $result->fetch_assoc()) {

                  unset($id, $name);
                  $id = $row['partner_ID'];
                  $name = $row['partner_name'];
                  echo '<option value="'.$id.'">'.$name.'</option>';

        }

    echo "</select>";

?>
</label>

	<button type="delpartner" name="delpartner">Delete Partner</button>

</form>
</div>

</section>

<?php
        include_once 'footer.php';
?>

