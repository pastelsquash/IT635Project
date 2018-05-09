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

	if (isset($_POST['search'])) {
	
		$table = $_POST['table'];
		$searchterm = $_POST['searchterm'];
	
	}
	else {
		$table = "partners";
		$searchterm = "";
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

<form class="forms" action="./asearch.php" method="POST">

<label> Select a search type:

<select name='table' id='table'>
<option value='partners'>Partners</option>
<option value='lots'>Lots</option>
<option value='venues'>Venues</option>
<option value='zones'>Zones</option>
<option value='spaces'>Spaces</option>
<option value='users'>Users</option>
<option value='role'>User Role</option>
</select>
</label>

<label for="searchterm">Write your search term below:
<input type="text" name="searchterm" id="searchterm"></input></label>

<button type="search" name="search">Search</button>

</form>

<?php
       $studentDB = new StudentAccess("Parking");

       $result = $studentDB->search($table,$searchterm);
	//echo "Result is ".$result.". Neat";

	echo "<table style='border:1px solid black;'>
	<tr style='border:1px solid black;'>";

if ( $table == "spaces" ) {
	
        echo "<th>OID</th><th>user_id</th><th>zone_id</th><th>space_number</th><th>space_notes</th><th>car_make</th><th>car_model</th><th>car_year</th><th>car_color</th>";
        echo "</tr>";

echo "<tr>";

foreach($result as $value) {
echo "<td>" . $value . "</td>";

}
echo "</tr>";

echo "</table>";
}

else {
	$columns = array();

	while ($row = $result->fetch_field()) 
{
	$columns[] = $row->name;
}

foreach ($columns as $cname) {

	echo "<th>" . $cname. "</th>";

}
	echo "</tr>";


	while($srow = $result->fetch_row())
{
echo "<tr>";

foreach($srow as $value) {
echo "<td>" . $value . "</td>";

}
echo "</tr>";
}
echo "</table>";
}
?>


</div>

</section>

<?php
        include_once 'footer.php';
?>

