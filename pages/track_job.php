<?php
session_start(); // Start the session

if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger message-box'>" . $_SESSION['error_message'] . "</div>";
    unset($_SESSION['error_message']); // Unset the session message after displaying
}

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success message-box'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Unset the session message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Track Production Job</title>

    <style>
        /* Sidebar styles */
        .bg-dark {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px; /* Sidebar width */
            overflow-y: auto; /* Enable vertical scrolling for sidebar */
            z-index: 100; /* Keep the sidebar on top */
            padding-top: 20px; /* Optional: Adds padding on top */
        }

        /* Adjust the main content area to account for sidebar */
        .container-fluid {
            margin-left: 250px; /* Offset content to the right of the sidebar */
        }

        /* Main content */
        .col-md-10 {
            overflow-y: auto;
            padding-left: 30px; /* Adjust padding as needed */
        }

        /* Center top messages */
        .message-box {
            position: absolute;
            top: 20px;
            left: 60%;
            transform: translateX(-50%);
            width: 50%;
            z-index: 200;
        }

        /* Adjust for sticky sidebar scrolling */
        .nav-link {
            padding: 12px 16px;
        }

        /* Form for ending a job */
        .end-job-form {
            display: none;
        }

        .accordion-button::after {
            content: "\f0e7"; /* Unicode for a down arrow */
            font-family: "FontAwesome";
        }

        .accordion-button.collapsed::after {
            content: "\f0e8"; /* Unicode for an up arrow */
            font-family: "FontAwesome";
        }
    </style>
