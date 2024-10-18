<?php

use LDAP\Result;

include '../api/connection.php';

//Query to fetch data

$sql = "SELECT id, machine_number, status FROM machines";
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