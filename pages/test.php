<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Query</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Machine Query</h1>
    <table>
        <thead>
            <tr>
                <th>Machine Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Rows will be populated here -->
            <script src="../scripts/machine_fetch.js"></script> 
        </tbody>
    </table>

    <!-- Link to external JavaScript file -->
    
</body>
</html>