#!/usr/bin/php
<?php

require_once("studentDB.inc");
$action = NULL;
for ($i = 1;$i < $argc;$i++)
{
        switch($argv[$i])
        {
                case "--auth":
                        $action = "auth";
                        break;
					
				case "--apartner":
                        $action = "addpartner";
                        break;
					
				case "--avenue":
                        $action = "addvenue";
                        break;
					
				case "--alink":
                        $action = "addlink";
                        break;
					
				case "--azone":
                        $action = "addzone";
                        break;
					
				case "--alot":
                        $action = "addlot";
                        break;
					
				case "--gpartners":
                        $action = "getpartners";
                        break;
				case "--gspace":
                        $action = "getspace";
                        break;
				case "--aspace":
                        $action = "addspace";
                        break;
				
                case "-q":
                        $spacenum = $argv[$i + 1];
                        $i++;
                        break;				
                case "-u":
                        $username = $argv[$i + 1];
                        $i++;
                        break;
                case "-p":
                        $password = $argv[$i + 1];
                        $i++;
                        break;
		case "-n":
                        $name = $argv[$i + 1];
                        $i++;
                        break;
		case "-a":
                        $address = $argv[$i + 1];
                        $i++;
                        break;		
		case "-s":
                        $state = $argv[$i + 1];
                        $i++;
                        break;
		case "-z":
                        $zip = $argv[$i + 1];
                        $i++;
                        break;
		case "-d":
                        $description = $argv[$i + 1];
                        $i++;
                        break;
		case "-e":
                        $email = $argv[$i + 1];
                        $i++;
                        break;
		case "-x":
                        $partnerid = $argv[$i + 1];
                        $i++;
                        break;
		case "-o":
                        $zoneid = $argv[$i + 1];
                        $i++;
                        break;
		case "-l":
                        $lotid = $argv[$i + 1];
                        $i++;
                        break;
		case "-v":
                        $venueid = $argv[$i + 1];
                        $i++;
                        break;
		case "-c":
                        $size = $argv[$i + 1];
                        $i++;
                        break;
		case "-k":
                        $searchkey = $argv[$i + 1];
                        $i++;
                        break;
		case "-b":
                        $spottype = $argv[$i + 1];
                        $i++;
                        break;
        }
}
switch ($action)
{
        case "auth": //needs -u, -p
                if (!isset($username))
                {
                        echo "please provide a username with -u <username>".PHP_EOL;
                        exit(1);
                }
                if (!isset($password))
                {
                        echo "please provide a password with -p <username>".PHP_EOL;
                        exit(1);
                }
                $studentDB = new StudentAccess("Parking");
                if ($studentDB->validateUser($username,$password) == false)
                {
                        echo "login failed!".PHP_EOL;
                }
                else
                {
                        echo "login successful".PHP_EOL;
                }
                break;
		case "addpartner": //needs -n, -a, -s, -z, -e
                if (!isset($name) OR !isset($address) OR !isset($state) OR !isset($zip) OR !isset($email))
				{
					echo "please give -n name, -a address, -s state, -z zip, -e email".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addPartner($name,$address,$state,$zip,$email);
                break;

		case "addvenue": // needs -n, -a, -s, -z, -d
                if (!isset($name) OR !isset($address) OR !isset($state) OR !isset($zip) OR !isset($description))
				{
					echo "please give -n name, -a address, -s state, -z zip, -d description".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addVenue($name,$address,$state,$zip,$description);
                break;

		case "addlot": //needs -v, -n, -c, -a, -s, -z, -d
                if (!isset($venueid) OR !isset($name) OR !isset($size) OR !isset($address) OR !isset($state) OR !isset($zip) OR !isset($description))
				{
					echo "please give -v venueid, -n name, -c capacity, -a address, -s state, -z zip, -d description".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addLot($venueid,$name,$size,$address,$state,$zip,$description);
                break;
		case "addzone": //needs -l, -d
                if (!isset($lotid) OR !isset($description))
				{
					echo "please give -l lotid -d description".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addZone($lotid,$description);
                break;
		case "addlink": //needs -x, -o, -b
                if (!isset($partnerid) OR !isset($zoneid) OR !isset($spottype))
				{
					echo "please give -x partnerid -o (zoneid|lotid) -b (zone|lot)".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addLink($partnerid,$zoneid,$spottype);
                break;	
		case "getpartners": //needs -k
                if (!isset($searchkey))
				{
					echo "please give -k searchkey (can be partnerid or words)".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->getPartners($searchkey);
                break;
		case "getspace": //needs -u, -o
                if (!isset($username) OR !isset($zoneid))
				{
					echo "please give -u username -o zoneid".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->getParkingSpace($username,$zoneid);
                break;	
		case "addspace": //needs -u, -o, -q, -d
                if (!isset($username) OR !isset($zoneid) OR !isset($spacenum) OR !isset($description))
				{
					echo "please give -u username -o zoneid -q spacenum -d description".PHP_EOL;
					exit(1);
				}
                $studentDB = new StudentAccess("Parking");
                $studentDB->addSpace($username,$zoneid,$spacenum,$description);
                break;		
        default:
                echo "No action specified, exiting".PHP_EOL;
                exit (1);

}



echo $argv[0]." complete".PHP_EOL;
?>

