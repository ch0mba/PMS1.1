<?php
include 'connction.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $username = $_POST['username'];
    $newPassword = $_POST['password'];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $hashedPassword, $username);

    if ($stmt->execute()) {
        echo "Password reset successfully!";
    } else {
        echo "Failed to reset password. Please try again later.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
