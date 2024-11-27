<!DOCTYPE html>
<?php include '../api/fetch.php' ?>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


       <!-- Sidebar Links -->
       <div class="links">
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="schedule.php">Job Schedule</a></li>
                <li><a href="track_job.php">Job Tracking</a></li>

                <li class="has-submenu">
                    <a href="#">Reports <span class="submenu-toggle">+</span></a>
                    <ul>
                        <li><a href="production_report.php">Production Report</a></li>
                        <li><a href="Electrictyconsumption_report.php">Electricity Consumption</a></li>
                        <li><a href="machine_report.php">Machine Report</a></li>
                        <li><a href="scrap.php">Scrap Report</a></li>
                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#">Setup <span class="submenu-toggle">+</span></a>
                    <ul>
                        <li><a href="machine_setup.php">Machine Setup</a></li>
                        <li><a href="inventory.php">Product Setup</a></li>
                        <li><a href="supervisor_setup.php">Supervisor Setup</a></li>
                        <li><a href="shift_setup.php">Shift Setup</a></li>
                    </ul>
                </li>
            </ul>
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

            <div class="box pink">
                <p>Production Jobs: <?=$production_count['production_count']; ?></p>
            </div>

            <div class="box">
                <p>Running machines: <?=$running_machines['running_machines']; ?></p>
            </div>

            <div class ="box">
            <p>Electricity in KWh: <?=$shift_count['shift_count']; ?></p>
            </div>
       </div>

        <script src="../scrips/toggle_btn.js"></script>

    </div>

<!-- Calendar to display shedule production jobs -->
     <div id="calendar"></div>

   </body>
   <!-- bootstarp bundle with proper-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script>
   // Add click event listeners to parent menu items
   document.querySelectorAll('.has-submenu > a').forEach(parentLink => {
            parentLink.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default link action
                const parentLi = this.parentElement;

                // Toggle the submenu visibility
                if (parentLi.classList.contains('submenu-open')) {
                    parentLi.classList.remove('submenu-open');
                } else {
                    // Close other open submenus
                    document.querySelectorAll('.has-submenu').forEach(item => item.classList.remove('submenu-open'));
                    parentLi.classList.add('submenu-open');
                }
            });
        });
   </script>
</html>