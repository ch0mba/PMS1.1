<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <title>Machine Setup</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<?php
    include '../api/connection.php';
    ?>
<body>
    <h1>Machine Setup</h1>

    <!-- Form for adding machines -->
    <div class="form">
        <form action="../api/setup_data.php" method="POST">
            <h3>Add Machine</h3>
            <label for="machine_number">Machine Number:</label>
            <input type="number" name="machine_number" id="machine_number" required>
            <button type="submit" name="add_machine">Add Machine</button>
        </form>
    </div>

    
    <h1>Machine Query</h1>
    <table>
        <thead>
            <tr>
                <th>Machine Name</th>
                <th>Status</th>
                <th>update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Rows will be populated here -->
           
        </tbody>
    </table>
   
</body>
 <!-- Link to external JavaScript file -->
 <script src="../scripts/machine_fetch.js"></script>
    <script src="../scripts/machine_delete.js"></script>
</html>