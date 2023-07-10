<?php
$category = "";
$startingDate = "";
$endingDate = "";
if (isset($_GET['category'], $_GET['startingDate'], $_GET['endingDate'])) {
    $category = $_GET['category'];
    $startingDate = $_GET['startingDate'];
    $endingDate = $_GET['endingDate'];
}
if (!empty($category)) {
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khadb";

    $conn = new mysqli($server_name, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // $sql = "select p.sumPrice, o.dateOfOrder, o.id
    //     from medicine m, ordertable o, productorder p
    //     where p.medicineId = m.id and p.orderId = o.id and m.category = '" . $category . "' and o.dateOfOrder > '" . $startingDate . "' and o.dateOfOrder < '" . $endingDate . "' order by o.id ";
    $sql = "SELECT o.id, SUM(p.sumPrice) AS total_price, o.dateOfOrder
        FROM medicine m, ordertable o, productorder p
        WHERE p.medicineId = m.id
          AND p.orderId = o.id
          AND m.category = '" . $category . "'
          AND o.dateOfOrder >= '" . $startingDate . "'
          AND o.dateOfOrder <= '" . $endingDate . "'
        GROUP BY o.id, o.dateOfOrder
        ORDER BY o.id";
    $result = $conn->query($sql);
    $resultarray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $resultarray[] = $row;
    }
    echo json_encode($resultarray);

    $conn->close();

}
?>