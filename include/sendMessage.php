<?php	

//session_start();
	error_reporting(0);
	require "config.php";

	$num =0;
	$get_client='';
	
	
	$message=array();
if(isset($_POST['category']) && !empty($_POST['category']) || $_POST['category']=='0' ){
    $category = mysql_real_escape_string($_POST['category']);
}else{
    $message[]='Please Select Category';
}

if(isset($_POST['message']) && !empty($_POST['message'])){
    $text = stripslashes($_POST['message']);
	
}else{
    $message[]='Please enter Message';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/>';
     }
}else{

		//check for message parameters
		if($_POST['category'] !="" && $_POST['message']){
			$message = $text;
			
			/*** To send a text message.**/	
			include ("../bank/nexmo/NexmoMessage.php");
						
			if($category=='1'){ /*those with debts*/
			$get_client = "select DISTINCT taxiowner.phonenumber, taxis.taxiId,numberplate,taxiowner.firstname as fname,taxiowner.lastname as lname,d.debtAmount
												from taxis,taxiowner,debt d 
												where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=d.taxiId AND d.debtAmount != '0'";
			}else if($category=='2'){ /*those with cleared accounts*/
				$get_client = "select DISTINCT taxiowner.phonenumber, taxis.taxiId,numberplate,taxiowner.firstname as fname,taxiowner.lastname as lname,d.debtAmount
												from taxis,taxiowner,debt d 
												where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=d.taxiId AND d.debtAmount = '0'";

			}else if($category=='3'){ /*All taxi Owners*/
				$get_client = "select DISTINCT taxiowner.phonenumber, taxiowner.firstname as fname,taxiowner.lastname as lname
												from taxiowner";

			}else if($category=='4'){ /*All taxi Caretakers*/
				$get_client= "select DISTINCT c.phonenumber, c.firstname as fname,c.lastname as lname
												from caretaker c";

			}
			else{
				$get_client= "select DISTINCT taxiowner.phonenumber, taxiowner.firstname as fname,taxiowner.lastname as lname
												from taxiowner where length(phonenumber) <5";
			}			

			//echo $get_client;
			$get = mysql_query($get_client);
		
		//arrays to hold data
		$numbers = array();
		$receivers  =array();
		
		// Step 1: Declare new NexmoMessage.
				
		$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
				
			while( $r = mysql_fetch_assoc($get)){
				$name = $r['fname'];
				$number = $r['phonenumber'];
				
				
				array_push($receivers, $name);
				array_push($numbers, $number);	
			
			// Done!
			$num++;
			}
		
			 //use loop to move thru conts
			 for($i =0; $i < count($numbers); $i++ ){
				 /*DYNAMICALLY REPLACE NAME*/				
				$names = explode(" ",$receivers[$i]);
				$fname1 = $names[0];
				$fname2 = $names[1];
			
				$str2 = str_replace("uname", $fname1, $message);
				 $mess = $str2;
				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
				$info = $nexmo_sms->sendText( $numbers[$i], 'KCCA', $mess );					
			 }
			 
			 // Step 3: Display an overview of the message			
			//echo $nexmo_sms->displayOverview($info);
			//echo "sent ".count($numbers)." messages</p>";
			echo "sent";
						
			}
			else{
				echo "Message not sent";
			}
			
		
	}		
			?>			