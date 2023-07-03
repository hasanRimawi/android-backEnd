<?php	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
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
		
		$sql = "select * from employee e where e.email = '" . $email . "' and e.passowrd = '" . $myPassword . "' " ;
		
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $response['error'] = false;
            $response['message'] = "Employee found!";
        } else {
            $response['error'] = true;
            $response['message'] = "Invalid email or password.";
        }
        echo json_encode($response);
        $conn->close();
	}
?>