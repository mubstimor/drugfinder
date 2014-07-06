<?php
 
// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/DB_Connect.php';

// connecting to db
$db = new DB_Connect();

$result = mysql_query("SELECT * FROM `drug`") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
	
    // looping through all results    
    $response["drugs"] = array();
    $response["success"] = 1;
    
    while ($row = mysql_fetch_array($result)) {
        // temp pdt array
        $product = array();
        $product["id"] = $row["drugId"];
        $product["name"] = $row["drugName"];
		$product["description"] = $row["drugDescription"];
		$product["prescription"] = $row["prescription"];	
        array_push($response["drugs"], $product);
    }
    
    // success
    echo json_encode($response);
    
} else
	{
		$response["success"] = 0;
		$response["message"] = "No drugs found";
		echo json_encode($response);
		}
?>