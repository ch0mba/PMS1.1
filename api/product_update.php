<?php
// Include your DB connection
include 'connection.php';

// Get the data from the POST request

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$stockcode = $data['stockcode'];
$actual_weight = $data['actual_weight'];
$weight_per_meter = $data['weight_per_meter'];
$length = $data['length'];
$pressure_rate = $data['pressure_rate'];

//Validate input (this is important for security)
if (!empty($id) && !empty($stockcode) && !empty($actual_weight) && !empty($weight_per_meter) && !empty($length) && !empty($pressure_rate)) {
    // Prepare the SQL query for updating the product data
    $sql = "UPDATE products SET stockcode = ?, actual_weight = ?,  weight_per_meter = ?, length= ?, pressure_rate = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdddii', $stockcode, $actual_weight, $weight_per_meter, $length, $pressure_rate, $id);
    // 'ssssii' stands for two strings (stockcode, actual_weight,weight per meter,length,pressure rate) and on integer (id)
    
    if($stmt->execute()){
        echo json_encode(["success" => true]);

    } else {
        echo json_encode(["succes" => false, "error" => "Database error:" . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "invalid input"]);
}

$conn->close();

