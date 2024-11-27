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

    // Start a transaction to ensure both operations are completed atomically
    $conn->begin_transaction();

    try {
        // SQL query to update the job with the current time (NOW()) as end_time
        $update_query = "UPDATE production_jobs 
                         SET total_weight = ?, manpower_used = ?, electricity_used = ?, end_time = NOW(), status = 'Completed'
                         WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($update_query)) {
            // Bind the parameters (i - integer, d - double, s - string)
            $stmt->bind_param("ddds", $total_weight, $manpower_used, $electricity_used, $job_id);
            
            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Error updating job: " . $stmt->error);
            }
            
            // Close the prepared statement
            $stmt->close();
        } else {
            throw new Exception("Failed to prepare the update query.");
        }

        // Fetch the machine ID associated with the job
        $machine_query = "SELECT machine_id FROM production_jobs WHERE id = ?";
        if ($stmt = $conn->prepare($machine_query)) {
            $stmt->bind_param("d", $job_id);
            $stmt->execute();
            $stmt->bind_result($machine_id);
            $stmt->fetch();
            $stmt->close();
        } else {
            throw new Exception("Failed to fetch the machine ID.");
        }

        // Update the machine status to 'stopped'
        $update_machine_query = "UPDATE machines SET status = 'stopped' WHERE id = ?";
        if ($stmt = $conn->prepare($update_machine_query)) {
            $stmt->bind_param("d", $machine_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating machine status: " . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception("Failed to prepare the machine update query.");
        }

        // Commit the transaction
        $conn->commit();

        // Set a success message in the session
        $_SESSION['success_message'] = "Job #$job_id has been marked as completed, and the machine has been stopped successfully!";
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();

        // Set an error message in the session
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }

    // Redirect to the previous page (or a specific page where you want to show the result)
    header("Location: ../pages/track_job.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $conn->real_escape_string($_POST['job_id']);
    $total_weight = $conn->real_escape_string($_POST['total_weight']);
    $manpower_used = $conn->real_escape_string($_POST['manpower_used']);
    $electricity_used = $conn->real_escape_string($_POST['electricity_used']);

    $query = "UPDATE production_jobs 
              SET status = 'completed', total_weight = '$total_weight', manpower_used = '$manpower_used', electricity_used = '$electricity_used' 
              WHERE id = '$job_id'";

    if ($conn->query($query)) {
        $_SESSION['success_message'] = 'Job completed successfully.';
    } else {
        $_SESSION['error_message'] = 'Failed to complete job.';
    }
    header("Location: ../pages/track_production.php");
    exit();
}

