<?php
include '../api/connection.php';

// Function to fetch data for dropdowns
function fetchDropdownData($conn, $query) {
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}

$machinesResult = fetchDropdownData($conn, "SELECT id, machine_number FROM machines WHERE status = 'stopped'");
// Fetch shifts
$shiftsResult = fetchDropdownData($conn, "SELECT id, shift_number FROM shifts");

// Fetch supervisors
$supervisorsResult = fetchDropdownData($conn, "SELECT id, supervisor_id, first_name, last_name FROM supervisors");



// Handle form submission for job scheduling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_job'])) {
    // Retrieve and sanitize form inputs
    $machine_id = $conn->real_escape_string($_POST['machine_id']);
    $product = $conn->real_escape_string($_POST['products']);
    $qty_make = $conn->real_escape_string($_POST['qty_make']);
    $expected_weight = $conn->real_escape_string($_POST['expected_weight']);
    $expected_scrap = $conn->real_escape_string($_POST['expected_scrap']);
    $shift_id = $conn->real_escape_string($_POST['shift_id']);
    $supervisor_id = $conn->real_escape_string($_POST['supervisor_id']);

    // Validate inputs
    if (empty($machine_id) || empty($product) || empty($expected_weight) || empty($expected_scrap)  || empty($qty_make) || empty($shift_id) || empty($supervisor_id)) {
        die("All fields are required.");
    }

    // Insert the data into the scheduled_jobs table
    $sql = "INSERT INTO production_jobs (machine_id,  product,  qty_make, expected_weight, expected_scrap, shift_id, supervisor_id, scheduled_date)
            VALUES ('$machine_id', '$product', '$qty_make', '$expected_weight', '$expected_scrap',  '$shift_id', '$supervisor_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Job scheduled successfully!'); window.location.href='../pages/schedule.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='../pages/schedule.php';</script>";
    }
}


$productOptions = '';
$sql = "SELECT 
            inventorys.id,    
            inventorys.product_description, 
            inventorys.stock_code, 
            inventorys.product, 
            inventorys.unit_of_measure, 
            inventorys.metres, 
            inventorys.weight_per_metre
        FROM inventorys";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productDisplay =  $row['product_description'] . ', ' . 
                            $row['stock_code'] . ', ' .  
                            $row['product'] . ', ' . 
                            $row['unit_of_measure'] . ', ' . 
                            $row['metres'] . ', ' . 
                            $row['weight_per_metre'];
        
        $productOptions .= '<option value="' . $row['id'] . '" data-metres="' . $row['metres'] . '" data-weight-per-metre="' . $row['weight_per_metre'] . '">' . $productDisplay . '</option>';
    }
} else {
    $productOptions = '<option value="" disabled>No products available</option>';
}
