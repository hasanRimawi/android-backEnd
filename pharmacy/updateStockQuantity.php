<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get data
    $stockId = isset($_POST['stockId']) ? $_POST['stockId'] : "";
    $newStockQuantity = isset($_POST['newStockQuantity']) ? $_POST['newStockQuantity'] : "";

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";
    $response = array();

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "update stock SET quantity = '" . $newStockQuantity . "' WHERE id = '" . $stockId . "'";
    if ($conn->query($sql) === TRUE) {
        $response['error'] = false;
        $response['message'] = "stock updated successfully!";
    } else {
        $response['error'] = true;
        $response['message'] = "Error, " . $conn->error;

    }
    echo json_encode($response);

    $conn->close();

}


?>