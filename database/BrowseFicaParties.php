<?php 
/*
$_REQUEST['offset'] = 0;
$_REQUEST['limit'] = 10;
$_REQUEST['sortcolumn'] = "profile_name";
$_REQUEST['sortorder'] = "asc";
$_REQUEST['search'] = 'ano';

*/



$returnData = new stdClass();
$returnData->error = "";

require_once "GetConnection.php";

$whereClause = " WHERE 1=1";

if ( isset($_REQUEST['search']) ) {
	
	if ( !empty($_REQUEST['search']) ) {
	
		$whereClause .= " AND (";
		$whereClause .= " P.name ilike '%{$_REQUEST['search']}%'";
		$whereClause .= " OR P.email ilike '%{$_REQUEST['search']}%'";
		$whereClause .= ")";
	
	}
}


$orderBy = " ORDER BY {$_REQUEST['sortcolumn']} {$_REQUEST['sortorder']}";


$offset = $_REQUEST['offset'];	
$limit = $_REQUEST['limit'];

$query = " SELECT";
$query .= " P.recordid";
$query .= ", P.name";
$query .= ", P.email";
$query .= ", P.thumbnail_image";

$query .= " FROM fica_party P";

$query .= $whereClause;
$query .= $orderBy;
$query .= " limit $limit";
$query .= " offset $offset";

$conn = GetConnection();

try {
	$stmt = $conn->query($query);
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	$returnData->error = $e->getMessage();
	echo json_encode($returnData);
	die();

}

$returnData->rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($returnData);

?>