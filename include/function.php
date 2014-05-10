<?php 
/**
 * clean up phone Number
 * */
function clean($number){
	$phone = preg_replace("/[^0-9]/", "", $number);
	$phone = preg_replace("/^(256|0)/", "", $phone);
	if(strlen($phone) < 9) {
		$phone = "256".substr($phone, 0, 2)."2".substr($phone, 2);
	}
	else {	$phone = "256".$phone;
	}
	return $phone;
}

/**
 * Delete contact of a given client
 * */
function delete_contact($contactId,$clientId){
	$query="delete from `contact` where contactId='$contactId' and clientId='$clientId'";
	$res=mysql_query($query);
	if($res){
		mysql_query("delete from `groupmember` where contactId='$contactId'");
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}

/**
 * Delete
 * */
function delete_drug_by_admin($drugId){
	$query="delete from `drug` where drugId='$drugId'";
	$res=mysql_query($query);
	if($res){
		mysql_query("delete from `clinic_drug` where drugId='$drugId'");
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}

/**
 * Delete
 * */
function delete_drug_from_store($drugId,$clinicId){
	$query="delete from `clinic_drug` where drugId='$drugId' AND clinicId='$clinicId'";
	$res=mysql_query($query);
	if($res){	
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}
/**
 * Delete
 * */
function delete_clinic_by_admin($clinicId){
	$query="delete from `clinic` where clinicId='$clinicId'";
	$res=mysql_query($query);
	if($res){
		mysql_query("delete from `clinic_login` where clinicId='$clinicId'");
		mysql_query("delete from `clinic_drug` where clinicId='$clinicId'");
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}

/**
 * Delete group of a given client
 * */
function delete_group($groupId,$clientId){
	$query="delete from `group` where groupId='$groupId' and clientId='$clientId'";
	$res=mysql_query($query);
	if($res){
		mysql_query("delete from `groupmember` where groupId='$groupId'");
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}

/**
 * Delete contact from a given group
 * */
function delete_contact_from_group($contactId, $groupId){
	$query="delete from `groupmember` where contactId='$contactId' and groupId='$groupId'";
	$res=mysql_query($query);
	if($res){	
		$deleted=true;
	}else{
		$deleted=false;
	}
	return $deleted;
}

/**
 * update contact 
 * */
function update_contact($contact, $fName, $lName, $phone, $clientId){
	$query="UPDATE `contact` SET firstName='$fName', lastName='$lName',phoneNumber='$phone' where contactId='$contact' and clientId='$clientId'";
	$res=mysql_query($query);
	if($res){
		$updated=true;
	}else{
		$updated=false;
	}
	return $updated;
}


/**
 * update drug
 * */
function update_drug($clinicId, $drugId, $pricing,$availability){
	$query="UPDATE `clinic_drug` SET dosagePrice='$pricing',availability='$availability' where clinicId='$clinicId' and drugId='$drugId'";
	$res=mysql_query($query);
	if($res){
		$updated=true;
	}else{
		$updated=false;
	}
	return $updated;
}

/**
 * update drug by admin
 * */
function update_drug_by_admin($adminId, $drugId, $name, $prescription,$description){
	$query="UPDATE `drug` SET drugName='$name', drugDescription='$description', prescription='$prescription' where drugId='$drugId'";
	$res=mysql_query($query);
	if($res){
		$updated=true;
	}else{
		$updated=false;
	}
	return $updated;
}

/**
 * update client's details
 * */
function update_client($email, $fName, $lName, $phone,$password, $clientId){
	$query="UPDATE `client` SET firstName='$fName', lastName='$lName',phoneNumber='$phone', email='$email' where clientId='$clientId',password='$password' and clientId='$clientId'";
	$res=mysql_query($query);
	if($res){
		$updated=true;
	}else{
		$updated=false;
	}
	return $updated;
}

/**
 * update clinic's details
 * */
function update_clinic($clinicId, $cname, $email, $phone,$address,$latitude,$longitude){
	$query="UPDATE `clinic` SET clinicName='$cname', clinicEmail='$email',address='$address', contactNumber='$phone', latitude='$latitude', longitude='$longitude' where clinicId='$clinicId'";
	$res=mysql_query($query);
	if($res){
		$updated=true;
	}else{
		$updated=false;
	}
	return $updated;
}
?>