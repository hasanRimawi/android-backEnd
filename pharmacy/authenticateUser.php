<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $myPassword = isset($_POST['passowrd']) ? $_POST['passowrd'] : "";

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";
    $response = array();

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, firstName, lastName, phoneNumber, email, passowrd FROM client WHERE email = '" . $email . "' AND passowrd = '" . $myPassword . "'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the row
        $response['error'] = false;
        $response['message'] = "Client found!";
        $response['id'] = $row['id'];
        $response['firstName'] = $row['firstName'];
        $response['lastName'] = $row['lastName'];
        $response['phoneNumber'] = $row['phoneNumber'];
        $response['email'] = $row['email'];
        $response['passowrd'] = $row['passowrd'];
		$response['type'] = "client";
    } else {
        $sqll = "SELECT id, firstName, lastName, phoneNumber, email, passowrd FROM employee WHERE email = '" . $email . "' AND passowrd = '" . $myPassword . "'";
		$resultt = $conn->query($sqll);
		if ($resultt && $resultt->num_rows > 0) {
			$roww = $resultt->fetch_assoc(); // Fetch the row
			$response['error'] = false;
			$response['message'] = "Employee found!";
			$response['id'] = $roww['id'];
			$response['firstName'] = $roww['firstName'];
			$response['lastName'] = $roww['lastName'];
			$response['phoneNumber'] = $roww['phoneNumber'];
			$response['email'] = $roww['email'];
			$response['passowrd'] = $roww['passowrd'];
			$response['type'] = "employee";
		}
		else{
			$response['error'] = true;
			$response['message'] = "invalid email or password";
		}
    }

    echo json_encode($response);
    $conn->close();
}
?>
