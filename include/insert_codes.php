<?php 

function insert_group($clientId,$groupName){
	$sql = "INSERT INTO `group` (groupName,clientId) VALUES('$groupName','$clientId')";
	$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));  
	if($result){
		$inserted=true; 
	}else{
		$inserted=false;
	}
	return $inserted;
}

/**
 * 
 * */
function insert_contact($fName,$lName,$phone,$clientId,$group){	
	$sql = "INSERT INTO `contact` (firstName,lastName,phoneNumber,clientId) VALUES('$fName','$lName','$phone','$clientId')";
	$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
	$last_contact_id  = mysql_insert_id();
	if($result){
		if(isset($group)){
			assign_contact($last_contact_id,$group);
		}
		$inserted=true;
	}else{
		$inserted=false;
	}
	return $inserted;
}


/**
 *add_drug_store($cname, $email, $phone, $address,$latitude,$longitude,$username,$password);
 * */
function add_drug_store($cname, $email, $phone, $address,$latitude,$longitude,$username,$password,$adminId){
	$sql = "INSERT INTO `clinic` (clinicName,clinicEmail,address, contactNumber,latitude,longitude, whoAdded) VALUES('$cname','$email','$address','$phone','$latitude','$longitude','$adminId')";
	$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
	$last_clinic_id  = mysql_insert_id();
	if($result){
		store_clinic_logins($last_clinic_id, $username, $password);
		$inserted=true;
	}else{
		$inserted=false;
	}
	return $inserted;
}
/**
  *record drug by clinic admin
 * */
function insert_drug($name, $description, $prescription, $price,$clinicId){
	$sql = "INSERT INTO `drug` (drugName,drugDescription,prescription,whoAdded) VALUES('$name', '$description', '$prescription', '$clinicId')";
	$result = mysql_query($sql) or die(mysql_error() . " - $sql");
	$last_drug_id  = mysql_insert_id();
	
		if(isset($last_drug_id)){			
			assign_drug_to_clinic($clinicId,$last_drug_id,$price);
			$inserted=true;
		}else $inserted=false;

	return $inserted;
}

/**
*record drug by NDA
* */
function insert_drug_by_admin($name, $description, $prescription, $adminId){
	$sql = "INSERT INTO `drug` (drugName,drugDescription,prescription,whoAdded) VALUES('$name', '$description', '$prescription', '$adminId')";
	$result = mysql_query($sql) or die(mysql_error() . " - $sql");
	if($result){
			$inserted=true; 
		}else{
			$inserted=false;
		}
	return $inserted;
}

function assign_drug_to_clinic($clinicId,$drugId,$price){

		$sql = "INSERT INTO clinic_drug (clinicId,drugId, dosagePrice) VALUES('$clinicId','$drugId','$price')";
		$result = mysql_query($sql) or die(mysql_error() . " - $sql");
		if($result){
			$inserted=true;
		}else{
			$inserted=false;
		}
		return $inserted;
	
}

function store_clinic_logins($clinicId,$username,$password){

	$sql = "INSERT INTO clinic_login (clinicId,userName, password) VALUES('$clinicId','$username','$password')";
	$result = mysql_query($sql) or die(mysql_error() . " - $sql");
	if($result){
		$inserted=true;
	}else{
		$inserted=false;
	}
	return $inserted;

}

function assign_contact($contact,$group){
	if(check_user_in_group($contact, $group) >0){
		return 	$inserted=false;
	}else{
		$sql = "INSERT INTO `groupmember` (contactId,groupId) VALUES('$contact','$group')";
		$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
		if($result){
			$inserted=true;
		}else{
			$inserted=false;
		}
		return $inserted;
	}
}

function add_license($drugstore,$startDate,$expiryDate){
		$sql = "INSERT INTO `clinic_license` (clinicId,startDate,endDate) VALUES('$drugstore','$startDate','$expiryDate')";
		$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
		if($result){
			$inserted=true;
		}else{
			$inserted=false;
		}
		return $inserted;	
}

