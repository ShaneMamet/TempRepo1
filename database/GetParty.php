<?php 

$returnData = new stdClass();
$returnData->error = "";

//$_REQUEST['recordid'] = 1;

if ( 
	!isset( $_REQUEST['recordid']) 
) {
	$returnData->error = "Required fields missing";
	echo json_encode($returnData);
	die();
}

require_once "GetConnection.php";
	
$query = " SELECT";
$query .= " P.recordid as id";
$query .= ", P.email";
$query .= ", P.name";

$query .= " FROM fica_party P";
$query .= " WHERE P.recordid = :recordid " ;

$conn = GetConnection();

$stmt = $conn->prepare($query);

$stmt->bindParam(':recordid', $_REQUEST['recordid'], PDO::PARAM_INT); 

try {
	$stmt->execute();
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	$returnData->error = $e->getMessage();
	echo json_encode($returnData);
	die();

}
$returnData->row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($returnData);

?>