<?php

	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// Get data
		$name = isset($_POST['name']) ? $_POST['name'] : "";
		$category = isset($_POST['category']) ? $_POST['category'] : "";
        $expiryDate = isset($_POST['expiryDate']) ? $_POST['expiryDate'] : "";
		$prescription = isset($_POST['prescription']) ? $_POST['prescription'] : "";
        $routeOfAdministration = isset($_POST['routeOfAdministration']) ? $_POST['routeOfAdministration'] : "";
        $price = isset($_POST['price']) ? $_POST['price'] : "";
        $image = isset($_POST['image']) ? $_POST['image'] : "";
		

		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "khadb";
		$response  = array();
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "insert into medicine values (NULL, '" . $name . "','" . $category . "','" . $expiryDate . "', '" . $prescription . "', '" . $routeOfAdministration . "', '" . $price . "', '" . $image . "')";
		if ($conn->query($sql) === TRUE) {
			$response['error'] = false;
			$response['message'] = "Medicine added successfully!";
			$response['medicineId'] = $conn->insert_id;
		} else {
			$response['error'] = true;
			$response['message'] = "Error, " . $conn->error;
			
		}
		echo json_encode($response);

		$conn->close();
	
	}


?>