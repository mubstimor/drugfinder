<?php 
include("config.php");

/*INCLUDE FILE FOR SMS api*/
	include "../bank/nexmo/NexmoMessage.php";
	
	function send_reminder($numPlate, $ownerName,$ownerNum){
	 		/*** To send a text message.**/	
			
					$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');

				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 

				$message =", you're reminded that the monthly payment for taxi with plate number ".$numPlate." has not been received. You're advised to clear the bill with in 5 days.";			
			
				$mess =  $ownerName.$message;
				$info = $nexmo_sms->sendText( $ownerNum, 'KCCA', $mess );
		
		// Step 3: Display an overview of the message
				echo $nexmo_sms->displayOverview($info);

	 }
	 
//echo $prev = "DATE_SUB(CURDATE(), INTERVAL 4 WEEK)";
$sql = "
    SELECT taxiId,numberplate,taxiowner.firstname,taxiowner.lastname,taxiowner.phonenumber
    FROM `taxis`,taxiowner
    WHERE taxis.ownerid = taxiowner.ownerid AND `lastChecked` = DATE_SUB(CURDATE(), INTERVAL 4 WEEK)
";

$s = mysql_query($sql);
$num = mysql_num_rows($s);

if ($num > 0) {
    // ooo we found users from four weeks ago.
    while ($row = mysql_fetch_assoc($s)) {
	
		//mail($row['email'], 'The email Subject', 'The email message body');
		
        // notify user
     	$taxiId = $row['taxiId'];
     	$taxiPlate = $row['numberplate'];
     	$ownerNumber = $row['phonenumber'];
     	$ownerName = $row['firstname']." ".$row['lastname'];
		
		//select payments made a month ago by the taxi with a given ID
		$select = mysql_query("SELECT * FROM  `paymentsmade` WHERE dateOfPayment > DATE_SUB(CURDATE(), INTERVAL 4 WEEK) AND taxiId = '$taxiId' ");
		$numpaid = mysql_num_rows($select);
		
		if($numpaid == 0)
		{
			//update USER'S DEBT BASING ON THE CURRENT POLICY & NOTIFY OWNER
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
					
					$updateorinsert = "INSERT INTO debt (taxiId, debtAmount,creditAmount) 
											VALUES ('$taxiId','$diff','0')
											ON DUPLICATE KEY UPDATE debtAmount=(debtAmount + $amount)";
					$rest = mysql_query($updateorinsert);    
					
					}
					send_reminder($taxiPlate, $ownerName,$ownerNumber); //send REMINDER
					
					echo "user $taxiPlate didn't pay";
			}else
			{
				echo "user $taxiPlate did pay"; //IF HE PAID IN THE PAST MONTH IGNORE
				
				}
				
			/*UPDATE TAXI'S TABLE TO KEEP TRACK OF LAST CHECK DATE*/
			$date = date('Y-m-d', time());
			$updatets ="UPDATE taxis set lastChecked='$date' where taxiId='$taxiId'";
			$queryu = mysql_query($updatets) or die("cannot update data". mysql_error());	
		
        // sleep for 2 second so not to hammer mail systems and get flagged as abusive/spammer
        sleep(2);
    }
    //mysqli_free_result($row);
}
else {
    // nothing to do today
	echo "Nothing found";
}

?>