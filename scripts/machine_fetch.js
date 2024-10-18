fetch('../api/machine_query_data.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        const tableBody = document.getElementById('table-body');
        let tableRows = '';

        // Loop through the fetched data and create table rows
        data.forEach(row => {
            tableRows += `
                <tr>
                    <td>${row.machine_number}</td>
                    <td>${row.status}</td>
                    <td>
                    <button onclick="updateRow(${row.id})">Update</button>
                    </td>
                    <td>
                    <button onclick="deleteRow(${row.id})">Delete</button>
                    </td>
                </tr>
            `;
        });

        tableBody.innerHTML = tableRows;

    })
    .catch(error => console.error('Error fetching data:', error));

    function updateRow(id, machineNumber, status) {
        const newMachineNumber = prompt(`Update Machine Number (Current: ${machineNumber})`, machineNumber);
        const newStatus = prompt(`Update Machine Status (Current: ${status})`, status);
    
        // Check if both values are not empty
        if (newMachineNumber !== null && newStatus !== null) {
            // Send a POST request to update the machine data
            fetch('../api/machine_update_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    machine_number: newMachineNumber,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Machine updated successfully');
                    location.reload(); // Reload the page to reflect the changes
                } else {
                    alert('Failed to update machine: ' + result.error);
                }
            })
            .catch(error => console.error('Error updating machine:', error));
        } else {
            alert("Update cancelled or invalid input.");
        }
    }
