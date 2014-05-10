<?php
session_start();
include_once('config.php');
$message=array();
if(isset($_POST['amount']) && !empty($_POST['amount'])){
    $amount=mysql_real_escape_string($_POST['amount']);
}else{
    $message[]='Please enter Amount';
}

if(isset($_POST['date']) && !empty($_POST['date'])){
    $date=mysql_real_escape_string($_POST['date']);
}else{
    $message[]='Please enter Date';
}


$countError=count($message);

if($countError > 0){
     for($i=0;$i<$countError;$i++){
              echo ucwords($message[$i]).'<br/>';
     }
}else{

	$date =  date("Y-m-d", strtotime($date) );
	
    $query="INSERT INTO taxipolicy( Date,amount) VALUES('$date','$amount')";
    $res=mysql_query($query);    
    if($res > 0){
         echo 'inserted';
    }else{
         echo ucwords('failed to insert-> '.mysql_error());
    }
	
	
}
?>

