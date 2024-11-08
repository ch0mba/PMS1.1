<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tables.css">
    <title>Product Setup</title>
</head>
<?php
    include '../api/connection.php';
    ?>
<body>
    <h1>Product Setup</h1>

    <!-- Form for adding machines -->
    <div class="form">
        <form action="../api/product_post.php" method="POST" id ="add_product">
            <h3>Add Product</h3>
            <label for="stockcode">StockCode:</label>
            <input type="text" name="stockcode" id="stcockcode" required>

            <label for="actual_weight">Actual Weight:</label>
            <input type="text" name="actual_weight" id="actualweight" required>

            <label for="Weight per meter">Weight per meter:</label>
            <input type="float" name="weight_per_meter" id="weight_per_meter" required>

            <label for="length">Length:</label>
            <input type="float" name="length" id="length" required>

            <label for="pressure_rate">Pressure Rating:</label>
            <select name="pressure_rate" id="presure_rate" required>
                <option value=""></option>
                <option value="10">PN10</option>
                <option value="16">PN16</option>
                <option value="20">PN20</option>
            </select>
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    
    <h1>Product Query</h1>
    <table>
        <thead>
            <tr>
                <th>Stockcode</th>
                <th>Actual weight</th>
                <th>Weight per meter</th>
                <th>Length in meters</th>
                <th>Presure rating</th>
            </tr>
        </thead>
        <tbody id="table_product-body">
            <!-- Rows will be populated here -->
           
        </tbody>
    </table>
   <!-- Popup form for updating product -->
<div id="update-form" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border: 1px solid #333; z-index: 1000;">
    <h3>Update Product</h3>
    <form id="product-update-form">
        <input type="hidden" id="product-id">
        <label for="stockcode">Stockcode:</label><br>
        <input type="text" id="stockcode"><br><br>

        <label for="actual_weight">Actual Weight:</label><br>
        <input type="number" id="actual_weight"><br><br>

        <label for="weight_per_meter">Weight per Meter:</label><br>
        <input type="number" id="weight_per_meter"><br><br>

        <label for="length">Length:</label><br>
        <input type="number" id="length"><br><br>

        <label for="pressure_rate">Pressure Rate:</label><br>
        <input type="number" id="pressure_rate"><br><br>

        <button type="button" onclick="submitUpdate()">Update</button>
        <button type="button" onclick="closePopup()">Cancel</button>
    </form>
</div>
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);"></div>

</body>
 <!-- Link to external JavaScript file -->
 <script src="../scripts/product_fetch.js"></script>
    <script src="../scripts/product_delete.js"></script>
</html>