<?php
session_start();
include_once('config.php');
$message=array();
if(isset($_POST['fname']) && !empty($_POST['fname'])){
    $fname=mysql_real_escape_string($_POST['fname']);
}else{
    $message[]='Please enter First Name';
}

if(isset($_POST['lname']) && !empty($_POST['lname'])){
    $lname=mysql_real_escape_string($_POST['lname']);
}else{
    $message[]='Please enter Last Name';
}

if(isset($_POST['gender']) && !empty($_POST['gender'])){
    $gender=mysql_real_escape_string($_POST['gender']);
}

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email=mysql_real_escape_string($_POST['email']);
}else{
    $message[]='Please enter Email address';
}

if(isset($_POST['phone']) && !empty($_POST['phone'])){
    $phone=mysql_real_escape_string($_POST['phone']);
}else{
    $message[]='Please enter Phone Number';
}

if(isset($_POST['division']) && !empty($_POST['division'])){
    $division=mysql_real_escape_string($_POST['division']);
}else{
    $message[]='Please Select Division';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/>';
     }
}else{

	if(isset($gender)){
	 //insert to table owners cuz this means request is from ADD OWNER
    $query="INSERT INTO taxiowner( firstname, lastname,gender, phonenumber,email,residence) VALUES('$fname','$lname','$gender','$phone','$email','$division')";
    $res=mysql_query($query);    
    if($res > 0){
         echo 'inserted';
    }else{
         echo ucwords('failed to insert');
    }
	
	}else{
		//insert to table caretakers cuz this means request is from ADD CARETAKER
	$query="INSERT INTO caretaker( firstname, lastname, phonenumber,email,residence) VALUES('$fname','$lname','$phone','$email','$division')";
    $res=mysql_query($query);    
    if($res > 0){
         echo 'inserted';
    }else{
         echo ucwords('failed to insert');
    }
	}
}
?>

