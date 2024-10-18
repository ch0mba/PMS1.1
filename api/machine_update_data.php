<?php
// Include your DB connection
include 'connection.php';

// Get the data from the POST request

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$machine_number = $data['machine_number'];
$status = $data['status'];

//Validate input (this is important for security)
if (!empty($id) && !empty($machine_number) && !empty($status)) {
    // Prepare the SQL query for updating the machine data
    $sql = "UPDATE machines SET machine_number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $machine_number, $status, $id);
    // 'ssi' stands for two strings (machine_number, status) and on integer (id)
    
    if($stmt->execute()){
        echo json_encode(["success" => true]);

    } else {
        echo json_encode(["succes" => false, "error" => "Database error:" . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "erro" => "invalid input"]);
}

$conn->close();

