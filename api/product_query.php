<?php

include '../api/connection.php';

//Query to fetch data

$sql = "SELECT id, stockcode, actual_weight, weight_per_meter, length, pressure_rate FROM products";
$result = $conn->query($sql);

//Check if there are results
if($result->num_rows > 0){
    $data = array();

    //Fetch the data as an associative array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return data as JSON
    echo json_encode($data);
}else {
    echo json_encode([]);
}
$conn->close();