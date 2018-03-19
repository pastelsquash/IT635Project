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

//Add parking location: addLot($venueid,$lotname,$lotsize,$lotaddr,$lotstate,$lotzip,$lotdescript)
//			addZone($lotid,$zonedesc)
//remove parking location: stored procedure delete_lot(lotid)

//Search partners: getPartners($search)
//Add partner: addPartner ($pname,$paddr,$pstate,$pzip,$pemail)
//Delete partner: stored procedure delete_partner(pid)

//Link partner to spot/spot range: addLink($partnerid,$spotid,$islot)

?>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<section class="main-container">
        <div class="main-wrapper">
                <h2>Hello admin!</h2>
	</div>
        <br>
        <div>
                <h2>ADD PARKING LOT</h2>
                <form class="forms" action="./aaction.php" method="POST">
                <label>Select the venue to associate the lot with:
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
                        <label for="lot">Name the lot:
                        <input type="text" name="lot" id="lot"></input></label>
						
						<label for="size">What is the capacity of the lot?
                        <input type="number" name="size" id="size" min="1" max="99999999"></input></label>
                        
						<label for="address">Provide the lot's street address:
                        <input type="text" name="address" id="address"></input></label>
					
						<label for="state">Provide the state the lot is located in (ex. AZ):
                        <input type="text" name="state" id="state" maxlength="2"></input></label>

						
                        <label for="zip">Provide the lot's zip code:
                        <input type="text" name="zip" id="zip" pattern="\d*" minlength="5" maxlength ="5"></input></label>
                        
						<label for="description">(Optional) Describe the lot if there's any ambiguity:
                        <input type="text" name="description" id="description"></input></label>
						
						<button type="addlot" name="addlot">Register Parking Lot</button>
                </form>
        </div>

</section>

<?php
        include_once 'footer.php';
?>

