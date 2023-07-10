<?php

	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// Get data
        $id = isset($_POST['id']) ? $_POST['id'] : "";
		$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
		$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : "";
        $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";
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
		
		// $sql = "insert into employee values (NULL, '" . $firstName . "','" . $lastName . "','" . $phoneNumber . "', '" . $email . "', '" . $myPassword . "')";
        $sql = "update client set firstName = '" . $firstName . "' , lastName = '" . $lastName . "', phoneNumber = '" . $phoneNumber . "'
        , passowrd = '" . $myPassword . "' where id = '" . $id . "'";
		if ($conn->query($sql) === TRUE) {
			$response['error'] = false;
			$response['message'] = "employee updated successfully!";
			$response['employeeId'] = $conn->insert_id;
		} else {
			$response['error'] = true;
			$response['message'] = "Error, " . $conn->error;
			
		}
		echo json_encode($response);

		$conn->close();
	
	}


?>