<?php

require_once("../include/studentDB.inc");
function doLogin($username,$password)
{
	$studentDB = new StudentAccess("Classes");
	return $studentDB->validateUser($username,$password);
}

if (!isset($_POST))
{
	echo "error: expected POST data!";
	exit(0);
}
if (!isset($_POST["type"]))
{
	echo "error: no type specified";
	exit(0);
}
$response = "unsupported request type";
switch($_POST["type"])
{
	case "auth":
	    $auth = doLogin($_POST["username"],$_POST["password"]);
	    if ($auth)
	    {
		$response = "successful";
	    }
	    else
	    {
		$response = "failed";
	    }
	break;
}

echo json_encode($response);
?>
