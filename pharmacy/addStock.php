<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get data
    $medicineId = isset($_POST['medicineId']) ? $_POST['medicineId'] : "";
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";
    $response = array();

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "insert into stock values (NULL, '" . $medicineId . "','" . $quantity . "')";
    if ($conn->query($sql) === TRUE) {
        $response['error'] = false;
        $response['message'] = "Stock added successfully!";
        $response['stockId'] = $conn->insert_id;
    } else {
        $response['error'] = true;
        $response['message'] = "Error, " . $conn->error;

    }
    echo json_encode($response);

    $conn->close();

}


?>