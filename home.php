<?php
session_start();
 include 'connection.php';

 try {
    // Fetch total tonnage
    $tonnage_query = $conn->query("SELECT SUM(total_weight) AS total_tonnage FROM production_jobs WHERE status='complete'");
    if ($tonnage_query) {
        $tonnage = $tonnage_query->fetch(PDO::FETCH_ASSOC);
        echo "Total Tonnage: " . ($tonnage['total_tonnage'] ?? 'No data found') . "<br>";
    } else {
        throw new Exception("Error fetching total tonnage: " . implode(", ", $conn->errorInfo()));
    }

    // Fetch number of production jobs
    $production_count_query = $conn->query("SELECT COUNT(*) AS production_count FROM production_jobs");
    if ($production_count_query) {
        $production_count = $production_count_query->fetch(PDO::FETCH_ASSOC);
        echo "Production Count: " . ($production_count['production_count'] ?? 'No data found') . "<br>";
    } else {
        throw new Exception("Error fetching production count: " . implode(", ", $conn->errorInfo()));
    }

    // Fetch number of running machines
    $running_machines_query = $conn->query("SELECT COUNT(*) AS running_machines FROM machines WHERE status='running'");
    if ($running_machines_query) {
        $running_machines = $running_machines_query->fetch(PDO::FETCH_ASSOC);
        echo "Running Machines: " . ($running_machines['running_machines'] ?? 'No data found') . "<br>";
    } else {
        throw new Exception("Error fetching running machines: " . implode(", ", $conn->errorInfo()));
    }

    // Fetch scheduled shifts
    $shifts_query = $conn->query("SELECT COUNT(*) AS shift_count FROM shifts");
    if ($shifts_query) {
        $shift_count = $shifts_query->fetch(PDO::FETCH_ASSOC);
        echo "Scheduled Shifts: " . ($shift_count['shift_count'] ?? 'No data found') . "<br>";
    } else {
        throw new Exception("Error fetching scheduled shifts: " . implode(", ", $conn->errorInfo()));
    }

} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Dashboard</title>
   </head>



   <body>


    <!--Top navigation bar -->
    <div class="topnav">
        <a href ="home.php">Home</a>
        <a href ="index.php">Sign Out</a>
    </div>

     <!--left navigation bar -->

     <div class ="sidenav">
        <li class="menu-title">MENU</li>
        <li class="menu-list">
            <a href="dashboard.php">Dashboard</a>
        </li>
        <li>
            <a href="production.php">Production</a>
        </li>
        <li>
            <a href="shedule.php">Production</a>
        </li>
        <li>
            <a href="setup.php">Production</a>
        </li>   
     </div>

   </body>
</html>
