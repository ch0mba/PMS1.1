<?php include '../api/material_api.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>RAW Material Setup</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php"><h1>RAW MATERIAL SETUP</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../pages/dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../pages/schedule.php">Job Tracking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Display Messages -->
    <div class="container mt-3">
        <?php if (!empty($message)): ?>
            <div id="alert-message" class="alert alert-<?= $message_type ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Form for adding shifts -->
    <div class="container mt-5">
        <form method="POST" action="material_setup.php" class="border p-4 rounded shadow">
            <h3 class="text-center mb-4">Add Material</h3>
            <div class="mb-3">
                <label for="shift_number" class="form-label">
                    <i class="bi bi-person"></i> Material Name:
                </label>
                <input type="text" name="material" id="material" class="form-control" placeholder="Raw Material" required>
            </div>
            <div class="mb-3">
                <label for="material_weight" class="form-label">Material Weight:</label>
                <input type="number" name="material_weight" id="material_weight" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" name="add_raw_material" class="btn btn-primary">
                    <i class="bi bi-person-add"></i> Submit
                </button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
