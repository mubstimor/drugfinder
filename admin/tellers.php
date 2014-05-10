<?php
include("../include/config.php");   
	$select= "SELECT * FROM bank_teller";

	$query = mysql_query($select) or die("cannot select data". mysql_error());	
	while($result =mysql_fetch_array($query, MYSQL_ASSOC))
	{
	echo "<tr><td>".$result['firstName']." ".$result['lastName']."</td>" ."<td class='center'>". $result['registrationDate']."</td> <td class='center'>".$result['village']."</td><td class='center'>".$result['phoneNumber']."</td>";
	echo "<td class='center'><a class='btn btn-success' href='#?id=".$result['tellerId']. "'><i class='icon-zoom-in icon-white'></i>View</a> ";
	echo "<a class='btn btn-info' href='#?id=".$result['tellerId']. "'><i class='icon-edit icon-white'></i>Edit</a> ";
	echo "<a class='btn btn-danger btn-setting' href='#?id=".$result['tellerId']. "'><i class='icon-trash icon-white'></i>Delete</a>";
	echo "</td></tr>";

	}

?>