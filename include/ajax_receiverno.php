<?php
include('config.php');
$sql='';
if($_POST['category'])
{
$category=$_POST['category'];

if($category=='1'){ /*those with debts*/
$sql = "select DISTINCT taxiowner.phonenumber, taxis.taxiId,numberplate,taxiowner.firstname as fname,taxiowner.lastname as lname,d.debtAmount
									from taxis,taxiowner,debt d 
									where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=d.taxiId AND d.debtAmount != '0'";
}else if($category=='2'){ /*those with cleared accounts*/
	$sql = "select DISTINCT taxiowner.phonenumber, taxis.taxiId,numberplate,taxiowner.firstname as fname,taxiowner.lastname as lname,d.debtAmount
									from taxis,taxiowner,debt d 
									where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=d.taxiId AND d.debtAmount = '0'";

}else if($category=='3'){ /*All taxi Owners*/
	$sql = "select DISTINCT taxiowner.phonenumber, taxiowner.firstname as fname,taxiowner.lastname as lname
									from taxiowner";

}else if($category=='4'){ /*All taxi Caretakers*/
	$sql = "select DISTINCT c.phonenumber, c.firstname as fname,c.lastname as lname
									from caretaker c";

}
else{
	$sql= "select DISTINCT taxiowner.phonenumber, taxiowner.firstname as fname,taxiowner.lastname as lname
									from taxiowner where length(phonenumber) <5";
}

$query = mysql_query($sql);
$num = mysql_num_rows($query);
$number=  $num." receiver(s)" ;
if($num != 0){
echo $number;
}else{
	echo "No valid receivers available,select another";
}
}
?>