function add_drug_stock($drugId,$serial,$expiryDate,$quantity){
	$sql = "INSERT INTO `drug_stock` (drugId,serialNumber,expiryDate,carton_quantity) VALUES('$drugId','$serial','$expiryDate','$quantity')";
	$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
	if($result){
		$inserted=true;
	}else{
		$inserted=false;
	}
	return $inserted;
}

function add_drug_distribution($drugId,$serial,$clinicId,$quantity){
	$sql = "INSERT INTO `drug_distribution` (drugId,serialNumber,clinicId,carton_quantity) VALUES('$drugId','$serial','$clinicId','$quantity')";
	$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
	if($result){
		$inserted=true;
		mysql_query("UPDATE `drug_stock` SET carton_quantity=(carton_quantity-'$quantity') where serialNumber='$serial'");
		
	}else{
		$inserted=false;
	}
	return $inserted;
}

/**
 * send a message to a group
 * */
function contact_group($group, $message,$numReceivers,$clientId,$sender){
	
	$numReceivers = determine_receivers($clientId, $numReceivers); //reset number first
	
	if($numReceivers == 0){
		return $inserted = false;
	}else{
		$sql = "INSERT INTO `message` (message,noOfReceivers,clientId,sender) VALUES('$message','$numReceivers','$clientId','$sender')";
		$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
		$last_msg_id  = mysql_insert_id();
		if($result){
			mysql_query("INSERT INTO `group_message` (messageId,groupId) VALUES('$last_msg_id','$group')");
			update_account($clientId, $numReceivers);
			$i=0;
			$numbers = get_groupContacts($group); //store numbers in an array
			
			while($i<count($numReceivers)){ //cut down the number of receivers
				send_msg($clientId, $sender, $numbers[$i], $message);
				mysql_query("INSERT INTO `individual_message` (messageId,contactNumber) VALUES('$last_msg_id','$numbers[$i]')");
				$i++;
			}
			$inserted=true;
		}else{
			$inserted=false;
		}
		return $inserted;
	}
}

/**
 * send a message to an individual
 * */
function contact_individual($message,$phone,$clientId,$sender){
	
	$numReceivers = determine_receivers($clientId, 1); //reset number first
	if($numReceivers == 0){
		return $inserted = false;
	}else{
		
		$sql = "INSERT INTO `message` (message,noOfReceivers,clientId,sender) VALUES('$message','1','$clientId','$sender')";
		$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
		$last_msg_id  = mysql_insert_id();
		if($result){
			send_msg($clientId, $sender, $phone, $message);
			mysql_query("INSERT INTO `individual_message` (messageId,contactNumber) VALUES('$last_msg_id','$phone')");			
			update_account($clientId, 1);
			$inserted=true;
		}else{
			$inserted=false;
		}
			
		return $inserted;
	}
}

/**
 * send a message to an individual
 * */
function contact_friends($message,$phonenums,$clientId,$sender){

	$numReceivers = determine_receivers($clientId, count($phonenums)); //reset number first
	if($numReceivers == 0){
		return $inserted = false;
	}
	else
	{
		$receiversNum = count($phonenums); 
		$sql = "INSERT INTO `message` (message,noOfReceivers,clientId,sender) VALUES('$message','$receiversNum','$clientId','$sender')";
		$result = mysql_query($sql) or (mysql_query("ROLLBACK") and die(mysql_error() . " - $sql"));
		$last_msg_id  = mysql_insert_id();
		if($result){
			$i=0;
			while($i<count($phonenums)){
				send_msg($clientId, $sender, $phonenums[$i], $message);
				mysql_query("INSERT INTO `individual_message` (messageId,contactNumber) VALUES('$last_msg_id','$phonenums[$i]')");
				$i++;
			}
			update_account($clientId, count($phonenums));
			$inserted=true;
		}else{
			$inserted=false;
		}	
		return $inserted;
	}
}
?>