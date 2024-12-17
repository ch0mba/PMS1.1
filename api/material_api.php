<?php

include '../api/connection.php';

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_raw_material'])) {
    // Retrieve form data
    $material = $_POST['material'];
    $material_weight = $_POST['material_weight'];
    

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO raw_material (material, material_weight) VALUES ( ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $material, $material_weight);

        if ($stmt->execute()) {
            $message = "Raw Material added successfully.";
            $message_type = "success";
        } else {
            $message = "Error adding Materials: " . $stmt->error;
            $message_type = "danger";
        }

        $stmt->close();
    } else {
        $message = "Failed to prepare the SQL statement.";
        $message_type = "danger";
    }

    // Close the database connection
    $conn->close();
}
?>
