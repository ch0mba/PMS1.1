<?php
include '../api/connection.php';

// Initialize drivers array
$products = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Capture form data
  $product_description = $_POST['product_description'];
  $stock_code = $_POST['stock_code'];
  $product = $_POST['product'];
  $unit_of_measure = $_POST['unit_of_measure'];
  $metres = $_POST['metres'];
  $weight_per_metre = $_POST['weight_per_metre'];

  // Insert data into the database
  $stmt = $conn->prepare("INSERT INTO inventorys (product_description, stock_code, product, unit_of_measure, metres, weight_per_metre) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $product_description, $stock_code, $product, $unit_of_measure, $metres, $weight_per_metre);

  if ($stmt->execute()) {
      // On success, add a JavaScript script for redirection
      echo "<script type='text/javascript'>
              window.onload = function() {
                  window.location.href = 'inventory.php'; // redirect to load_trip.php
              }
            </script>";
  } else {
      echo "Failed: " . $stmt->error; // Show error if insert fails
  }

  $stmt->close();
}

// Fetch registered inventory
$result = $conn->query("SELECT * FROM inventorys");
if ($result) {
  $inventorys = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>