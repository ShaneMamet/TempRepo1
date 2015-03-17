<<<<<<< HEAD

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
=======
<?php

//require_once "../pdoGetInt.php";
require_once "/StripData.php";
require_once "/UpdateFormHeader.php";

$returnData->error = "";

!!! Shane removed this entire if statement !!!
fsdfsdfsfsd

if ( $_REQUEST['action'] == 'change' )
	{
		$query = "UPDATE fica_party SET";
		$query .= " name = '" . StripContent($_REQUEST['name']) . "'";
		$query .= ", email = '" . $_REQUEST['email'] . "'";
		$query .= " WHERE recordid = {$_REQUEST['recordid']}";
		$query .= " RETURNING recordid";
	}
	else
	{
		$creationDate = gmdate ( 'Y-m-d H:i:s'); //Get the current creation date
		
		$query = "INSERT INTO fica_party";
		$query .= " (creation_date, email, name)";
		$query .= " VALUES (" ;
		$query .= "'". $creationDate . "'";
		$query .= ", '" . $_REQUEST['email'] . "'";
		$query .= ", '" . StripContent($_REQUEST['name']) . "'";
		$query .= ")" ;
	}
	
$count = $conn->exec( $query ); //Execute the query

if ( !is_int($count) ) { //Check if the query returns a count ("1 row affect" etc.)

	$error = $conn->errorInfo();
	$returnData->error = $error[2];
	echo json_encode($returnData);
	die();

} else {

	$returnData->success = true;
}


	
?>
>>>>>>> parent of 569336b... yyyy added
