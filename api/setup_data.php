<?php
include '../pages/connection.php';

// Adding new data (existing functionality)
if (isset($_POST['add_machine'])) {
    $machine_number = $_POST['machine_number'];
    $sql = "INSERT INTO machines (machine_number) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$machine_number);
    header('Location: ../pages/machinesetup.php');
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    exit();
}
// Updating existing data
if (isset($_POST['update_machine'])) {
    $machine_id = $_POST['machine_id'];
    $machine_name = $_POST['machine_name'];
    $sql = "UPDATE machines SET machine_number = ? WHERE id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header('Location: ../pages/setup.php');
    exit();
}

?>