<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Product Setup</title>
</head>
<body>
    
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h1>SHIFT SETUP</h1></a>
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
    <div class="container my-5">
    
    
        <h1 class="text-center mb-4">Product Setup</h1>

        <!-- Form for adding products -->
        <div class="card shadow p-4 mb-5">
            <form action="../api/product_post.php" method="POST" id="add_product">
                <h3 class="text-center mb-4">Add Product</h3>
                <div class="mb-3">
                    <label for="stockcode" class="form-label">Stock Code:</label>
                    <input type="text" name="stockcode" id="stockcode" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="actual_weight" class="form-label">Actual Weight:</label>
                    <input type="text" name="actual_weight" id="actualweight" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="weight_per_meter" class="form-label">Weight per Meter:</label>
                    <input type="text" name="weight_per_meter" id="weight_per_meter" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="length" class="form-label">Length:</label>
                    <input type="text" name="length" id="length" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="pressure_rate" class="form-label">Pressure Rating:</label>
                    <select name="pressure_rate" id="pressure_rate" class="form-select" required>
                        <option value="" disabled selected>Choose Pressure Rating</option>
                        <option value="10">PN10</option>
                        <option value="16">PN16</option>
                        <option value="20">PN20</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="add_product" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Product
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Product Table -->
        <h2 class="text-center mb-4">Product Query</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Stock Code</th>
                        <th>Actual Weight</th>
                        <th>Weight per Meter</th>
                        <th>Length (m)</th>
                        <th>Pressure Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table_product-body">
                    <!-- Rows will be populated here -->
                </tbody>
            </table>
        </div>

        <!-- Popup form for updating product -->
        <div id="update-form" class="card shadow p-4" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; max-width: 500px; z-index: 1050;">
            <h3 class="text-center mb-4">Update Product</h3>
            <form id="product-update-form">
                <input type="hidden" id="product-id">
                <div class="mb-3">
                    <label for="stockcode" class="form-label">Stock Code:</label>
                    <input type="text" id="stockcode" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="actual_weight" class="form-label">Actual Weight:</label>
                    <input type="number" id="actual_weight" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="weight_per_meter" class="form-label">Weight per Meter:</label>
                    <input type="number" id="weight_per_meter" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="length" class="form-label">Length:</label>
                    <input type="number" id="length" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="pressure_rate" class="form-label">Pressure Rate:</label>
                    <input type="number" id="pressure_rate" class="form-control">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success" onclick="submitUpdate()">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <button type="button" class="btn btn-danger" onclick="closePopup()">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
        <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/product_fetch.js"></script>
    <script src="../scripts/product_delete.js"></script>
</body>
</html>
