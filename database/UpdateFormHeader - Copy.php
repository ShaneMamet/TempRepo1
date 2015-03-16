<?php

session_start();


$returnData = new stdClass();
$returnData->success = false;
$returnData->error = "";

if ( !isset( $_SESSION['BaseUrl']) ) {

	$returnData->error =  "Hack attempt detected";
	
	WriteHackLog( 'No BaseUrl' );
	
	echo json_encode($returnData);	
	die;
}

require_once "/GetConnection.php";
require_once "/StripData.php";

$conn = GetConnection();


function WriteHackLog($where) {

	$ip = $_SERVER["REMOTE_ADDR"]; // Get the IP from superglobal
	$host = gethostbyaddr($ip);    // Try to locate the host of the attack
	$date = date("d M Y");
	
	// create a logging message with php heredoc syntax
	$logging = <<<LOG
		\n
		<< Start of Message >>
		Hacking attempt detected. \n 
		Date of Attack: {$date}
		IP-Adress: {$ip} \n
		Host of Attacker: {$host}
		Point of Attack: {$where}
		<< End of Message >>
LOG;
        
        // open log file
		if($handle = fopen('hacklog.log', 'a')) {
		
			fputs($handle, $logging);  // write the Data to file
			fclose($handle);           // close the file
			
		} else {  // if first method is not working, for example because of wrong file permissions, email the data
		
        	$to = 'admin@ettorney.com';  
        	$subject = 'HACK ATTEMPT DETECTED';
        	$header = 'From: admin@ettorney.com';
        	if (mail($to, $subject, $logging, $header)) {
        		echo "Sent notice to admin.";
        	}

	}
}


?>