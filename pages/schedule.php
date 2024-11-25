<?php
    
    
include '../api/connection.php';
// Include the PHP file for fetching dropdown data
include '../api/dropdown_data.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Schedule Jobs</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h1 class="fs-3 fw-bold text-white">SCHEDULE JOBS</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/dashboard.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/track_job.php">Job Tracking</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3 vh-100">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/track_job.php"><i class="bi bi-gear"></i> Job Tracking</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/schedule.php"><i class="bi bi-calendar-check"></i> Schedule Job</a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="main-content" id="main-content">
                    <h2 class="text-center my-4 fw-bold">Schedule Production Job</h2>

                    <form class="container-fluid form" action="../api/dropdown_data.php" method="POST">
                        <!-- Machines Dropdown -->
                        <div class="mb-3">
                            <label for="machine" class="form-label">Select Machine:</label>
                            <select name="machine_id" id="machine" class="form-select" required>
                                <option value="">-- Select Machine --</option>
                                <?php
                                if ($machinesResult) {
                                    while ($row = $machinesResult->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['machine_number']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Products Dropdown -->
                        <div class="mb-3">
                            <label for="stockcode" class="form-label">Select Production Stockcode:</label>
                            <select name="stockcode" id="stockcode" class="form-select" required>
                                <option value="">-- Select Stockcode --</option>
                                <?php
                                if ($productsResult) {
                                    while ($row = $productsResult->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['stockcode']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Quantity Input -->
                        <div class="mb-3">
                            <label for="qty_make" class="form-label">Quantity to Produce:</label>
                            <input type="number" name="qty_make" id="qty_make" class="form-control" step="1" required>
                        </div>

                        <!-- Shifts Dropdown -->
                        <div class="mb-3">
                            <label for="shift" class="form-label">Select Shift:</label>
                            <select name="shift_id" id="shift" class="form-select" required>
                                <option ></option> Select Shift </option>
                                <?php
                                if ($shiftsResult) {
                                    while ($row = $shiftsResult->fetch_assoc()) {
                                        echo "<option value='{$row['id']}'>{$row['shift_number']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Supervisors Dropdown -->
                        <div class="mb-3">
                            <label for="supervisor" class="form-label">Select Supervisor:</label>
                            <select name="supervisor_id" id="supervisor" class="form-select" required>
                                <option value="">-- Select Supervisor --</option>
                                <?php
                                    if ($supervisorsResult) {
                                        while ($row = $supervisorsResult->fetch_assoc()) {
                                            $supervisorId = htmlspecialchars(trim($row['supervisor_id']));
                                            $firstName = htmlspecialchars(trim($row['first_name']));
                                            $lastName = htmlspecialchars(trim($row['last_name']));
                                            echo "<option value='{$row['id']}'> {$supervisorId} {$firstName} {$lastName}</option>";
                                        }
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check"></i> Schedule Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
