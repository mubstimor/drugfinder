<?php
include("config.php");   
	$select="select p.paymentId,taxis.taxiId,numberplate,p.dateOfPayment as date,taxiowner.firstname as fname,taxiowner.lastname as lname,p.amount 
							from taxis,taxiowner,paymentsmade p 
							where taxis.ownerid= taxiowner.ownerid and taxis.taxiId=p.taxiId";

	$query = mysql_query($select) or die("cannot select data". mysql_error());	
	while($result =mysql_fetch_array($query, MYSQL_ASSOC))
	{
	echo "<tr><td>".$result['numberplate']."</td>" ."<td class='center'>". $result['fname']." ".$result['lname']."</td> <td class='center'>".$result['amount']."</td><td class='center'>".$result['date']."</td>";
	echo "</tr>";

	}

?>