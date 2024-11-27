<?php
include 'connection.php';

// Adding new data (existing functionality)
if (isset($_POST['add_product'])) {
    $stockcode = $_POST['stockcode'];
    $actual_weight = $_POST['actual_weight'];
    $weight_per_meter = $_POST['weight_per_meter'];
    $length = $_POST['length'];
    $pressure_rate = $_POST['pressure_rate'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO products (stockcode,actual_weight,weight_per_meter,length,pressure_rate,  category_id) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdddii',$stockcode,$actual_weight,$weight_per_meter,$length,$pressure_rate,  $category_id);
    header('Location: ../pages/product_setup.php');
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    exit();
}


function getCategories($conn) {
    $query = "SELECT id, category_name FROM categories";
    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0) {
        return $result;
    } else {
        return [];
    }
}