<?php
include('config.php');
include('select_counts.php');
if($_POST['group'])
{
$group=$_POST['group'];
$clientId=$_POST['client'];

$grp_count = count_groupMembers($group);
$receivers = determine_receivers($clientId, $grp_count);

	if($receivers == 0){
		echo "Insufficient account balance";
	}else
	{
	echo $receivers." receivers";
	}

}else{
	echo "nothing found";
}
?>