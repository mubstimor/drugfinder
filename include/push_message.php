<?php 

function send_msg($clientId, $sender, $number, $message){
	/*** To send a text message.**/
		
	$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');

	// Step 2: Use sendText( $to, $from, $message ) method to send a message.

	$fname = firstname($number, $clientId);
	$message = str_replace("uname",$fname,$message);
		
	$info = $nexmo_sms->sendText( $number, $sender, $message );

	// Step 3: Display an overview of the message
	//echo $nexmo_sms->displayOverview($info);

}

?>