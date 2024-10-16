<!DOCTYPE html>
<?php include '../api/fetch.php' ?>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>Dashboard</title>
   </head>



   <body>

   <div class="navbar">
    <!-- logo -->
        <div class="logo">
            <img src="../images/logo.png" alt="Company Logo">

        </div>

        <ul>
        <!-- home link -->
        <li> <a href="dashboard.php">Home</a> </li>

        <!-- job shedule link -->
        <li><a href="schedule.php">Job Shedule</a></li>

        <!-- job trackng link -->
        <li><a href="track_job.php">Job Tracking</a></li>

        <!-- Report-->
        <li>
            <a herf="">Reports</a>
            <ul class="">
                <li><a href="production_report.php">Production Report</a></li>
                <li><a href="Electrictyconsumption_report.php">Electricty Consumption</a></li>
                <li><a href="machine_report.php">Machine Report</a></li>
                <li><a href="scrap.php">Scrap Report</a></li>
            </ul>
          
        </li>
        <!-- Setup -->
    `   <li>
            <a herf="">Setup</a>
            <ul class="links">
                <li><a href="machine_setup.php">Machine Setup</a></li>
                <li><a href="product_setup.php">Product Setup</a></li>
                <li><a href="supervisor_setup.php">Supervisor Setup</a></li>
                <li><a href="shift_setup.php">Shit Setup</a></li>
            </ul>
          
        </li>

        
   </div>

    <div class="main-content">
        <p>Total Tonnage: <?=$tonnage['total_tonnage']; ?> KG</p>
        <p>Production Jobs: <?=$production_count['production_count']; ?></p>
        <p>running_machines: <?=$running_machines['running_machines']; ?></p>
        <p>Number of shifts: <?=$shift_count['shift_count']; ?></p>
    </div>

<!-- Calendar to display shedule production jobs -->
     <div id="calendar"></div>

   </body>
</html>