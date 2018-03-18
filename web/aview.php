<?php

        include_once 'header.php';


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

<section class="main-container">
        <div class="main-wrapper">
                <h2>Hello admin!</h2>
        </div>

</section>

<?php
        include_once 'footer.php';
?>

