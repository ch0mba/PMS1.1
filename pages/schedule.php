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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Schedule Jobs</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-section {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
            margin-bottom: 20px;
        }
        .bg-orange {
            background-color: #fd7e14;
            color: white;
        }
        .bg-orange:hover {
            background-color: #e66d0d;
        }
        .form-label {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid col-md-10">
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
            <div class="col-md-1 bg-dark text-white p-3 vh-100" style="position: fixed; overflow: hidden; top: 0; left: 0; z-index: 1030;">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/track_job.php"><i class="bi bi-gear"></i> Job Tracking</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../pages/schedule.php"><i class="bi bi-calendar-check"></i> Schedule Job</a></li>
                </ul>
            </div>
            <!-- Main Content -->
            <div class="container col-md-9">
                <div class="main-content" id="main-content">
                    <h2 class="text-center my-4 fw-bold">Schedule Production Job</h2>

                    <form method="POST" action="../api/dropdown_data.php">
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
                        

                        <div class="form-group">
                            <div>
                                <a href="inventory.php" class="btn btn-primary bg-orange">Add New Product</a>
                            </div>
                            <label for="product_search"><i class="fas fa-search"></i> Search Product</label>
                            <div class="input-group mb-2">
                                <input type="text" id="product_search" class="form-control" placeholder="Search Product by Stock Code" onkeyup="searchProduct()">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary search-button" type="button" onclick="searchProduct()"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <select id="id_product" name="products" class="form-control" onchange="productSelected()">
                                <option value="" disabled selected>Select a product</option>
                                <?php echo $productOptions; ?>
                            </select>
                        </div>

                        <!-- Quantity and Pipe MM -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="qty_make" class="form-label">Quantity to Produce:</label>
                                <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                <input type="int" name="qty_make" id="qty_make" class="form-control" placeholder="Quantity to Produce" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pipe_mm" class="form-label">Pipe MM:</label>
                                <span class="input-group-text"><i class="bi bi-rulers"></i></span>
                                <input type="int" name="pipe_mm" id="pipe_mm" class="form-control" placeholder="Pipe MM" required>
                            </div>
                        </div>

                        <!-- Wall Thickness and Ovality -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="wall_thickness" class="form-label">Wall Thickness:</label>
                                <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                <input type="int" name="wall_thickness" id="wall_thickness" class="form-control"  placeholder="Wall Thickness" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ovality" class="form-label">Ovality:</label>
                                <span class="input-group-text"><i class="bi bi-oval"></i></span>
                                <input type="int" name="ovality" id="ovality" class="form-control" placeholder="Ovality" required>
                            </div>
                        </div>

                        <!-- Marking and Required Length -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="mark_labelling" class="form-label">Marking/Labelling:</label>
                                <span class="input-group-text"><i class="fas fa-marker"></i></span>
                                <input type="text" name="mark_labelling" id="mark_labelling" class="form-control" placeholder="Marking/Labelling" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="required_length" class="form-label">Required Length:</label>
                                <span class="input-group-text"><i class="fas fa-ruler"></i></span>
                                <input type="int" name="required_length" id="required_length" class="form-control" placeholder="Required Length" required>
                            </div>
                        </div>

                        <!-- Expected Weight and Scrap -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expected_weight" class="form-label"> Expected Total Weight:</label>
                                <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                <input type="int" id="expected_weight" name="expected_weight" class="form-control" placeholder="Expected Total Weight" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expected_scrap" class="form-label">Expected Scrap:</label>
                                <span class="input-group-text"><i class="fas fa-recycle"></i></span>
                                <input type="int" name="expected_scrap" id="expected_scrap" class="form-control" placeholder="Expected Scrap" required>
                            </div>
                        </div>

                        <!-- Shift and Supervisor -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shift" class="form-label">Select Shift:</label>
                                <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                <select name="shift_id" id="shift" class="form-select" required>
                                    <option value="">-- Select Shift --</option>
                                    <?php
                                    if ($shiftsResult) {
                                        while ($row = $shiftsResult->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['shift_number']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="supervisor" class="form-label">Select Supervisor:</label>
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <select name="supervisor_id" id="supervisor" class="form-select" required>
                                    <option value="">-- Select Supervisor --</option>
                                    <?php
                                    if ($supervisorsResult) {
                                        while ($row = $supervisorsResult->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['supervisor_id']} {$row['first_name']} {$row['last_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                
                            <div class="form-section">
                                <label for="instructions" class="form-label">Notes:</label>
                                <textarea name="instructions" id="instructions" class="form-control" rows="3" placeholder="Special Instructions" required></textarea>
                            </div>
            
       

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="schedule_job" id="scheduleJobButton" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#assignRawMaterialsModal">
                                    <i class="bi bi-calendar-check"></i> Schedule Job
                                </button>
                            </div>
                    </form>
            </div>
    </div>
        
    

    <!-- Add the jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Function to search products based on input
    function searchProduct() {
        const input = document.getElementById('product_search').value.toLowerCase();
        const productSelect = document.getElementById('id_product');
        const options = productSelect.getElementsByTagName('option');

        for (let i = 0; i < options.length; i++) {
            const optionText = options[i].text.toLowerCase();

            if (optionText.includes(input)) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
    }

    // Function to calculate total weight when product is selected
    function productSelected() {
        calculateTotalWeight();
    }

    // Function to calculate total weight
    function calculateTotalWeight() {
        const productSelect = document.getElementById('id_product');
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const quantityInput = document.getElementById('qty_make');
        const totalWeightInput = document.getElementById('expected_weight');

        const weightPerMetre = parseFloat(selectedOption.dataset.weightPerMetre);
        const metres = parseFloat(selectedOption.dataset.metres);
        const quantity = parseInt(quantityInput.value) || 0;

        if (!isNaN(weightPerMetre) && !isNaN(metres) && quantity > 0) {
            const totalWeight = weightPerMetre * metres * quantity;
            totalWeightInput.value = totalWeight.toFixed(2);
        } else {
            totalWeightInput.value = '';
        }
    }

    // Update total weight when quantity changes
    document.getElementById('qty_make').addEventListener('input', calculateTotalWeight);
    </script>
</body>
</html>
