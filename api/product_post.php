<?php
include 'connection.php';

// Adding new data (existing functionality)
if (isset($_POST['add_product'])) {
    $stockcode = $_POST['stockcode'];
    $actual_weight = $_POST['actual_weight'];
    $weight_per_meter = $_POST['weight_per_meter'];
    $length = $_POST['length'];
    $pressure_rate = $_POST['pressure_rate'];

    $sql = "INSERT INTO products (stockcode,actual_weight,weight_per_meter,length,pressure_rate) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdddi',$stockcode,$actual_weight,$weight_per_meter,$length,$pressure_rate);
    header('Location: ../pages/product_setup.php');
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    exit();
}