<?php

class StudentAccess
{
private $db;

public function __construct($database)
{
        $this->db = new mysqli("localhost","root","pastelsquash",$database);
        if ($this->db->connect_errno != 0)
        {
                echo "error connecting to databse: ".$this->db->connect_error.PHP_EOL;
                exit();
        }
}

public function __destruct()
{
        if (isset($this->db))
        {
                $this->db->close();
        }
}

/*public function getParkingSpace($user)
{
		$id = $this->db->real_escape_string($user);
		//$zn = $this->db->real_escape_string($zone);
        $query = "select * from spaces where user_ID = $id;";

        $queryResponse = $this->db->query($query);
	//print_r($response);
        return $queryResponse;
}*/
public function getParkingSpace($user)
{
        require_once '/var/www/include/vendor/autoload.php';
        $coll = (new MongoDB\Client("mongodb://pastelsquash:pastelsquash@ds259109.mlab.com:59109/pastelsquash_it635"))->pastelsquash_it635->spaces;



        $res = $coll->findOne(array("user_id" => $user));

        return $res;
}

public function getVenueLot($zone)
{
                $zid = $this->db->real_escape_string($zone);

	$zquery = "select * from zones where zone_ID = $zid;";

        $zResponse = $this->db->query($zquery);
        //print_r($response);
        $zrow = $zResponse->fetch_assoc();
	$lid = $zrow['lot_ID'];


        $query = "select * from lots where lot_ID = $lid;";

        $queryResponse = $this->db->query($query);
        //print_r($response);
	$row = $queryResponse->fetch_assoc();
	$vid = $row['venue_ID'];
	
	$vquery = "select * from venues where venue_ID = $vid;";
	$vResponse = $this->db->query($vquery);
	$vrow = $vResponse->fetch_assoc();
	
	
	$parkedLot = $row['lot_name'];
	$parkedVenue = $vrow['venue_name'];
	$fullspot = array();
	$fullspot['lot_name'] = $row['lot_name'];
	$fullspot['venue_name'] = $vrow['venue_name'];
	$fullspot['zone_description'] = $zrow['zone_description'];
        return $fullspot;
}


public function getPartners($search)
{
		$sr = $this->db->real_escape_string($search);
		
		//if search is empty, display all
		if (empty($search))
		{
			$query = "select * from partners;";
		}
		//if search is number, match by id
		if (is_numeric($search))
		{
			$query = "select * from partners where partner_ID = $sr;";
		} else {
			$query = "select * from partners where partner_name LIKE '%$sr%';";
		}
		//^^else search is name, match by name

        $queryResponse = $this->db->query($query);
        $response = array();
        while($row = $queryResponse->fetch_assoc())
        {
                $response[] = $row;
        }
	print_r($response);
        return $response;
}

/*public function addSpace($userid,$zoneid,$spacenum,$spacenotes)
{
        $uid = $this->db->real_escape_string($userid);
		$zid = $this->db->real_escape_string($zoneid);
		$spc = $this->db->real_escape_string($spacenum);
		$spn = $this->db->real_escape_string($spacenotes);
        $query = "insert into spaces(user_id,zone_id, space_number, space_notes)
		VALUES ($uid,$zid,'$spc','$spn');";

        echo "executing SQL statement:\n".$query."\n";
        if (!$this->db->query($query))
        {
                echo "Failed to insert zone record under lot $lotid".PHP_EOL;
		return 0;
        }
	else { return 1; }
}
*/
public function addSpace($userid,$zoneid,$spacenum,$spacenotes,$carmake,$carmodel,$caryear,$carcolor) {
	//$mconn = new MongoClient('mongodb://pastelsquash:pastelsquash@ds259109.mlab.com:59109/pastelsquash_it635');
	//$db = $mconn->selectDB("it635");
	//$coll = $db->spaces;
	
	require_once '/var/www/include/vendor/autoload.php';
	$coll = (new MongoDB\Client("mongodb://pastelsquash:pastelsquash@ds259109.mlab.com:59109/pastelsquash_it635"))->pastelsquash_it635->spaces;
	
	if ($coll->findOne(array("user_id" => $userid))) {
		return 0;
	}
	
	$res = $coll->insertOne(array("user_id" => $userid, "zone_id" => $zoneid, "space_number" => "$spacenum", "space_notes" => "$spacenotes", "car_make" => "$carmake", "car_model" => "$carmodel", "car_year" => "$caryear", "car_color" => "$carcolor"));

	return $res;
	


}
public function addLot($venueid,$lotname,$lotsize,$lotaddr,$lotstate,$lotzip,$lotdescript)
{
        $vn = $this->db->real_escape_string($venueid);
        $ln = $this->db->real_escape_string($lotname);
        $size = $this->db->real_escape_string($lotsize);
        $addr = $this->db->real_escape_string($lotaddr);
		$state = $this->db->real_escape_string($lotstate);
		$zip = $this->db->real_escape_string($lotzip);
		$desc = $this->db->real_escape_string($lotdescript);
        $query = "insert into lots(venue_id,lot_name,lot_size,lot_address,lot_state,lot_zip,lot_description)
		VALUES ($vn,'$ln','$size','$addr','$state','$zip','$desc');";

        echo "executing SQL statement:\n".$query."\n";
        if (!$this->db->query($query))
        {
                echo "Failed to insert record for $lotname".PHP_EOL;
        }
	return $query;
}
public function addLink($partnerid,$lotid,$zoneid,$islot) 
{
	$pid = $this->db->real_escape_string($partnerid);
	$lid = $this->db->real_escape_string($lotid);
	$zoid = $this->db->real_escape_string($zoneid);
	$type = $this->db->real_escape_string($islot);
	
	if ($type == "rzone") {
		$lotornot = 'zone';
		$query = "insert into links(partner_id,zone_id)
		VALUES ($pid,$zoid);";

		$return = $this->db->query($query);

		return $return;
	} 
	else
	{
		$lotornot = 'lot';
		$query = "Select zone_ID from zones where lot_ID = $lid;";
		
		$queryResponse = $this->db->query($query);
		while($row = $queryResponse->fetch_assoc())
        {
	    $zid = $row['zone_ID'];
            $zquery = "insert into links(partner_id,zone_id)
			VALUES ($pid,$zid);";
				
			echo "executing SQL statement:\n".$zquery."\n";
			if (!$this->db->query($zquery))
			{
				return 0;
			}
        }
		return 1;
	}
	echo "executing SQL statement:\n".$query."\n";
	if (!$this->db->query($query))
		{
            echo "Failed to establish partner link between partner $partnerid and $lotornot $spotid".PHP_EOL;
        }
}
public function addVenue($venuename,$venueaddr,$venuestate,$venuezip,$venuedesc)
{
        $vn = $this->db->real_escape_string($venuename);
        $addr = $this->db->real_escape_string($venueaddr);
		$state = $this->db->real_escape_string($venuestate);
		$zip = $this->db->real_escape_string($venuezip);
		$desc = $this->db->real_escape_string($venuedesc);
        $query = "insert into venues(venue_name,venue_address,venue_state,venue_zip,venue_description)
		VALUES ('$vn','$addr','$state','$zip','$desc');";

        echo "executing SQL statement:\n".$query."\n";
        if (!$this->db->query($query))
        {
                echo "Failed to insert record for $venuename".PHP_EOL;
        }
}

public function addPartner($pname,$paddr,$pstate,$pzip,$pemail,$padvert)
{
        $pn = $this->db->real_escape_string($pname);
        $addr = $this->db->real_escape_string($paddr);
		$state = $this->db->real_escape_string($pstate);
		$zip = $this->db->real_escape_string($pzip);
		$email = $this->db->real_escape_string($pemail);
	$adv =  $this->db->real_escape_string($padvert);

        $query = "insert into partners(partner_name,partner_address,partner_state,partner_zip,partner_email,partner_advert)
		VALUES ('$pn','$addr','$state','$zip','$email','$adv');";

        //echo "executing SQL statement:\n".$query."\n";
        $res = $this->db->query($query);

        return $res;

}

public function addZone($lotid,$zonename)
{
        $lid = $this->db->real_escape_string($lotid);
        $zn = $this->db->real_escape_string($zonename);
        
	if (!empty($zn)) {

	$query = "insert into zones(lot_ID,zone_description)
                VALUES ($lid,'$zn');";
	}

	else {
	
	$lquery = "select lot_name from lots where lot_ID = $lid;";

	$lresult = $this->db->query($lquery);

	$lotname = $lresult->fetch_row();
	$lname = $lotname[0];

	$query = "insert into zones(lot_ID,zone_description)
                VALUES ($lid,'$lname');";

	}

        //echo "executing SQL statement:\n".$query."\n";
        $res = $this->db->query($query);
	
	return $res;
}


public function validateUser($username,$password)
{
        $un = $this->db->real_escape_string($username);
        $pw = $this->db->real_escape_string($password);

        $query = "select * from users where user_name = '$un';";
        $result = $this->db->query($query);

        while ($row = $result->fetch_assoc())
        {
                if ( password_verify($pw, $row["user_password"]) == true)
                {
                        // I have a match
			return $row;
                }
                else {
                        return 0;
                }
	}
	
}
public function makeHash($password)
{
        $pw = $this->db->real_escape_string($password);
		$pw_hashed = password_hash($pw, PASSWORD_DEFAULT);
        return $pw_hashed;
}

public function findLot($table,$placetype,$place) 
{
		$tab = $this->db->real_escape_string($table);
		$pt = $this->db->real_escape_string($placetype);
		$pla = $this->db->real_escape_string($place);
		
        $query = "Select * from $table where ".$placetype."_name LIKE '%$place%' LIMIT 1;";

        $queryResponse = $this->db->query($query);
		return $queryResponse;
}

public function findZone($table,$lotid,$zone,$spacenum,$spacenotes) 
{
		$tab = $this->db->real_escape_string($table);
		$lot = $this->db->real_escape_string($lotid);
		$zn = $this->db->real_escape_string($zone);
		$snum = $this->db->real_escape_string($spacenum);
		$snotes = $this->db->real_escape_string($spacenotes);

		if ($tab == "venues") {

            $zonequery = "Select * from zones where zone_description LIKE '%$zn%' LIMIT 1;";
                }
                else {
                       // $lot = $result['lot_ID'];
                        $zonequery = "Select * from zones where lot_ID = $lot AND zone_description LIKE '%$zn%' LIMIT 1;";
                }
                $result =  $this->db->query($zonequery);
		$response = $result->fetch_assoc();
                if ($zoneid = $response['zone_ID']) {
                         //$row = $this->db->addSpace($_SESSION['user_ID'],$zoneid,$snum,$snotes);
                         return $response;
				}
		else {return 0;}
				
}

public function listVenues()
{
	$query = "Select venue_ID, venue_name from venues;";
	$result = $this->db->query($query);

	return $result;	

}

public function listLots($venueid)
{
	
	$vid = $this->db->real_escape_string($venueid);
	
        $query = "Select lot_ID, lot_name from lots where venue_ID = $vid;";
        $result = $this->db->query($query);

        return $result;

}

public function listZones($lotid)
{

        $lid = $this->db->real_escape_string($lotid);

        $query = "Select zone_ID, zone_description from zones where lot_ID = $lid;";
        $result = $this->db->query($query);

        return $result;

}
public function listPartners()
{
        $query = "Select * from partners;";
        $result = $this->db->query($query);

        return $result;

}
/*public function search($table,$searchterm)
{

	$tab = $this->db->real_escape_string($table);
	$term = $this->db->real_escape_string($searchterm);

	if ($tab == 'partners') {
		$query = "select partners.*, links.zone_ID FROM partners LEFT JOIN links ON partners.partner_ID = links.partner_ID where partners.partner_name LIKE '%$term%';";


	}
	else if ($tab == 'lots') {

                $query = "select lots.*, venues.venue_name FROM lots LEFT JOIN venues ON lots.venue_ID = venues.venue_ID where lots.lot_name LIKE '%$term%';";


        }
	else if ($tab == 'venues') {

                $query = "select venues.*, lots.lot_name FROM venues LEFT JOIN lots ON venues.venue_ID = lots.venue_ID where venues.venue_name LIKE '%$term%';";

        }
	else if ($tab == 'zones') {

                $query = "select lots.lot_name, zones.* FROM zones LEFT JOIN lots ON zones.lot_ID = lots.lot_ID where zones.zone_description LIKE '%$term%';";

        }
	else if ($tab == 'spaces') {

                $query = "select users.user_name, spaces.* FROM spaces LEFT JOIN users ON users.user_ID = spaces.user_ID where users.user_name LIKE '%$term%';";

        }
	else if ($tab == 'users') {

                $query = "select * from users where users.user_name LIKE '%$term%';";

        }
	else if ($tab == 'role') {

                $query = "select * from users where users.user_role LIKE '%$term%';";

        }
	else {
		$query = "select partners.*, links.zone_ID FROM partners LEFT JOIN links ON partners.partner_ID = links.partner_ID where partners.partner_name LIKE '%$term%';";

	}
        $result = $this->db->query($query);

        return $result;

}*/

public function search ($table,$searchterm) {
	if ($table == "spaces") {
		require_once '/var/www/include/vendor/autoload.php';
        	$coll = (new MongoDB\Client("mongodb://pastelsquash:pastelsquash@ds259109.mlab.com:59109/pastelsquash_it635"))->pastelsquash_it635->spaces;
	
		$query = "SELECT user_ID FROM users WHERE user_name LIKE '%$searchterm%' LIMIT 1;";

		$uid = $this->db->query($query);
		$user = $uid->fetch_assoc();
		$userid = $user["user_ID"];
        	$res = $coll->findOne(array("user_id" => "$userid"));

	}
	else {
		$query = "call searchParking('$table','$searchterm');";
		$res = $this->db->query($query);
	}

	return $res;
}

/*public function delSpace($userid)
{

	$uid = $this->db->real_escape_string($userid);
	$query = "Delete from spaces where user_ID = $uid LIMIT 1;";

	$result = $this->db->query($query);

	return $result;

}*/
public function delSpace($userid) {
 require_once '/var/www/include/vendor/autoload.php';
        $coll = (new MongoDB\Client("mongodb://pastelsquash:pastelsquash@ds259109.mlab.com:59109/pastelsquash_it635"))->pastelsquash_it635->spaces;



        $res = $coll->deleteOne(array("user_id" => $userid));
	return $res;

}


public function delParking($lot,$zone,$type)
{

        $lid = $this->db->real_escape_string($lot);
	$zid = $this->db->real_escape_string($zone);
	
	if ($type == "dlot") {
		$zonecleanup = "delete from zones where lot_ID = $lid;";

		$this->db->query($query);

		$query = "Delete from lots where lot_ID = $lid;";
	}
	else if ($type == "dzone") {
		$query = "Delete from zones where zone_ID = $zid;";
	}
	else {
		return false;
	}

        $result = $this->db->query($query);

        return $result;

}
public function delPartner($partnerid)
{

        $pid = $this->db->real_escape_string($partnerid);

        $zonecleanup = "delete from links where partner_ID = $pid;";

        $this->db->query($zonecleanup);

        $query = "Delete from partners where partner_ID = $pid;";

        $result = $this->db->query($query);

        return $result;

}



}
?>
