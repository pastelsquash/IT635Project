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

public function getParkingSpace($user,$zone)
{
		$id = $this->db->real_escape_string($user);
		$zn = $this->db->real_escape_string($zone);
        $query = "select * from spaces where user_ID = $id and zone_ID = $zn;";

        $queryResponse = $this->db->query($query);
        $response = array();
        while($row = $queryResponse->fetch_assoc())
        {
                $response[] = $row;
        }
	print_r($response);
        return $response;
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

public function addSpace($userid,$zoneid,$spacenum,$spacenotes)
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
        }
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
}
public function addLink($partnerid,$spotid,$islot) 
{
	$pid = $this->db->real_escape_string($partnerid);
	$sid = $this->db->real_escape_string($spotid);
	$type = $this->db->real_escape_string($islot);
	
	if ($type == 0) {
		$lotornot = 'zone';
		$query = "insert into links(partner_id,zone_id)
		VALUES ($pid,$sid);";
	} 
	else
	{
		$lotornot = 'lot';
		$query = "Select zone_ID from zones where lot_ID = $sid;";
		
		$queryResponse = $this->db->query($query);
		while($row = $queryResponse->fetch_assoc())
        {
	    $zid = $row['zone_ID'];
            $zquery = "insert into links(partner_id,zone_id)
			VALUES ($pid,$zid);";
				
			echo "executing SQL statement:\n".$zquery."\n";
			if (!$this->db->query($zquery))
			{
				echo "Failed to establish partner link between partner $partnerid and $lotornot $zid".PHP_EOL;
			}
        }
		return 0;
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

public function addPartner($pname,$paddr,$pstate,$pzip,$pemail)
{
        $pn = $this->db->real_escape_string($pname);
        $addr = $this->db->real_escape_string($paddr);
		$state = $this->db->real_escape_string($pstate);
		$zip = $this->db->real_escape_string($pzip);
		$email = $this->db->real_escape_string($pemail);
        $query = "insert into partners(partner_name,partner_address,partner_state,partner_zip,partner_email)
		VALUES ('$pn','$addr','$state','$zip','$email');";

        echo "executing SQL statement:\n".$query."\n";
        if (!$this->db->query($query))
        {
                echo "Failed to insert record for $pname".PHP_EOL;
        }
}


public function validateUser($username,$password)
{
        $un = $this->db->real_escape_string($username);
        $pw = $this->db->real_escape_string($password);

        $query = "select * from users where user_name = '$un';";
        $result = $this->db->query($query);

        while ($row = $result->fetch_assoc())
        {
                if ($row["user_password"] == $pw)
                {
                        // I have a match
                        return true;
                }
        }
        return false;
}

}
?>
