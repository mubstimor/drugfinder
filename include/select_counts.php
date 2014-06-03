<?php 

/**
 * count the number of items that a client has, depending on what's requested
 * */
	function count_values($clientId,$table){  
		$select="select * from `$table` where clientId='$clientId'";	
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$count = mysql_num_rows($query_c);	
		return $count;
	}

	/**
	 * count the number of items that a search request returns
	 * */
	function count_searchResults($searchKey){
		$select="select * from drug where drugName Like'%$searchKey%'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$count = mysql_num_rows($query_c);
		return $count;
	}
	
	/**
	 * return the client's account balance
	 * */
	function count_balance($clientId){
			$select="select * from `account` where clientId='$clientId'";
			$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
			$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
			$bal = $result['accountBalance'];
			return $bal;
	}
	
	/**
	 * return the group name
	 * */
	function get_groupName($groupId,$clientId){
		$select="select * from `group` where clientId='$clientId' and groupId='$groupId'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$name = $result['groupName'];
		return $name;
	}
	
	/**
	 * check_user takes the username and password and returns the clientId
	 * */
	function check_user($username,$password){
			$select="select * from `clinic_login` where userName='$username' AND password='$password'";
			$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
			$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
			$id = $result['clinicId'];
			return $id;
	}
	
	/**
	 * check whether drug exists in store
	 * */
	function check_drug_in_store($drugId,$clinicId){
		$select="select * from `clinic_drug` where clinicId='$clinicId' AND drugId='$drugId'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$count = mysql_num_rows($query_c);	
		return $count;
	}
	
	/**
	 * check super admin takes the username and password and returns the AdminId
	 * */
	function check_super_admin($username,$password){
		$select="select * from `admin_login` where userName='$username' AND password='$password'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$id = $result['adminId'];
		return $id;
	}

	/**
	 * check admin category takes the AdminId and returns the category
	 * */
	function check_admin_category($adminId){
		$select="select * from `admin` where adminId='$adminId'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$category = $result['category'];
		return $category;
	}
	
	/**
	 * Get All clinics/drug stores
	 * */
	function get_drug_stores(){
		$get_stores = mysql_query("SELECT * FROM `clinic` order by clinicId DESC");
		while($p = mysql_fetch_assoc($get_stores)){
			$name = $p['clinicName'];
			$clinic_id = $p['clinicId'];
			$address = $p['address'];
			$option .= "<option value='$clinic_id'>$name : $address</option>";
		}
		return $option;
	}
	
	/**
	 * Get All drugs
	 * */
	function get_drugs(){
		$get_stores = mysql_query("SELECT * FROM `drug` order by drugName DESC");
		while($p = mysql_fetch_assoc($get_stores)){
			$name = $p['drugName'];
			$drug_id = $p['drugId'];			
			$option .= "<option value='$drug_id'>$name</option>";
		}
		return $option;
	}
	
	/**
	 * Get All Groups for a given client from database in a dropdown
	 * */
	function get_groups($clientId){
		$get_groups = mysql_query("SELECT * FROM `group` where clientId='$clientId'");
		while($p = mysql_fetch_assoc($get_groups)){
			$name = $p['groupName'];
			$group_id = $p['groupId'];
			$option .= "<option value='$group_id'>$name</option>";
		}
		return $option;
	}
	
	/**
	 * Get All Contacts for a given client from database in a dropdown
	 * */
	function get_contacts($clientId){
		$get_groups = mysql_query("SELECT * FROM `contact` where clientId='$clientId'");
		while($p = mysql_fetch_assoc($get_groups)){
			$name = $p['firstName'].' '.$p['lastName'];
			$contact_id = $p['contactId'];
			$option .= "<option value='$contact_id'>$name</option>";
		}
		return $option;
	}
	
	/**
	 * count the number of members in a given group 
	 * */
	function count_groupMembers($groupId){
		$count_members = "SELECT * FROM `groupmember` where groupId='$groupId'";
		$query_c = mysql_query($count_members) or die("cannot select data" . mysql_error());
		$count = mysql_num_rows($query_c);	
		return $count;
	}
	
	/**
	 * Return a contact's details
	 * */
	function get_contactDetails($contactId){
		$details = "SELECT * FROM `contact` where contactId='$contactId'";
		$query_c = mysql_query($details) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$data = array();
		$fname = $result['firstName'];
		$lname = $result['lastName'];
		$number = $result['phoneNumber'];
		//store the data in an array
		array_push($data, $fname);
		array_push($data, $lname);
		array_push($data, $number);
		return $data;
	}
	
	/**
	 * Return a drug's details
	 * */
	function get_drugDetails($drugId){
		$details = "SELECT * FROM `drug` where drugId='$drugId'";
		$query_c = mysql_query($details) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$data = array();
		$name = $result['drugName'];
		$description = $result['drugDescription'];
		
		//store the data in an array
		array_push($data, $name);
		array_push($data, $description);
		
		return $data;
	}
	
	/**
	 * Return a clinic's details
	 * */
	function get_clinicDetails($clinicId){
		$details = "SELECT * FROM `clinic` where clinicId='$clinicId'";
		$query_c = mysql_query($details) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$data = array();
		$name = $result['clinicName'];
		$address = $result['address'];
	
		//store the data in an array
		array_push($data, $name);
		array_push($data, $address);
	
		return $data;
	}
	
	/**
	 * Return array of selected numbers from a multiple select tag
	 * */
	function get_selectedContacts($contactlist){
		$contacts= explode(",",$contactlist);
		$contact_ids = array();
		$i = 0;
		while($i < count($contacts)){
			array_push($contact_ids, $contacts[$i]);
			$i++;
		}
		
		$j=0;
		$numbers = array();
		while($j < count($contact_ids)){
			$data = get_contactDetails($contact_ids[$j]);
			array_push($numbers, $data[2]);
			$j++;
		}
		
		return $numbers;
	}
	
	/**
	 * return the amount to be paid for each sms
	 * */
	function get_sms_price(){
	$select_policy ="select amount,
		case
		WHEN now() < startDate THEN 'tobenewrate'
		WHEN now() > startDate THEN 'current'
		else 0
		end as validity
		from `pricing_policy`
		order by policyId desc LIMIT 1";
		$query_policy = mysql_query($select_policy) or die("cannot select data". mysql_error());
			while($result =mysql_fetch_array($query_policy, MYSQL_ASSOC))
				{
				$amount = $result['amount'];
				$validity = $result['validity'];			
					if($validity=='current'){
						$rate = $amount;
					}else{
						$rate = $amount;
						}				
				}
		return $rate;
	}
	
	/**
	 * function to cross-check the credit status of the user before a message is sent.
	 * */
	function update_account($clientId, $noOfMessages){
		$balance = count_balance($clientId);
		$fee = get_sms_price();
		$cost = $noOfMessages*$fee;
		$query="UPDATE `account` SET accountBalance=(accountBalance-$cost) where clientId='$clientId'";
		$res=mysql_query($query);
		if($res){
			$updated=true;
		}else{
			$updated=false;
		}
		return $updated;
	}
	
	/**
	 * function to determine the number of people allowed to receive a message depending on the user's account balance 
	 * */
	function determine_receivers($clientId, $noOfMessages){
		$balance = count_balance($clientId);
		$fee = get_sms_price();
		$credible_messages = $balance/$fee;
		$max = floor($credible_messages);
		
		if($noOfMessages > $max){
			$noOfMessages = $max; //reset the number to maximum
		}else if ($max == 0){
			$noOfMessages = 0;
		}
		
		return $noOfMessages;
	}
	
	/**
	 * check_user_in_group checks if the user already exists in a group
	 * */
	function check_user_in_group($contact,$group){
		$select="select * from `groupmember` where contactId='$contact' AND groupId='$group'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$count = mysql_num_rows($query_c);	
		return $count;
	}
	
	/**
	 * Return a contact's details
	 * */
	function get_groupContacts($groupId){
		$details = "select * from `contact` c,`groupmember` g where c.contactId=g.contactId and g.groupId='$groupId'";
		$query_c = mysql_query($details) or die("cannot select data" . mysql_error());		
		$data = array();
		while($result = mysql_fetch_array($query_c, MYSQL_ASSOC)){
			$number = $result['phoneNumber'];
			array_push($data, $number);
		}
		return $data;
	}
	
	/**
	 * return the contact's firstname
	 * */
	function firstname($number,$clientId){
		$select="select firstName from `contact` where clientId='$clientId' and phoneNumber='$number'";
		$query_c = mysql_query($select) or die("cannot select data" . mysql_error());
		$result = mysql_fetch_array($query_c, MYSQL_ASSOC);
		$name = $result['firstName'];
		return $name;
	}
?>