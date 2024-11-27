<?php

include '../api/connection.php';

// Query to fetch data with category name
$sql = "SELECT 
            p.id, 
            p.stockcode, 
            p.actual_weight, 
            p.weight_per_meter, 
            p.length, 
            p.pressure_rate, 
            c.category_name AS category_name  -- Corrected to use 'category_name'
        FROM products p
        JOIN categories c ON p.category_id = c.id";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $data = array();

    // Fetch the data as an associative array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return data as JSON
    echo json_encode($data);
} else {
    echo json_encode([]);  // Return an empty array if no products are found
}

$conn->close();
