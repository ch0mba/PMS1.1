<?php
include 'connection.php';

//get the data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$authCode = $data['authCode'];

//verify that the authorization code  is correct

if(!empty($authCode)){

    //Assume we hava a valid session or another logic for generating/verifying auth codes
    // For now, we just proceed with the deletion assuming the frontend handled the correct auth code generation.

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if($stmt->execute()) {
        echo json_encode(["success" => true]);

    } else {
        echo json_encode(["success" => false, "error" => "Database error:" . $stmt->error]);

    }

    $stmt->close();

} else {
    // if the authorization code is missing, reject the request
    echo json_encode(["success" => false, "error" => "invalid authorization code."]);
}

$conn->close();


