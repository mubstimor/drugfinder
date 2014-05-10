<?php
session_start();

if(!isset($_SESSION['BANKER_STATUS'])){
	$loggedIn = 0;
 }else{
	$loggedIn = 1;
 }
 
 echo $loggedIn;
?>