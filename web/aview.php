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
        <br>
        	<div>
		
		<form class="forms">
		<label> Select your administrative view from the nav bar.</label>		


		</form>

        	</div>
	</div>

</section>

<?php
        include_once 'footer.php';
?>