</head>
<body>
    <?php 
        include '../api/connection.php';
        include '../templates/header.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3">
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
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <div class="container my-5">
                    <h2 class="text-center mb-4">Track Production Job</h2>

                    <div class="card shadow p-4 mb-5">
                        <form action="../api/track_production.php" method="POST">
                            <div class="mb-3">
                            <label for="job_id" class="form-label">Select Job:</label>
                                <select name="job_id" id="job_id" class="form-select" required>
                                    <option value="">-- Select Job --</option>
                                    <?php
                                        // Query to fetch job and product details
                                        $query = "
                                            SELECT 
                                                pj.id AS id,
                                                pj.job_number,
                                                inv.product_description AS products
                                            FROM 
                                                production_jobs pj
                                            JOIN 
                                                inventorys inv
                                            ON 
                                                pj.product = inv.id -- Adjust this to match your schema
                                            WHERE 
                                                pj.status = 'in_progress'
                                        ";

                                        // Execute the query
                                        $jobs = $conn->query($query);

                                        // Loop through the results and create option elements
                                        while ($job = $jobs->fetch_assoc()) {
                                            echo "<option value='{$job['id']}'>Job {$job['id']} - {$job['products']}</option>";
                                        }
                                    ?>
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="item_number" class="form-label">Item Number:</label>
                                <input type="number" name="item_number" id="item_number" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="item_weight" class="form-label">Weight (KG):</label>
                                <input type="number" name="item_weight" id="item_weight" class="form-control" required>
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
                    <div class="accordion" id="jobsAccordion">
                    <?php
                            // Fetch job details, including job_id, quantity, and product description
                            $query = "
                                SELECT 
                                    pj.id AS job_id,
                                    pj.job_number,
                                    pj.qty_make,
                                    inv.product_description AS product
                                FROM 
                                    production_jobs pj
                                JOIN 
                                    inventorys inv
                                ON 
                                    pj.product = inv.id -- Adjust this to match your schema
                                WHERE 
                                    pj.status = 'in_progress'
                            ";

                            // Execute the query
                            $jobs = $conn->query($query);

                            // Loop through jobs to generate accordions
                            while ($job = $jobs->fetch_assoc()) {
                                $job_id = $job['job_id'];
                                $qty_make = $job['qty_make'];
                                $product = $job['product']; // Fetch the product description
                        ?>
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $job_id; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse<?php echo $job_id; ?>" 
                                        aria-expanded="true" aria-controls="collapse<?php echo $job_id; ?>">
                                    Job #<?php echo $job_id; ?> (Quantity: <?php echo $qty_make; ?>, Product: <?php echo $product; ?>)
                                </button>
                            </h2>
                                <div id="collapse<?php echo $job_id; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $job_id; ?>" data-bs-parent="#jobsAccordion">
                                    <div class="accordion-body">
                                        <table class="table table-striped table-bordered text-center">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Item Number</th>
                                                    <th>Weight (KG)</th>
                                                    <th>Date Logged</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $items = $conn->query("SELECT item_number, item_weight, created_at FROM production_details WHERE job_id = '$job_id'");
                                                    if ($items->num_rows > 0) {
                                                        while ($item = $items->fetch_assoc()) {
                                                            echo "
                                                                <tr>
                                                                    <td>{$item['item_number']}</td>
                                                                    <td>{$item['item_weight']}</td>
                                                                    <td>{$item['created_at']}</td>
                                                                </tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='3'>No items logged yet for this job.</td></tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>

                                        <!-- End Job Form (only appears once per job) -->
                                            <form action="../api/end_job.php" method="POST">
                                                <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                                <div class="mb-3">
                                                    <label for="total_weight" class="form-label">Total Weight (KG):</label>
                                                    <input type="number" name="total_weight" id="total_weight" class="form-control" value="0" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="manpower_used" class="form-label">Manpower Used:</label>
                                                    <input type="number" name="manpower_used" id="manpower_used" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="electricity_used" class="form-label">Electricity Used (KW):</label>
                                                    <input type="number" name="electricity_used" id="electricity_used" class="form-control" required>
                                                </div>

                                                

                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-check-circle"></i> End Job
                                                    </button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const jobAccordions = document.querySelectorAll('.accordion-item');

            jobAccordions.forEach((accordion) => {
                const totalWeightField = accordion.querySelector('input[name="total_weight"]');
                const rows = accordion.querySelectorAll('tbody tr');

                let totalWeight = 0;

                rows.forEach((row) => {
                    const weightCell = row.querySelector('td:nth-child(2)'); // Adjust column index for weight
                    if (weightCell) {
                        const weight = parseFloat(weightCell.textContent.trim());
                        if (!isNaN(weight)) {
                            totalWeight += weight;
                        }
                    }
                });

                if (totalWeightField) {
                    totalWeightField.value = totalWeight.toFixed(2); // Format total weight to 2 decimal places
                }                                                                                               
            });
        });

        
        const logItemForm = document.querySelector('form');
                logItemForm.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const formData = new FormData(logItemForm);
                    try {
                        const response = await fetch(logItemForm.action, { method: 'POST', body: formData });
                        const result = await response.json();
                        const alertBox = document.createElement('div');
                        alertBox.className = `alert alert-${result.success ? 'success' : 'danger'} message-box`;
                        alertBox.innerText = result.message;
                        document.body.appendChild(alertBox);

                        setTimeout(() => alertBox.remove(), 5000); // Remove message after 5 seconds
                    } catch (error) {
                        alert('Success.');
                    }
                });
                
                
                document.querySelector('form').addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent default form submission

    const form = event.target;
    const formData = new FormData(form);
    const jobId = document.getElementById('job_id').value;

    try {
        const response = await fetch(form.action, { method: 'POST', body: formData });
        const result = await response.json();

        if (result.success) {
            // Create a new row for the logged item
            const tableBody = document.querySelector(`#collapse${jobId} tbody`);
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${result.item_number}</td>
                <td>${result.item_weight}</td>
                <td>${result.created_at}</td>
            `;
            tableBody.appendChild(newRow);

            // Reset the form inputs
            form.reset();

            // Display success message
            displayMessage('success', result.message);
        } else {
            // Display error message
            displayMessage('danger', result.message);
        }
    } catch (error) {
        displayMessage('danger', 'An error occurred while logging the item.');
    }
});

// Function to display messages dynamically
function displayMessage(type, message) {
    const alertBox = document.createElement('div');
    alertBox.className = `alert alert-${type} message-box`;
    alertBox.innerText = message;
    document.body.appendChild(alertBox);

    // Remove the alert after 5 seconds
    setTimeout(() => alertBox.remove(), 5000);
}


    </script>
</script>
</body>
</html>
