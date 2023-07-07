<?php

	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// Get data
		$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
		$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : "";
        $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
        $myPassword= isset($_POST['passowrd']) ? $_POST['passowrd'] : "";
		

		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "khadb";
		$response  = array();
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "insert into client values (NULL, '" . $firstName . "','" . $lastName . "','" . $phoneNumber . "', '" . $email . "', '" . $myPassword . "')";
		if ($conn->query($sql) === TRUE) {
			$response['error'] = false;
			$response['message'] = "client added successfully!";
			$response['clientId'] = $conn->insert_id;
		} else {
			$response['error'] = true;
			$response['message'] = "Error, " . $conn->error;
			
		}
		echo json_encode($response);

		$conn->close();
	
	}


?>