<?php
include('config.php');
if($_POST['group'])
{
$group=$_POST['group'];
$clientId=$_POST['client'];
$option='';
	$get_groups = mysql_query("select * from `contact` c,`groupmember` g where c.contactId=g.contactId and g.groupId !='$group' and c.clientId='$clientId'"); 
		while($p = mysql_fetch_assoc($get_groups)){
			$name = $p['firstName'].' '.$p['lastName'];
			$contact_id = $p['contactId'];
			$option .= "<option value='$contact_id'>$name</option>";
		}
		if(strlen($option) < 3){
			echo "<option value='00'>nothing found</option>";
		}else{
		echo $option;
		}
}else{
	echo "<option>nothing found</option>";
}
?>