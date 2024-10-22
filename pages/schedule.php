
<!DOCTYPE html>
<html>
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/">
    <title>Schedule Jobs</title>
   </head>

            <?php
            include '../api/connection.php';
            include '../templates/header.php';
            ?>

   <body>

            <h2>Shedule Production Job</h2>


            <form class="form">
                <form action="../api/machine_query_data.php" method="POST">
                    <div class ="field input">
                        <lable for="machine">Select Machine:</label>
                        <select name="machine_id" id="machine"></select>
                    </div>

                    <div class ="field input">
                        <label for="production">Selct Production stockcode:</label>
                        <select name="stockcode" id="stockcode"></select>
                    </div>

                    <div class ="field input">
                        <label for ="shift">Select Shift:</lable>
                        <select name="shift_id" id="shift"></select>
                    </div>

                    <div class ="field input">
                        <label for ="supervisor">Selct Supervisor:</lable>
                        <select name ="supervisor_id" id="supervisor"></select>
                    </div>

                    <label for="quanity"> Quantity to Produce:</lable>
                    <input type="number" name="quantity" id="quantity" required>

                    <button type ="submit">Shedule Job</button>
                </form>

            </div>
    </body>
        <?php
        include '../templates/footer.php';
        ?>
</html>