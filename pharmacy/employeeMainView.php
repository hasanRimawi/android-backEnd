<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT o.id, SUM(p.sumPrice) AS total_price, o.dateOfOrder, c.firstName, c.lastName
        FROM medicine m, ordertable o, productorder p, client c
        WHERE  m.id = p.medicineId
          AND p.orderId = o.id
          AND o.clientId = c.id
          AND o.state = 0
        GROUP BY o.id
        ORDER BY o.id";
    $result = $conn->query($sql);
    $resultarray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $resultarray[] = $row;
    }
    echo json_encode($resultarray);

    $conn->close();
?>