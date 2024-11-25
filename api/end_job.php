<?php
session_start(); // Start the session

// Include the database connection file
include '../api/connection.php'; // Ensure the connection.php file connects to MySQL using MySQLi

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $job_id = $_POST['job_id'];
    $total_weight = $_POST['total_weight'];
    $manpower_used = $_POST['manpower_used'];
    $electricity_used = $_POST['electricity_used'];
    
    // SQL query to update the job with the current time (NOW()) as end_time
    $update_query = "UPDATE production_jobs 
                     SET total_weight = ?, manpower_used = ?, electricity_used = ?, end_time = NOW(), status = 'Completed'
                     WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($update_query)) {
        // Bind the parameters (i - integer, d - double, s - string)
        $stmt->bind_param("ddds", $total_weight, $manpower_used, $electricity_used, $job_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Set a success message in the session
            $_SESSION['success_message'] = "Job #$job_id has been marked as completed successfully!";
        } else {
            // Set an error message in the session
            $_SESSION['error_message'] = "There was an issue marking the job as completed. Please try again.";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle the case where the query preparation fails
        $_SESSION['error_message'] = "Failed to prepare the update query.";
    }

    // Redirect to the previous page (or a specific page where you want to show the result)
    header("Location: ../pages/track_job.php");
    exit();
}
?>
