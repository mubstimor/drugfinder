<?php
session_start();
include_once('../include/config.php');
$message=array();
if(isset($_POST['uname']) && !empty($_POST['uname'])){
    $uname=mysql_real_escape_string($_POST['uname']);
}else{
    $message[]='Please enter username';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
    $password=mysql_real_escape_string($_POST['password']);
}else{
    $message[]='Please enter password';
}

$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/>';
     }
}else{
	$password = md5($password);
    $query="select * from bank_teller where userName='$uname' and password='$password'";

    $res=mysql_query($query);
    $checkUser=mysql_num_rows($res);
    if($checkUser > 0){
         $_SESSION['BANKER_STATUS']=true;
         $_SESSION['UNAME']=$uname;
         echo 'correct';
		 
		 /*RETRIEVE USER'S ID FROM DATABASE*/
		 $selectd = "select * from bank_teller where userName='$uname'";
		 $queryd = mysql_query($selectd) or die("cannot select data" . mysql_error());
		 while ($result = mysql_fetch_array($queryd, MYSQL_ASSOC)) {
			$_SESSION['ADMINID']=$result['tellerId'];
			$_SESSION['BANKID']=$result['bankId'];
		 } 
		 
    }else{
         echo ucwords('please enter correct user details');
    }
}
?>

