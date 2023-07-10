<?php
	$id = "";
	if(isset($_GET['medicineId'])){
		$id = $_GET['medicineId'];
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
		$sql = "select * from stock m where m.medicineId = '" . $id . "'" ;
		
		$result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $resultobject = (object) $row;
        
        echo json_encode($resultobject);
        
        $conn->close();
		
	}
?>