<?php
// get_raw_materials.php - API endpoint to fetch raw materials
header("Content-Type: application/json");
require 'connection.php'; // Include database connection

$sql = "SELECT material_id, material, material_weight FROM raw_materials";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $raw_materials = [];
    while ($row = $result->fetch_assoc()) {
        $raw_materials[] = $row;
    }
    echo json_encode($raw_materials);
} else {
    echo json_encode(["message" => "No raw materials found"]);
}

// Close the connection
$conn->close();
?>