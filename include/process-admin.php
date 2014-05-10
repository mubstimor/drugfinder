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

if(isset($_POST['village']) && !empty($_POST['village'])){
    $village =mysql_real_escape_string($_POST['village']);
}else{
    $message[]='Please Enter Village';
}

if(isset($_POST['username']) && !empty($_POST['username'])){
    $username = mysql_real_escape_string($_POST['username']);
}else{
    $message[]='Please Enter Username';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
    $password = mysql_real_escape_string($_POST['password']);
}else{
    $message[]='Please Enter Password';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/>';
     }
}else{

	 $password = md5($password);
    $query="INSERT INTO admin_login( firstname, lastname, email, telephone,village,userName,password) VALUES('$fname','$lname','$email','$phone','$village','$username','$password')";
    $res=mysql_query($query);    
    if($res > 0){
         echo 'inserted';
    }else{
         echo ucwords('failed to insert');
    }
	
	
}
?>

