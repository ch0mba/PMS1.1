<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift Management</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css" rel="stylesheet">
    <style>
        .shift-morning { background-color: #FF6347; } /* Morning Shift */
        .shift-afternoon { background-color: #4682B4; } /* Afternoon Shift */
        .shift-night { background-color: #32CD32; } /* Night Shift */
        /* Sidebar Styles */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }
        #sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        #sidebar a:hover {
            background-color: #007bff;
        }
        .main-content {
            margin-left: 260px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar">
    <h3 class="text-center text-white">Dashboard</h3>
    <a href="index.html">Shift Management</a>
    <a href="create_employee.php">Create Employee</a>
    <a href="view_employees.php">View Employees</a>
    <a href="create_shift.html">Create Shift</a>
    <a href="view_shifts.html">View Shifts</a>
</div>

<!-- Main Content Area -->
<div class="main-content container mt-4">
    <h2 class="mb-4">Shift Management</h2>

    <!-- Search and Filter -->
    <div class="mb-3">
        <input type="text" id="searchName" placeholder="Search Employee by Name" class="form-control mb-3">
        <select id="filterDepartment" class="form-select mb-3">
            <option value="">Filter by Department</option>
            <option value="HR">HR</option>
            <option value="IT">IT</option>
            <option value="Sales">Sales</option>
        </select>
    </div>

    <!-- FullCalendar -->
    <div id="calendar"></div>

    <!-- Shift Template -->
    <div class="mb-3">
        <select id="shiftTemplate" class="form-select">
            <option value="0">Select Shift Template</option>
            <option value="1">Morning Shift</option>
            <option value="2">Afternoon Shift</option>
            <option value="3">Night Shift</option>
        </select>
    </div>

    <!-- Employee Availability -->
    <form id="availabilityForm">
        <label>Mark Availability</label>
        <input type="checkbox" id="availability" name="availability">
        <button type="submit" class="btn btn-primary">Save Availability</button>
    </form>

    

    
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Initialize FullCalendar
const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialView: 'dayGridMonth',
    droppable: true, // Allow dragging events
    events: function(info, successCallback) {
        $.ajax({
            url: 'fetch_shifts.php',
            method: 'GET',
            success: function(data) {
                successCallback(data);
            }
        });
    },
    eventReceive: function(info) {
        const employeeId = info.event.extendedProps.employee_id; // Get employee ID
        const shiftId = info.event.id; // Get shift ID

        // Handle shift assignment
        $.ajax({
            url: 'assign_shift.php',
            method: 'POST',
            data: {
                employee_id: employeeId,
                shift_id: shiftId,
                assigned_date: info.event.start
            },
            success: function(response) {
                alert(response.message);
            }
        });
    }
});

calendar.render();

// Search and Filter Employees
$('#searchName, #filterDepartment').on('input change', function() {
    const name = $('#searchName').val().toLowerCase();
    const department = $('#filterDepartment').val();
    
    $.ajax({
        url: 'filter_employees.php',
        method: 'GET',
        data: { name: name, department: department },
        success: function(data) {
            let employeeList = '';
            data.forEach(function(employee) {
                employeeList += `
                    <tr>
                        <td>${employee.name}</td>
                        <td>${employee.department}</td>
                        <td>${employee.role}</td>
                        <td>${employee.availability ? 'Available' : 'Not Available'}</td>
                    </tr>
                `;
            });
            $('#employeeList tbody').html(employeeList);
        }
    });
});

// Shift Template
$('#shiftTemplate').change(function() {
    const templateId = $(this).val();
    $.ajax({
        url: 'get_shift_template.php',
        method: 'GET',
        data: { id: templateId },
        success: function(template) {
            $('#shift_name').val(template.name);
            $('#shift_time_start').val(template.start);
            $('#shift_time_end').val(template.end);
        }
    });
});

// Employee Availability
$('#availabilityForm').submit(function(event) {
    event.preventDefault();
    const availability = $('#availability').prop('checked');
    $.ajax({
        url: 'save_availability.php',
        method: 'POST',
        data: { availability: availability },
        success: function(response) {
            alert(response.message);
        }
    });
});

// Employee Creation
$('#createEmployeeForm').submit(function(event) {
    event.preventDefault();

    const empName = $('#empName').val();
    const empDepartment = $('#empDepartment').val();
    const empRole = $('#empRole').val();
    const empEmail = $('#empEmail').val();
    const empPhone = $('#empPhone').val();

    $.ajax({
        url: 'create_employee.php',
        method: 'POST',
        data: {
            empName: empName,
            empDepartment: empDepartment,
            empRole: empRole,
            empEmail: empEmail,
            empPhone: empPhone
        },
        success: function(response) {
            alert(response.message);
            $('#createEmployeeForm')[0].reset();
        }
    });
});
</script>

</body>
</html>
