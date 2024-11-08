fetch('../api/product_query.php')
    .then(response => response.json()) // Parse the JSON response
    .then(data => {
        const tableBody = document.getElementById('table_product-body');
        let tableRows = '';

        // Loop through the fetched data and create table rows
        data.forEach(row => {
            tableRows += `
                <tr>
                    <td>${row.stockcode}</td>
                    <td>${row.actual_weight}</td>
                    <td>${row.weight_per_meter}</td>
                    <td>${row.length}</td>
                    <td>${row.pressure_rate}</td>
                    <td>
                    <button onclick="updateRow(${row.id},'${row.stockcode}','${row.actual_weight}','${row.weight_per_meter}','${row.length}','${row.pressure_rate}')">Update</button>
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



    function updateRow(id, stockcode, actual_weight, weight_per_meter, length, pressure_rate) {
        console.log(id, stockcode, actual_weight, weight_per_meter, length, pressure_rate);  // Debug log to confirm values
        // Display the popup form
        document.getElementById('update-form').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    
        // Populate form fields with current values
        document.getElementById('product_id').value = id;
        document.getElementById('stockcode').value = decodeURIComponent(stockcode);
        document.getElementById('actual_weight').value = decodeURIComponent(actual_weight);
        document.getElementById('weight_per_meter').value = decodeURIComponent(weight_per_meter);
        document.getElementById('length').value = decodeURIComponent(length);
        document.getElementById('pressure_rate').value = decodeURIComponent(pressure_rate);
    }
    
    function closePopup() {
        document.getElementById('update_form').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    
    function submitUpdate() {
        const id = document.getElementById('product_id').value;
        const stockcode = document.getElementById('stockcode').value;
        const actual_weight = document.getElementById('actual_weight').value;
        const weight_per_meter = document.getElementById('weight_per_meter').value;
        const length = document.getElementById('length').value;
        const pressure_rate = document.getElementById('pressure_rate').value;
    
        // Check if fields are not empty
        if (stockcode && actual_weight && weight_per_meter && length && pressure_rate) {
            // Send a POST request to update the product
            fetch('../api/product_update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    stockcode: stockcode,
                    actual_weight: actual_weight,
                    weight_per_meter: weight_per_meter,
                    length: length,
                    pressure_rate: pressure_rate
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Product updated successfully');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Failed to update product: ' + result.error);
                }
            })
            .catch(error => {
                console.error('Error updating product:', error);
                alert('There was an error updating the product. Please try again later.');
            }); 
            // Close the popup form after submission
            closePopup();
        } else {
            alert('Please fill out all fields.');
        }
    }
    