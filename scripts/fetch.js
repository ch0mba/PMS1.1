<script>
        // Function to fetch data from the PHP file and update the page
        function loadDashboardData() {
            fetch('dashboard.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('totalTonnage').textContent = data.total_tonnage + ' KG';
                    document.getElementById('productionJobs').textContent = data.production_count;
                    document.getElementById('runningMachines').textContent = data.running_machines;
                    document.getElementById('shiftCount').textContent = data.shift_count;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Load the data when the page loads
        window.onload = loadDashboardData;
    </script>