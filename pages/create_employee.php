<?php
include '../api/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_name = $_POST['employee_name'];
    $employee_number = $_POST['employee_number'];
    $employee_role = $_POST['employee_role'];
    $skillset = $_POST['skillset'];
    $employee_availability = isset($_POST['employee_availability']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO employees (employee_name, employee_number, employee_role, skillset, employee_availability) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $employee_name, $employee_number, $employee_role, $skillset, $employee_availability);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Employee added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create New Employee</h2>
    <form method="POST" action="create_employee.php">
        <div class="form-group">
            <label for="employee_name">Full Name</label>
            <input type="text" id="employee_name" name="employee_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="employee_number">Employee Number</label>
            <input type="text" id="employee_number" name="employee_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="employee_role">Role</label>
            <input type="text" id="employee_role" name="employee_role" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="skillset">Skillset</label>
            <input type="text" id="skillset" name="skillset" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="employee_availability">Availability</label>
            <input type="checkbox" id="employee_availability" name="employee_availability" class="form-check-input">
            <label for="employee_availability" class="form-check-label">Available</label>
        </div>
        <button type="submit" class="btn btn-primary">Create Employee</button>
    </form>
</div>

<!-- Bootstrap 5 JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
