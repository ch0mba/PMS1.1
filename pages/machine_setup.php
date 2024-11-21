<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Machine Setup</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h1 class="fs-3 fw-bold text-white">MACHINE SETUP</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="../pages/dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../pages/schedule.php">Job Tracking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                            <i class="bi bi-calendar-check"></i> Job Tracking
                        </a>
                    </li>
                    <!-- Additional sidebar items can go here -->
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Page Title -->
                <h1 class="text-center my-4 fw-bold">Machine Setup</h1>

                <!-- Form for adding machines -->
                <div class="card shadow p-4 mb-4">
                    <form action="../api/machine_post_data.php" method="POST">
                        <h3 class="text-center mb-4">Add Machine</h3>
                        <div class="mb-3">
                            <label for="machine_number" class="form-label">Machine Number:</label>
                            <input type="number" name="machine_number" id="machine_number" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="add_machine" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add Machine
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Machine Query Table -->
                <h2 class="text-center mb-4">Machine Query</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Machine Name</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="table_machine-body">
                            <!-- Rows will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to external JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/machine_fetch.js"></script>
    <script src="../scripts/machine_delete.js"></script>
</body>
</html>
