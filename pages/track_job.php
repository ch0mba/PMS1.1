<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Schedule Job</title>
</head>
<body>
    <?php 
        include '../api/connection.php';
        include '../templates/header.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3 vh-100">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/dashboard.php">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/machine_setup.php">
                            <i class="bi bi-gear"></i> Machine Setup
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/schedule.php">
                            <i class="bi bi-calendar-check"></i> Schedule Job
                        </a>
                    </li>
                    <!-- Additional sidebar items can go here -->
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="container my-5">
                    <!-- Page Title -->
                    <h2 class="text-center mb-4">Track Production Job</h2>

                    <!-- Form for logging production item -->
                    <div class="card shadow p-4 mb-5">
                        <form action="../api/track_production.php" method="POST">
                            <div class="mb-3">
                                <label for="job_id" class="form-label">Select Job:</label>
                                <select name="job_id" id="job_id" class="form-select" required>
                                    <?php
                                        $jobs = $conn->query("SELECT id, job_number FROM production_jobs WHERE status='in_progress'");
                                        while ($job = $jobs->fetch_assoc()) {
                                            echo "<option value='{$job['id']}'>Job #{$job['job_number']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="item_number" class="form-label">Item Number:</label>
                                <input type="number" name="item_number" id="item_number" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (KG):</label>
                                <input type="number" name="weight" id="weight" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload"></i> Log Item
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Section for displaying the logged production items -->
                    <h3 class="text-center mb-4">Logged Production Items</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Job Number</th>
                                    <th>Item Number</th>
                                    <th>Weight (KG)</th>
                                    <th>Date Logged</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $items = $conn->query("SELECT job_id, item_number, item_weight, created_at FROM production_details");
                                    while ($item = $items->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>Job #{$item['job_id']}</td>
                                            <td>{$item['item_number']}</td>
                                            <td>{$item['item_weight']}</td>
                                            <td>{$item['created_at']}</td>
                                        </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
