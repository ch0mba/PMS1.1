<?php
session_start();
include 'connection.php'; // Include the connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the provided credentials are valid
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role']; // Assuming 'department' is a column in your 'users' table
            // Redirect to a success page or perform other actions
            header("Location: ../pages/dashboard.php");

            exit;
        } else {
            echo "Invalid username or password";
            header("Location: ../pages/index.php");
        }
    } else {
        echo "Invalid username or password";
        header("Location: ../pages/index.php");
     }
    $stmt->close();
}

$conn->close();
?>