<?php

$server = "Localhost";
$user = "root";
$password = "";
$database = "drugfinder";

$dbc = mysql_connect($server,$user,$password) or
    die("Error Can't connect to Database.");

$db_selected = mysql_select_db($database, $dbc);
if (! $db_selected)
{
    die("There is a problem with selecting database.");
}
?>