<?php
include '../api/connection.php';

// Function to fetch data for a dropdown
function fetchDropdownData($conn, $query) {
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}

// Fetch machines
$machinesResult = fetchDropdownData($conn, "SELECT id, machine_number FROM machines");

// Fetch products
$productsResult = fetchDropdownData($conn, "SELECT id, stockcode FROM products");

// Fetch shifts
$shiftsResult = fetchDropdownData($conn, "SELECT id, shift_number FROM shifts");

// Fetch supervisors
$supervisorsResult = fetchDropdownData($conn, "SELECT id, supervisor_id, first_name, last_name FROM supervisors");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $machine_id = $conn->real_escape_string($_POST['machine_id']);
    $stockcode = $conn->real_escape_string($_POST['stockcode']);
    $qty_make = $conn->real_escape_string($_POST['qty_make']);
    $shift_id = $conn->real_escape_string($_POST['shift_id']);
    $supervisor_id = $conn->real_escape_string($_POST['supervisor_id']);
    
    // Validate inputs (optional)
    if (empty($machine_id) || empty($stockcode) || empty($qty_make) || empty($shift_id) || empty($supervisor_id)) {
        die("All fields are required.");
    }
    
    // Insert the data into the `scheduled_jobs` table
    $sql = "INSERT INTO production_jobs (machine_id, stockcode, qty_make, shift_id, supervisor_id, start_time)
            VALUES ('$machine_id', '$stockcode', '$qty_make', '$shift_id', '$supervisor_id', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job scheduled successfully!'); window.location.href='../pages/schedule.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='../pages/schedule.php';</script>";
    }
}

?>
