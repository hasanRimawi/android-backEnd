<?php
$id = "";
if(isset($_GET['productOrderId'])){
    $id = $_GET['productOrderId'];
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
    $sql = "DELETE FROM productorder WHERE id = '" . $id . "'";
    
    if ($conn->query($sql) === TRUE) {
        $response = array(
            'error' => false,
            'message' => "Record deleted successfully!"
        );
    } else {
        $response = array(
            'error' => true,
            'message' => "Error: " . $conn->error
        );
    }
    
    echo json_encode($response);
    
    $conn->close();
}
?>