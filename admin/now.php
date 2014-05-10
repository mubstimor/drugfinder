<?php 
//echo now();

date_default_timezone_set('Africa/Nairobi');
echo $date = date('m/d/Y h:i:s a', time());
$time = time();
echo "<br/>".$time;


echo "<br/>Object-O<br/>";
$now = new DateTime();
echo $now->format('Y-m-d H:i:s');    // MySQL datetime format



//<!-- whatif-->
 $now = new DateTime(null, new DateTimeZone('America/New_York'));
echo $now->format('Y-m-d H:i:s');
?>