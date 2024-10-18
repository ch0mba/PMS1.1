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

body {
    font-family: Arial, sans-serif;
    margin:0;
    padding: 0;
    display: flex;
}

/* Style for the navigation bar */
.navbar {
    height: 100vh; /* Full height */
    width: 250px; /* Set the width of the sidebar */
    background-color: #333;
    padding-top: 20px;
    position: fixed;
    display: flex;
}

/* Style for logo */
.navbar .logo {
    text-align: center;
    margin-bottom: 20px;
}

.navbar .logo img {
    width: 150px; /* Adjust logo size */
}

/* Style for the links in the navbar */
.navbar .ul ul {
    list-style-type: none; /* Remove bullet points */
    padding: 0;
    margin-left: 10px;
    
}

.navbar ul li {
    display: block;
}

.navbar a {
    padding: 15px 25px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    text-align: left;
}

.navbar a:hover {
    background-color: #575757;
}

/* Dropdown containers */
.dropdown-container {
    display: none;
    background-color: #414141;
    padding-left: 30px;
}

.dropdown-container a {
    padding: 10px 0;
}

/* Style for the dropdown button */
.dropdown-toggle {
    cursor: pointer;
    font-size: 18px;
    padding: 15px 25px;
    color: white;
    background-color: #333;
    text-align: left;
    width: 100%;
    border: none;
    outline: none;
}

.dropdown-toggle:hover {
    background-color: #575757;
}

/* Main content area */
.main-content {
    margin-left:250px; /* Margin to account for the sidebar */
    padding: 20px;
    width: 100%;
    display: flex;
    font-family: Arial, sans-serif;
    background-color: aqua;
}
