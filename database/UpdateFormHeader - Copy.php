<?php

session_start();


$returnData = new stdClass();
$returnData->success = false;
$returnData->e
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