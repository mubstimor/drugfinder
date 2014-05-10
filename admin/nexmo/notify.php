<?php	
	session_start();
	include_once('../include/config.php');
	
	$num =0;
	$get_client='';
	//if sending message
	if(isset($_POST['course'])){
		//check for message parameters
		if($_POST['course']!=""&& $_POST['year'] && $_POST['time']!=""&& $_POST['message']){
			$course = $_POST['course'];
			$year = $_POST['year'];
			$time = $_POST['time'];			
			$message = $_POST['message'];
			/*** To send a text message.**/	
			include ( "NexmoMessage.php" );
			if($_POST['course_unit']){
				$cu = $_POST['course_unit'];
				$get_client = "Select DISTINCT student_view.student_id, client.id,client.first_name, client.number 
				from client inner join student_view 
				ON ( student_view.student_id = client.id)
				WHERE 
				`course`='$course' AND `year_of_study`='$year' AND `time_of_study`='$time' AND student_view.courseU_id='$cu' AND status='1'";
			}
			else if ($time=='0'){
				$get_client = "SELECT DISTINCT number, first_name FROM `client`	WHERE `course`='$course' AND `year_of_study`='$year' AND status='1'";
			}
			else{
				$get_client = "SELECT DISTINCT number, first_name FROM `client` 
				WHERE `course`='$course' AND `year_of_study`='$year' AND `time_of_study`='$time' AND status='1'";
			}
			 echo $get_client;
			$get = mysql_query($get_client);
		
		//arrays to hold data
		$numbers = array();
		$students  =array();
		
		// Step 1: Declare new NexmoMessage.
				
		$nexmo_sms = new NexmoMessage('c5757fb1', '8591e132');
				
			while( $r = mysql_fetch_assoc($get)){
				$name = $r['first_name'];
				$number = $r['number'];
				
				
				array_push($students, $name);
				array_push($numbers, $number);	
			
			// Done!
			$num++;
			}
			
			//use loop to move thru conts
			 for($i =0; $i < count($numbers); $i++ ){
				 $mess = $message; //"Hi ".$students[$i].', '.
				// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
				$info = $nexmo_sms->sendText( $numbers[$i], 'SmsMe', $mess );			
			 }
			 
			 // Step 3: Display an overview of the message			
			 echo $nexmo_sms->displayOverview($info);
			 echo "<p>sent ".count($numbers)." messages</p>";
			$course = getcourse($course).' '.$time;
			sentMessage($message, $course, $num);
			//header('Location: ../index.php?a=1');
			}
			else{
			//header('Location: ../index.php?a=2');
			}
			
			}//end
			
			?>			