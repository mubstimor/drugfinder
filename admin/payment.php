<?php
session_start();
	$bankId = $_SESSION['BANKID'];

	include_once('../include/config.php');

		function send_appreciation($numPlate, $amount, $caretakerName,$caretakerNum){
	 		/*** To send a text message.**/	
			
					$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');

				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 

				$message =", your payment of ".$amount."/= for taxi with plate number ".$numPlate." has been received. Thank u for updating your taxi's account at KCCA.";			
			
				$mess =  $caretakerName.$message;
				$info = $nexmo_sms->sendText( $caretakerNum, 'KCCA', $mess );
			// Step 3: Display an overview of the message
			// Step 3: Display an overview of the message

			echo $nexmo_sms->displayOverview($info);

	 }
	 
	/*INCLUDE FILE FOR SMS api*/
	include "nexmo/NexmoMessage.php";
	
	$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
			 
	
		$message=array();
		if(isset($_POST['amount']) && !empty($_POST['amount'])){
			$amount=mysql_real_escape_string($_POST['amount']);
		}else{
			$message[]='Please enter Amount';
		}

		if(isset($_POST['taxiId']) && !empty($_POST['taxiId'])){
			$taxiId=mysql_real_escape_string($_POST['taxiId']);
		}else{
			$message[]='Please select TAXIID';
		}

		$countError=count($message);

		if($countError > 0){
			 for($i=0;$i<$countError;$i++){
					  echo ucwords($message[$i]).'<br/>';
			 }
		}else{			
		
			$query="INSERT INTO paymentsmade(paymentId,taxiId,amount,bankid) VALUES('','$taxiId','$amount','$bankId')";
			$res=mysql_query($query);    
			$last_payment = mysql_insert_id();
			 
			if($res > 0){
			
				$caretakerName='';
				$caretakerNumber='';
				$numberPlate='';
				$pamount='';
				$taxiId = '';
				
					$select="select c.firstname as cfname, c.lastname as clname, c.phonenumber as cpnumber,p.paymentId,taxis.taxiId,numberplate,p.dateOfPayment as date,taxiowner.firstname as fname,taxiowner.lastname as lname,p.amount 
							from taxis,taxiowner,paymentsmade p,caretaker c 
							where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=p.taxiId AND taxis.caid=c.caid AND p.paymentId = '$last_payment'";
					$query = mysql_query($select) or die("cannot select data". mysql_error());	
					while($result =mysql_fetch_array($query, MYSQL_ASSOC))
					{
					$caretakerName = $result['cfname']." ".$result['clname'];
					$caretakerNumber = $result['cpnumber'];
					$numberPlate = $result['numberplate'];
					$pamount = $result['amount'];									
					$taxiId = $result['taxiId'];									
					}
					
					send_appreciation($numberPlate, $pamount, $caretakerName,$caretakerNumber);
					
				 /*send response back to page*/
				 echo 'inserted';
				 
				 //UPDATE THE CREDIT STATUS THEN
				$select_policy ="select amount,
										case
											WHEN now() < Date THEN 'tobenewtax'
											WHEN now() > Date THEN 'current'
											else 0
											end as validity
											from taxipolicy
											order by policyid desc LIMIT 2";
					$query_policy = mysql_query($select_policy) or die("cannot select data". mysql_error());	
					while($result =mysql_fetch_array($query_policy, MYSQL_ASSOC))
					{
					$amount = $result['amount'];
					$validity = $result['validity'];

					if($validity=='current'){
					
					/*UPDATE / INSERT THE DEBT TABLE WITH DEBT OR CREDIT WHERE NECESSARY*/
					
						if($amount == $pamount){ //set debt to zero
							$updateorinsert = "INSERT INTO debt (taxiId, debtAmount,creditAmount) 
									VALUES ('$taxiId','0','0')
									ON DUPLICATE KEY UPDATE debtAmount=(debtAmount + 0)";
							$rest = mysql_query($updateorinsert);    
						}else if( $pamount < $amount){ //store debit
						$diff = $amount-$pamount;
								$updateorinsert = "INSERT INTO debt (taxiId, debtAmount,creditAmount) 
											VALUES ('$taxiId','$diff','0')
											ON DUPLICATE KEY UPDATE debtAmount=(debtAmount + $diff)";
									$rest = mysql_query($updateorinsert);    
						}else if($pamount > $amount){
							$diff = $amount-$pamount;
								$updateorinsert = "INSERT INTO debt (taxiId, debtAmount,creditAmount) 
												VALUES ('$taxiId','$diff','0')
												ON DUPLICATE KEY UPDATE creditAmount=(creditAmount + ($pamount-$amount))";
										$rest = mysql_query($updateorinsert);   
						}
						
						
						}else{
							
						}
					}
					
			}else{
				 echo ucwords('failed to insert-> '.$ownerid." ".mysql_error());
			}	
		}

?>

