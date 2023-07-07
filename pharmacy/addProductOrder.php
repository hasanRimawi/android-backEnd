<?php

	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// Get data
		$medicineId = isset($_POST['medicineId']) ? $_POST['medicineId'] : "";
		$orderId = isset($_POST['orderId']) ? $_POST['orderId'] : "";
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
		$sumPrice = isset($_POST['sumPrice']) ? $_POST['sumPrice'] : "";
		

		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "khadb";
		$response  = array();
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "insert into productorder values (NULL, '" . $medicineId . "','" . $orderId . "','" . $quantity . "', '" . $sumPrice . "')";
		if ($conn->query($sql) === TRUE) {
			$response['error'] = false;
			$response['message'] = "productOrder added successfully!";
			$response['productOrderId'] = $conn->insert_id;
		} else {
			$response['error'] = true;
			$response['message'] = "Error, " . $conn->error;
			
		}
		echo json_encode($response);

		$conn->close();
	
	}


?>