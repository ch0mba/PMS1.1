<!DOCTYPE html>
<?php include '../api/fetch.php' ?>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/dashboard.css">
    
    <title>Dashboard</title>
   </head>
   <!-- i have a gift for you🙆‍♂️-->


   <body>

   <div class="navbar" id ="sidebar">
    <!-- logo -->
        <div class="logo">
            <img src="../images/logo.png" alt="Company Logo">

        </div>


        <div class="links">
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
                    <ul>
                        <li><a href="production_report.php">Production Report</a></li>
                        <li><a href="Electrictyconsumption_report.php">Electricty Consumption</a></li>
                        <li><a href="machine_report.php">Machine Report</a></li>
                        <li><a href="scrap.php">Scrap Report</a></li>
                    </ul>
                
            </li>

            <!-- Setup -->
          <li>
                <a herf="">Setup</a>
                <ul>
                    <li><a href="machine_setup.php">Machine Setup</a></li>
                    <li><a href="product_setup.php">Product Setup</a></li>
                    <li><a href="supervisor_setup.php">Supervisor Setup</a></li>
                    <li><a href="shift_setup.php">Shit Setup</a></li>
                </ul>
            
            </li>

       </div>
    </div>

    <!-- Main content is displayed here -->
    <div class="main-content" id="main-content">
        <button id="toggle-btn">☰</button>
        <h1>PRODUCTION DASHBOARD</h1>

        <div class="container">

            <div class="box blue">
                <p>Total Tonnage: <?=$tonnage['total_tonnage']; ?> KG</p>
            </div> 

            <div class="box">
                <p>Production Jobs: <?=$production_count['production_count']; ?></p>
            </div>

            <div class="box">
                <p>Running machines: <?=$running_machines['running_machines']; ?></p>
            </div>
            
            <div class ="box">
            <p>Number of shifts: <?=$shift_count['shift_count']; ?></p>
            </div>
       </div>

        <script src="../scrips/toggle_btn.js"></script>

    </div>

<!-- Calendar to display shedule production jobs -->
     <div id="calendar"></div>

   </body>
   <!-- bootstarp bundle with proper-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>