<?php
    if (!isset($_SESSION)) {        error_reporting();        session_start();    }
    require "../../config.php";
	include "../../include/function.php";

	//if sending message
	if(isset($_POST['sender'])){
		//check for message parameters
		if($_POST['sender']!=""&& $_POST['receiver']&& $_POST['message']){
			$sender = $_POST['sender'];
			$receiver = $_POST['receiver'];
			$message = $_POST['message'];
			/*** To send a text message.**/	
			include ( "NexmoMessage.php" );
			$get_client = "SELECT * FROM `admin` WHERE `number`='$sender'";
			$get = mysql_query($get_client);
			if(mysql_num_rows($get)!=0){
				// Step 1: Declare new NexmoMessage.
				$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
				$info = $nexmo_sms->sendText( $receiver, 'Sms Me', $message );
				// Step 3: Display an overview of the message
				//echo $nexmo_sms->displayOverview($info);
				sentMessage($message, $receiver, 1);
				header('Location: ../individual.php?a=1');
				// Done!
			}
			else header('Location: ../individual.php?a=2'); 
		}
		else header('Location: ../individual.php?a=3'); 	
	}
	
?>