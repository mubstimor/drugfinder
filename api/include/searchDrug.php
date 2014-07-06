<?php
 
// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/DB_Connect.php';

// connecting to db
$db = new DB_Connect();

// check for post data
if (isset($_GET["drug"])) {
	$drugName = $_GET['drug'];
	
	$query = "SELECT * FROM `drug` where drugName LIKE '%".$drugName."%' ";
	$result = mysql_query($query) or die(mysql_error());
	
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