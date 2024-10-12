<!DOCTYPE html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/home.css">
        <title>Schedule Job</title>
   </head>

   <body>   
         <?php 
             include 'connection.php';
            include '../templates/header.php';
         ?>

         <h2> Track Production Job</h2>

        <form action="../api/track_production.php" method="POST">
            <label for = "job_id">Select Job:</label>
            <select name= "job_id" id="job_id">
                <?php
                $jobs = $conn->query("SELECT id, job_number FROM production_jobs WHERE status='in_progress'");
                while ($job = $jobs->fetch_assoc()){
                    echo "<option value='{$job['id']}'>Job #{$job['job_number']}</option>";
                }
                ?>
            <select>
            <label for="item_number">Item Number:</label>
            <input type="number" name="item_number" id="item_number" required>

            <label for="weight">Weight:</label>
            <input type="number" name="weight" id="weight" required>

            <button type="submit">log item </button>
         </form>
        
    <!--Section to display the table with logged items -->
    <h3>Logged Production Items</h3>
    <table border="1">
                <thead>
                    <tr>
                        <th>Item Number</th>
                        <th>Weight (KG)</th>
                        <th>Date Logged</th>
                     </tr>
                </thead>
            <tbody>
                <?php
                    $items = $conn->query("SELECT job_number, item_number, weight, time FROM production_details");
                    while ($item = $items-> fetch_assoc()){
                        echo "
                        <tr>
                            <td>Job #{$item['job_number']}</td>
                            <td>{$item ['item_number']}</td>
                            <td>{$item ['weight']}</td>
                            <td>{$item ['weight']}</td>
                        </tr>";
                    }
                ?>
   </body>
</html>