
<!DOCTYPE html>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Schedule Jobs</title>
   </head>

            <?php
            include 'connection.php';
            include '../templates/header.php';
            ?>

   <body>

            <h2>Shedule Production Job</h2>

            <div class="form">
                <form action="../api/schedule_job.php" method="POST">
                    <lable for="machine">Select Machine:</label>
                    <select name="machine_id" id="machine">
                        <?php
                        $machines = $conn->query("SELECT id, machine_name FROM machines");
                        while ($machines = $machines->fetch_assoc()){
                        echo "<option value = {$machines['id']}'>{$machines['machine_name']}</option>";

                        }
                        ?>
                    </select>


                    <label for="production">Selct Production:</label>
                    <select name="production_id" id="production">
                        <?php
                        $products = $conn->query("SELECT id, stockcode FROM products");
                        while ($product = $products->fetch_assoc()){
                        echo "<option value = {$product['id']}'>{product['stockcode']}</option>";
                        }
                        ?>

                    </select>
                    
                    <label for ="shift">Select Shift:</lable>
                    <select name="shift_id" id="shift">
                        <?php
                        $shift = $conn->query("SELECT id, shift_name form shift_number FROM shifts");
                        while ($shift = $shifts->fetch_assoc()){
                            echo "<option value = {$shift['id']}'>{shift['shift_number']}</option>";
                        }
                        ?>
                    </select>

                    <label for ="supervisor">Selct Supervisor:</lable>
                    <select name ="supervisor_id" id="supervisor">
                        <?php
                        $supervisors = $conn->query("SELECT id, first_name, last_name FROM Supervisor");
                        while ($supervisor = $supervisors->fetch_assoc()){
                            echo "<option value = {$supervisor['id']}'>{supervisor['first_name'+''+ 'last_name']}</option>";

                        }
                        ?>

                    </select>

                    <label for="quanity"> Quantity to Produce:</lable>
                    <input type="number" name="quantity" id="quantity" required>

                    <button type ="submit">Shedule Jon</button>
                </form>

            </div>
    </body>
        <?php
        include '../templates/footer.php';
        ?>
</html>