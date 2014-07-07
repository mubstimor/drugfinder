<?php
 
// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/DB_Connect.php';

// connecting to db
$db = new DB_Connect();

if (isset($_GET["store"])) {
	$store = $_GET['store'];

$result = mysql_query("select * from drug d inner join clinic_drug cd on d.drugId=cd.drugId and cd.availability='Available' and cd.clinicId='$store'") or die(mysql_error());
 
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

	} else {
		//required field is missing
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing";
	
		// echoing JSON response
		echo json_encode($response);
	}
?>