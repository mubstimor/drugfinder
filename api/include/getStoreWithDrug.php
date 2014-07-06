<?php
 
// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/DB_Connect.php';

// connecting to db
$db = new DB_Connect();

if (isset($_GET["drug"])) {
	$drugId = $_GET['drug'];
	
$result = mysql_query("select * from clinic c inner join clinic_drug cd on c.clinicId=cd.clinicId and cd.availability='Available' and c.license='Valid' where cd.drugId=$drugId") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
	
    // looping through all results    
    $response["stores"] = array();
    $response["success"] = 1;
    
    while ($row = mysql_fetch_array($result)) {
        // temp pdt array
        $product = array();
        $product["id"] = $row["clinicId"];
        $product["name"] = $row["clinicName"];
        $product["address"] = $row["address"];
        $product["phone"] = $row["contactNumber"];
		$product["latitude"] = $row["latitude"];
		$product["longitude"] = $row["longitude"];	
        array_push($response["stores"], $product);
    }
    
    // success
    echo json_encode($response);
    
} else
	{
		$response["success"] = 0;
		$response["message"] = "No drugs stores found";
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