<?php
// Include the database connection file
include '../api/connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_shift'])) {
    // Retrieve form data
    $shift_number = $_POST['shift_number'];
    $shift_date = $_POST['shift_date'];
    $created_at = date("Y-m-d H:i:s"); // Automatically set the current date and time

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO shifts (shift_number, shift_date, created_at) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $shift_number, $shift_date, $created_at);

        if ($stmt->execute()) {
            echo "<script>alert('Shift added successfully');</script>";
        } else {
            echo "<script>alert('Error adding shift: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Failed to prepare the SQL statement');</script>";
    }

    // Close the database connection
    $conn->close();

    // Redirect to the same page to prevent form resubmission
    header("Location: shift_setup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Shift Setup</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php"><h1>SHIFT SETUP</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../pages/dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../pages/schedule.php">Shift Tracking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form for adding shifts -->
    <div class="container mt-5">
        <form method="POST" action="shift_setup.php" class="border p-4 rounded shadow">
            <h3 class="text-center mb-4">Add Shift</h3>
            <div class="mb-3">
                <label for="shift_number" class="form-label">
                    <i class="bi bi-person"></i> Shift Number:
                </label>
                <input type="text" name="shift_number" id="shift_number" class="form-control" placeholder="Shift Number" required>
            </div>
            <div class="mb-3">
                <label for="shift_date" class="form-label">Shift Date:</label>
                <input type="date" name="shift_date" id="shift_date" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" name="add_shift" class="btn btn-primary">
                    <i class="bi bi-person-add"></i> Submit
                </button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
