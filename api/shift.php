<?php

include '../api/connection.php';

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_shift'])) {
    // Retrieve form data
    $shift_number = $_POST['shift_number'];
    $shift_date = $_POST['shift_date'];
    $created_at = date("Y-m-d H:i:s"); // Automatically set the current date and time

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO shifts (shift_number, shift_date, created_at) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $shift_number, $shift_date, $created_at);

        if ($stmt->execute()) {
            $message = "Shift added successfully.";
            $message_type = "success";
        } else {
            $message = "Error adding shift: " . $stmt->error;
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
