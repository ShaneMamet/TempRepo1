<?php 

function GetConnection(){

	$returnData = new stdClass();
	$returnData->error = "";
	$returnData->success = false;


	if (!isset($_SESSION)) session_start();

	if(!isset($_SESSION['host'])) $_SESSION['host'] = "localhost";
//	if(!isset($_SESSION['host'])) $_SESSION['host'] = "www.legalsuite.co.za";

	if(!isset($_SESSION['db'])) $_SESSION['db'] = "ettorney";
	if(!isset($_SESSION['user'])) $_SESSION['user'] = "website";
	if(!isset($_SESSION['pass'])) $_SESSION['pass'] = "lsw123";


	try {
		$conn = new PDO("pgsql:host={$_SESSION['host']} dbname={$_SESSION['db']} port=5432",$_SESSION['user'],$_SESSION['pass']);
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		$returnData->error = $e->getMessage();
		echo json_encode($returnData);
		die();

	}

	return $conn;
} 

?>
