<?php   
	require("../taxisys/include/config.php");
	include("../taxisys/include/function.php");
	include "../taxisys/bank/nexmo/NexmoMessage.php";
	
	function send_regret($b){
		/*** To send a text message.**/	
		$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$message ="Check u didn't add ur taxi Id or the taxi isn't registered ";			
		$info = $nexmo_sms->sendText( $b, 'KCCA', $message );
	}
		
	function send_response($b,$message){
		/*** To send a text message.**/	
		$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
		// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
		$info = $nexmo_sms->sendText( $b, 'KCCA', $message );
	}
	
	/*********************************************
		**    Receive Data form True African 7197   **
	**********************************************/
	//www.smsme.info/api/inbound.php?msisdn=256781456492&text=mytt
	if($_GET['msisdn']){
		$phone =  $_GET['msisdn'];
		$text = $_GET['text'];
		$type = $_GET['type'];
		//$time = now();
		$network = $_GET['network-code'];
		
		//check network -STORE ALL REQUESTS TO THE SYSTEM
		//$in = "INSERT INTO `inmsgs` (`messageId`, `msisdn`, `text`, `type`,`network-code`,`message-timestamp`, `response`)
		//VALUES ('', '$phone', '$text', '$type', '$network','$time',  '0')";
		//$go = mysql_query($in);
		
		//Check if number is registered
		$pieces = explode(" ", $text);
		$key = $pieces[0]; // piece1
		$taxiId = $pieces[1]; // piece2
		$comment="";
		
		if($key=="mycw"){
		$i=1;
		
			while($i < count($pieces)){
			
				$comment .= $pieces[$i]." ";
				$i++;
			}
		}
		
		// check if taxi ID exists, preferably from database
		if($key){
			//switch testing key words
			switch ($key) {				
				case "mytt":
				if(registered($taxiId)){
				$message = accountStatus($taxiId);
				echo accountStatus($taxiId);
				send_response($phone,$message);
				}
				break;
				
				case "mycw":
				echo "Yes my comment is $comment";
				receivedComment($comment, $phone);
				break;
				
				default:
				echo "Sorry";
				break;
			}
		}
		else{
			echo "Id not found";
			// response is unknown Number 
			send_regret($phone);
		}
		
	}
	else{
		echo "No parameter";
	}
?>