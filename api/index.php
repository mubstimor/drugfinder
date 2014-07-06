<?php

/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data

  /**
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);

    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_POST['name'];
        $email = $_POST['email'];
        $nok = $_POST['nok'];
        $nokContact = $_POST['nokContact'];		
        $password = $_POST['password'];

        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($name, $email, $nok, $nokContact, $password);
            if ($user) {
                // user stored successfully
                $response["success"] = 1;
                $response["uid"] = $user["unique_id"];
                $response["user"]["name"] = $user["name"];
                $response["user"]["email"] = $user["email"];
                $response["user"]["created_at"] = $user["created_at"];
                $response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    }
	else if ($tag == 'store_incident'){
        // Request type is Register new user
        $latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];        
        $category = $_POST['category'];
		$description = $_POST['description'];
        $userId= $_POST['user'];
		       
            // store crime
            $stored = $db->storeCrime($category,$description, $latitude, $longitude, $userId);
            if ($stored){
                // crime stored successfully
                $response["success"] = 1;
                echo json_encode($response);
            } else{
                // crime was not stored
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Storing crime";
                echo json_encode($response);
            }

            //send notification to police
            include_once '../GCM.php';
            $gcm = new GCM();
            $registation_ids = $db->get_registrationIds();
            if(strlen($description) > 20){
            	$message = "New case reported";
            }else{
            	$message = $description;	            	
            }
            $message = array("price" => $message);            
            $result = $gcm->send_notification($registation_ids, $message);         
      
    }
	else {
        echo "Invalid Request";
    }
} else {
    echo "Access Denied";
}
?>
