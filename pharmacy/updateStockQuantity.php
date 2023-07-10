<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get data
    $stockId = isset($_POST['medicineId']) ? $_POST['medicineId'] : "";
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

    $sql = "UPDATE stock s
            SET quantity = CASE
                WHEN ? >= 0 THEN quantity + ?
                ELSE quantity - ABS(?)
                END
            WHERE s.medicineId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $newStockQuantity, $newStockQuantity, $newStockQuantity, $stockId);

    if ($stmt->execute()) {
        $response['error'] = false;
        $response['message'] = "Stock updated successfully!";
    } else {
        $response['error'] = true;
        $response['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();

    echo json_encode($response);

    $conn->close();
}
?>
