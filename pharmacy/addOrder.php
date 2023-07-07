<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get data
    $clientId = isset($_POST['clientId']) ? $_POST['clientId'] : "";
    $dateOfOrder = isset($_POST['dateOfOrder']) ? $_POST['dateOfOrder'] : "";
    $state = isset($_POST['state']) ? $_POST['state'] : "";

    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";
    $response = array();

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "insert into ordertable(clientId, dateOfOrder, state) values ('" . $clientId . "','" . $dateOfOrder . "','" . $state . "')";
    if ($conn->query($sql) === TRUE) {
        $response['error'] = false;
        $response['message'] = "Medicine added successfully!";
        $response['orderId'] = $conn->insert_id;
    } else {
        $response['error'] = true;
        $response['message'] = "Error, " . $conn->error;

    }
    echo json_encode($response);

    $conn->close();

}


?>