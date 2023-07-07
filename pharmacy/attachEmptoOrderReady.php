<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get data
    $orderId = isset($_POST['orderId']) ? $_POST['orderId'] : "";
    $employeeId = isset($_POST['employeeId']) ? $_POST['employeeId'] : "";

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";
    $response = array();

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "update ordertable SET employeeId = '" . $employeeId . "', state = 1 WHERE id = '" . $orderId . "'";
    if ($conn->query($sql) === TRUE) {
        $response['error'] = false;
        $response['message'] = "order updated successfully!";
    } else {
        $response['error'] = true;
        $response['message'] = "Error, " . $conn->error;

    }
    echo json_encode($response);

    $conn->close();

}


?>