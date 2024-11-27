<?php
session_start(); // Start the session

include '../api/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $conn->real_escape_string($_POST['job_id']);
    $item_number = $conn->real_escape_string($_POST['item_number']);
    $item_weight = $conn->real_escape_string($_POST['item_weight']);

    // Fetch the quantity specified for the job
    $jobQuery = $conn->query("SELECT qty_make FROM production_jobs WHERE id = '$job_id'");
    $jobData = $jobQuery->fetch_assoc();
    $qty_make = $jobData['qty_make'];

    // Validate if the item_number exceeds the qty_make
    if ($item_number > $qty_make) {
        $_SESSION['error_message'] = "Error: Item Number exceeds production quantity for Job #$job_id.";
        header('Location: track_production.php'); // Redirect to track_production.php after error
        exit;
    } else {
        // Count already logged items for the job
        $loggedItemsQuery = $conn->query("SELECT COUNT(*) AS logged_count FROM production_details WHERE job_id = '$job_id'");
        $loggedData = $loggedItemsQuery->fetch_assoc();
        $logged_count = $loggedData['logged_count'];

        // Validate that the new item does not exceed the quantity
        if ($logged_count >= $qty_make) {
            $_SESSION['error_message'] = "Error: All items for Job #$job_id have already been logged.";
            header('Location: ../pages/track_job.php'); // Redirect to track_production.php after error
            exit;
        } else {
            // Check if the item_number has already been logged for this job
            $duplicateCheckQuery = $conn->query("SELECT COUNT(*) AS duplicate_count FROM production_details WHERE job_id = '$job_id' AND item_number = '$item_number'");
            $duplicateCheckData = $duplicateCheckQuery->fetch_assoc();
            $duplicate_count = $duplicateCheckData['duplicate_count'];

            if ($duplicate_count > 0) {
                $_SESSION['error_message'] = "Error: Item Number $item_number has already been logged for Job #$job_id.";
                header('Location: ../pages/track_job.php'); // Redirect to track_production.php after error
                exit;
            } else {
                // Log the item
                $insertQuery = "INSERT INTO production_details (job_id, item_number, item_weight, created_at) VALUES ('$job_id', '$item_number', '$item_weight', NOW())";

                if ($conn->query($insertQuery)) {
                    $_SESSION['success_message'] = "Item logged successfully!";
                } else {
                    $_SESSION['error_message'] = "Error: " . $conn->error;
                }
                // Redirect to track_job.php (not track_production.php)
                header('Location: ../pages/track_job.php'); // Redirect after success
                exit;
            }
        }
    }
}



