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

                
            </ul>
        </div>
    </div>
   

<!-- Calendar to display shedule production jobs -->
     <div id="calendar"></div>

   </body>
   <!-- bootstarp bundle with proper-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
   <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        });

        // Submenu toggle functionality
        document.querySelectorAll('.has-submenu > a').forEach(parentLink => {
            parentLink.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default link action
                const parentLi = this.parentElement;
                const submenuToggle = this.querySelector('.submenu-toggle');

                // Toggle submenu visibility
                if (parentLi.classList.contains('submenu-open')) {
                    parentLi.classList.remove('submenu-open');
                    submenuToggle.textContent = '+'; // Change icon to "+"
                } else {
                    // Close other submenus
                    document.querySelectorAll('.has-submenu').forEach(item => {
                        item.classList.remove('submenu-open');
                        item.querySelector('.submenu-toggle').textContent = '+';
                    });
                    parentLi.classList.add('submenu-open');
                    submenuToggle.textContent = '-'; // Change icon to "-"
                }
            });
        });
    </script>
   
</html>