<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css">
    <title>Machine Setup</title>
</head>
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

    <?php
    include 'connection.php';

    // Query to fetch machine data
    $query = "SELECT machine_number, status FROM machines";
    $result = $conn->query($query);

    if ($result === false) {
        echo "Error in executing query: ", $conn->error;
        exit;
    }

    // Display machine data in a table
    echo "<table border='1'>
        <tr>
            <th>Machine Number</th>
            <th>Status</th>
        </tr>";

    // Loop through the results and display them in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['machine_number'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";

    }

    echo "</table>";

    // Free the result set
    $result->free();
    
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>