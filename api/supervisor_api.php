<?php
// Include the database connection file
include '../api/connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supervisor'])) {
    // Retrieve form data
    $supervisor_id = $_POST['supervisor_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO supervisors (supervisor_id, first_name, last_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $supervisor_id, $first_name, $last_name);

        if ($stmt->execute()) {
            echo "<script>alert('Supervisor added successfully');</script>";
        } else {
            echo "<script>alert('Error adding supervisor: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare the SQL statement');</script>";
    }

    // Close the database connection
    $conn->close();

    // Redirect to the same page to prevent form resubmission
    header("Location: supervisor_setup.php");
    exit();
}
