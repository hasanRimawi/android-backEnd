<?php

    $id = "";
	if(isset($_GET['orderId'])){
		$id = $_GET['orderId'];
	}
	if(!empty($id)){
		$server_name = "localhost";
		$username = "root";
		$password = "";
		$dbname = "khadb";
		
		$conn = new mysqli($server_name, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
        $sql = "SELECT m.name, m.image, p.quantity, m.price
        FROM medicine m, ordertable o, productorder p
        WHERE o.id = '" . $id . "'
          AND p.orderId = '" . $id . "'
          AND p.medicineId = m.id
        GROUP BY o.id
        ORDER BY o.id";
    $result = $conn->query($sql);
    $resultarray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $resultarray[] = $row;
    }
    echo json_encode($resultarray);

    $conn->close();
		
	}
?>