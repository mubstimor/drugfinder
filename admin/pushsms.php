<?php
		include "nexmo/NexmoMessage.php";
	
	function send_appreciation($a,$b){
	 		/*** To send a text message.**/	
			
					$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');

				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 

				$message =", thank u for subscribing to SmsMe's updates. Updates will always be timely, we promise!";			
			
				$mess =  $a.$message;
				$info = $nexmo_sms->sendText( $b, 'KCCA', $mess );
			// Step 3: Display an overview of the message
			// Step 3: Display an overview of the message

			echo $nexmo_sms->displayOverview($info);

	 }
	 
				send_appreciation('Jonah', '256785923673');			
	
?>
