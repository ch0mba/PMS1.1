<?php
session_start();
 include 'connection.php';

 include '../templates/header.php';

 try {
     // Fetch total tonnage
     $tonnage_query = $conn->query("SELECT SUM(total_weight) AS total_tonnage FROM production_jobs WHERE status='completed'");
     if ($tonnage_query) {
         $tonnage = $tonnage_query->fetch_assoc();  // MySQLi uses fetch_assoc() instead of fetch()
         echo "Total Tonnage: " . ($tonnage['total_tonnage'] ?? 'No data found') . " KG<br>";
     } else {
         throw new Exception("Error fetching total tonnage: " . $conn->error);
     }
 
     // Fetch number of production jobs
     $production_count_query = $conn->query("SELECT COUNT(*) AS production_count FROM production_jobs");
     if ($production_count_query) {
         $production_count = $production_count_query->fetch_assoc();
         echo "Production Jobs: " . ($production_count['production_count'] ?? 'No data found') . "<br>";
     } else {
         throw new Exception("Error fetching production count: " . $conn->error);
     }
 
     // Fetch number of running machines
     $running_machines_query = $conn->query("SELECT COUNT(*) AS running_machines FROM machines WHERE status='running'");
     if ($running_machines_query) {
         $running_machines = $running_machines_query->fetch_assoc();
         echo "Running Machines: " . ($running_machines['running_machines'] ?? 'No running machines') . "<br>";
     } else {
         throw new Exception("Error fetching running machines: " . $conn->error);
     }
 
     // Fetch number of shifts
     $shifts_query = $conn->query("SELECT COUNT(*) AS shift_count FROM shifts");
     if ($shifts_query) {
         $shift_count = $shifts_query->fetch_assoc();
         echo "Number of Shifts: " . ($shift_count['shift_count'] ?? 'No shifts scheduled') . "<br>";
     } else {
         throw new Exception("Error fetching shift count: " . $conn->error);
     }
     
     // Fetch electricity

 } catch (Exception $e) {
     echo "An error occurred: " . $e->getMessage();
 }

?>

<?php include '../templates/footer.php';?>